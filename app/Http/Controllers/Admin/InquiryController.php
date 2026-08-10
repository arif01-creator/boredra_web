<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InquiryUpdateRequest;
use App\Models\Inquiry;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InquiryController extends Controller
{
    public function index(Request $request): View
    {
        $inquiries = Inquiry::query()
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->string('status')))
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->string('search');
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('company', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.inquiries.index', [
            'inquiries' => $inquiries,
            'statuses' => ['new', 'contacted', 'in_progress', 'completed', 'archived'],
        ]);
    }

    public function show(Inquiry $inquiry): View
    {
        return view('admin.inquiries.show', ['inquiry' => $inquiry]);
    }

    public function update(InquiryUpdateRequest $request, Inquiry $inquiry): RedirectResponse
    {
        $inquiry->update($request->validated());

        return redirect()->route('admin.inquiries.show', $inquiry)->with('toast', ['type' => 'success', 'message' => 'Inquiry updated.']);
    }

    public function destroy(Inquiry $inquiry): RedirectResponse
    {
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')->with('toast', ['type' => 'success', 'message' => 'Inquiry deleted.']);
    }

    public function export(): StreamedResponse
    {
        $inquiries = Inquiry::latest()->get();

        return response()->streamDownload(function () use ($inquiries) {
            $out = fopen('php://output', 'w');
            abort_if($out === false, 500, 'Failed to open output stream.');
            fputcsv($out, ['Name', 'Company', 'Email', 'Phone', 'Country', 'Product Interest', 'Quantity', 'Message', 'Status', 'Received']);

            foreach ($inquiries as $inquiry) {
                fputcsv($out, [
                    $inquiry->name,
                    $inquiry->company,
                    $inquiry->email,
                    $inquiry->phone,
                    $inquiry->country,
                    $inquiry->product_interest,
                    $inquiry->quantity,
                    $inquiry->message,
                    $inquiry->status,
                    $inquiry->created_at?->toDateTimeString(),
                ]);
            }

            fclose($out);
        }, 'inquiries-'.now()->format('Y-m-d').'.csv');
    }
}
