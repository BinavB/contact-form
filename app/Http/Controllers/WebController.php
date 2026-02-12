<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ContactSubmission;
use App\Http\Requests\StoreContactSubmissionRequest;
use App\Mail\AdminNotificationMail;
use App\Mail\UserConfirmationMail;
use Illuminate\Support\Facades\Mail;

class WebController extends Controller
{
    /**
     * Show landing page.
     */
    public function index()
    {
        return view('contact-form::welcome');
    }

    /**
     * Show contact form.
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

        return redirect()->route('contact-form.form')
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
     * Process login request.
     */
    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Check if user is admin
            if (Auth::user()->role === config('contact-form.admin_role', 'admin')) {
                return redirect()->intended(route('admin.dashboard'));
            }
            
            // Redirect non-admin users
            Auth::logout();
            return back()->withErrors([
                'email' => 'Access denied. Admin privileges required.',
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
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
            $query->where('email', 'LIKE', '%' . $request->email . '%');
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
