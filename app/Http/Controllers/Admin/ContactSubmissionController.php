<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ContactSubmission::query();

        // Filter by sent status
        if ($request->has('status')) {
            if ($request->status === 'sent') {
                $query->sent();
            } elseif ($request->status === 'unsent') {
                $query->unsent();
            }
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $submissions = $query->latest()->paginate(20);

        return view('admin.contact-submissions.index', compact('submissions'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactSubmission $contact_submission)
    {
        return view('admin.contact-submissions.show', compact('contact_submission'));
    }

    /**
     * Mark submission as sent.
     */
    public function markAsSent(ContactSubmission $contact_submission)
    {
        $contact_submission->update([
            'is_sent' => true,
            'sent_at' => now()
        ]);

        return redirect()->back()->with('success', 'Submission marked as sent.');
    }

    /**
     * Mark submission as unsent.
     */
    public function markAsUnsent(ContactSubmission $contact_submission)
    {
        $contact_submission->update([
            'is_sent' => false,
            'sent_at' => null
        ]);

        return redirect()->back()->with('success', 'Submission marked as unsent.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactSubmission $contact_submission)
    {
        $contact_submission->delete();

        return redirect()->route('admin.contact-submissions.index')
                         ->with('success', 'Contact submission deleted successfully.');
    }
}
