<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InquiryController extends Controller
{
    public function index(): View
    {
        return view('admin.inquiries.index');
    }

    public function show(Inquiry $inquiry): View
    {
        return view('admin.inquiries.show', ['inquiry' => $inquiry]);
    }

    public function update(Request $request, Inquiry $inquiry): RedirectResponse
    {
        return redirect()->route('admin.inquiries.index');
    }

    public function destroy(Inquiry $inquiry): RedirectResponse
    {
        return redirect()->route('admin.inquiries.index');
    }

    public function export(): StreamedResponse
    {
        return response()->streamDownload(function () {
            echo '';
        }, 'inquiries.csv');
    }
}
