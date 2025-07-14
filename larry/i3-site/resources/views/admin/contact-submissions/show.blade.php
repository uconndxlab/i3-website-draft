@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Contact Submission Details</h5>
                    <div>
                        <a href="{{ route('admin.contact-submissions.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">Message</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>Subject:</strong> Contact Form Submission
                                    </div>
                                    <div class="mb-3">
                                        <strong>From:</strong> {{ $contact_submission->full_name }} 
                                        &lt;{{ $contact_submission->email }}&gt;
                                    </div>
                                    <div class="mb-3">
                                        <strong>Submitted:</strong> {{ $contact_submission->created_at->format('M j, Y g:i A') }}
                                    </div>
                                    <div class="mb-3">
                                        <strong>Page:</strong> 
                                        <a href="{{ $contact_submission->page_submitted }}" target="_blank">
                                            {{ $contact_submission->page_submitted }}
                                        </a>
                                    </div>
                                    <div class="mb-3">
                                        <strong>IP Address:</strong> {{ $contact_submission->ip_address }}
                                    </div>
                                    <hr>
                                    <div>
                                        <strong>Message:</strong>
                                        <div class="mt-2 p-3 bg-light rounded">
                                            {!! nl2br(e($contact_submission->message)) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">Actions</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>Status:</strong>
                                        @if($contact_submission->is_sent)
                                            <span class="badge bg-success">Sent</span>
                                            <small class="text-muted d-block">
                                                {{ $contact_submission->sent_at->format('M j, Y g:i A') }}
                                            </small>
                                        @else
                                            <span class="badge bg-warning">Unsent</span>
                                        @endif
                                    </div>

                                    <div class="d-grid gap-2">
                                        <a href="mailto:{{ $contact_submission->email }}?subject=Re: Your Message to i3&body=Hi {{ $contact_submission->first_name }},%0D%0A%0D%0AThank you for contacting i3.%0D%0A%0D%0A" 
                                           class="btn btn-primary">
                                            <i class="bi bi-reply"></i> Reply by Email
                                        </a>

                                        @if($contact_submission->is_sent)
                                            <form method="POST" 
                                                  action="{{ route('admin.contact-submissions.mark-unsent', $contact_submission) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-outline-warning">
                                                    <i class="bi bi-arrow-counterclockwise"></i> Mark as Unsent
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" 
                                                  action="{{ route('admin.contact-submissions.mark-sent', $contact_submission) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-outline-success">
                                                    <i class="bi bi-check"></i> Mark as Sent
                                                </button>
                                            </form>
                                        @endif

                                        <form method="POST" 
                                              action="{{ route('admin.contact-submissions.destroy', $contact_submission) }}"
                                              onsubmit="return confirm('Are you sure you want to delete this submission?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Contact Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <strong>First Name:</strong><br>
                                        {{ $contact_submission->first_name }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Last Name:</strong><br>
                                        {{ $contact_submission->last_name }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Email:</strong><br>
                                        <a href="mailto:{{ $contact_submission->email }}">
                                            {{ $contact_submission->email }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
