<?php

namespace ContactForm\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ContactForm\Models\ContactSubmission;
use ContactForm\Http\Requests\StoreContactSubmissionRequest;
use ContactForm\Mail\AdminNotificationMail;
use ContactForm\Mail\UserConfirmationMail;
use Illuminate\Support\Facades\Mail;

class WebController extends Controller
{
    /**
     * Show the landing page.
     */
    public function index()
    {
        return view('contact-form::welcome');
    }

    /**
     * Show the contact form.
     */
    public function showForm()
    {
        return view('contact-form::contact');
    }

    /**
     * Handle contact form submission.
     */
    public function submitForm(StoreContactSubmissionRequest $request)
    {
        $submission = ContactSubmission::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Send email notifications
        try {
            // Notify admin
            Mail::to(config('contact-form.admin_email'), config('contact-form.admin_name'))
                ->send(new AdminNotificationMail($submission));

            // Confirm to user
            Mail::to($submission->email, $submission->name)
                ->send(new UserConfirmationMail($submission));
        } catch (\Exception $e) {
            \Log::error('Contact form email failed: ' . $e->getMessage());
        }

        return redirect()->route('contact.form')
            ->with('success', 'Your message has been sent successfully! We will get back to you soon.');
    }

    /**
     * Show login page.
     */
    public function showLogin()
    {
        return view('contact-form::auth.login');
    }

    /**
     * Show admin dashboard.
     */
    public function adminDashboard(Request $request)
    {
        $user = Auth::user();
        
        // Check if user is admin
        if (!$user || $user->role !== config('contact-form.admin_role', 'admin')) {
            abort(403, 'Unauthorized access.');
        }

        $query = ContactSubmission::with('user');

        // Filter by email
        if ($request->filled('email')) {
            $query->byEmail($request->email);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $submissions = $query->orderByDesc('created_at')
            ->paginate(config('contact-form.per_page', 15));

        return view('contact-form::admin.dashboard', compact('submissions'));
    }

    /**
     * Mark submission as read.
     */
    public function markAsRead($id)
    {
        $user = Auth::user();
        
        if (!$user || $user->role !== config('contact-form.admin_role', 'admin')) {
            abort(403, 'Unauthorized access.');
        }

        $submission = ContactSubmission::findOrFail($id);
        $submission->update(['is_read' => true]);

        return back()->with('success', 'Submission marked as read.');
    }

    /**
     * Delete submission.
     */
    public function deleteSubmission($id)
    {
        $user = Auth::user();
        
        if (!$user || $user->role !== config('contact-form.admin_role', 'admin')) {
            abort(403, 'Unauthorized access.');
        }

        $submission = ContactSubmission::findOrFail($id);
        $submission->delete();

        return back()->with('success', 'Submission deleted successfully.');
    }
}
