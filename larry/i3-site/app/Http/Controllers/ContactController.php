<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactSubmissionRequest;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(ContactSubmissionRequest $request)
    {
        // Create the contact submission
        $submission = ContactSubmission::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'message' => $request->message,
            'ip_address' => $request->ip(),
            'page_submitted' => $request->header('referer') ?? $request->url(),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Thank you for your message! We\'ll get back to you soon.');
    }
}
