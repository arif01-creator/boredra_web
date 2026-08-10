<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Media;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalProducts' => Product::count(),
            'publishedProducts' => Product::where('status', 'published')->count(),
            'newInquiries' => Inquiry::where('status', 'new')->count(),
            'mediaAssets' => Media::count(),
            'recentInquiries' => Inquiry::latest()->take(5)->get(),
        ]);
    }
}
