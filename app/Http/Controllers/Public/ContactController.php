<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StoreInquiryRequest;
use App\Models\Inquiry;
use App\Models\Product;
use App\Models\User;
use App\Notifications\NewInquiryReceived;
use App\Services\SeoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    public function create(SeoService $seo): Response
    {
        return Inertia::render('contact', [
            'productOptions' => Product::where('status', 'published')->orderBy('sort_order')->pluck('name'),
            'seo' => $seo->forTitle("Contact — Let's Build a Global Connection."),
        ]);
    }

    public function store(StoreInquiryRequest $request): RedirectResponse
    {
        $inquiry = Inquiry::create([
            ...$request->safe()->except('website'),
            'status' => 'new',
        ]);

        $admins = User::where('is_admin', true)->get();
        if ($admins->isNotEmpty()) {
            Notification::send($admins, new NewInquiryReceived($inquiry));
        }

        return back();
    }
}
