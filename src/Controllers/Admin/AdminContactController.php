<?php

namespace YourVendor\ContactForm\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use YourVendor\ContactForm\Models\ContactSubmission;

class AdminContactController extends Controller
{
    // ── Index ─────────────────────────────────────────────────────────────

    /**
     * GET /admin/contact-submissions
     *
     * Admin dashboard showing all submissions with filters.
     */
    public function index(Request $request): View
    {
        $query = ContactSubmission::with('user')
            ->orderByDesc('created_at');

        // ── Filter: by user_id
        if ($request->filled('user_id')) {
            $query->where('user_id', (int) $request->user_id);
        }

        // ── Filter: by email (partial match)
        if ($request->filled('email')) {
            $query->byEmail($request->email);
        }

        // ── Filter: date range
        if ($request->filled('date_from') || $request->filled('date_to')) {
            $query->inDateRange($request->date_from, $request->date_to);
        }

        // ── Filter: read status
        if ($request->filled('is_read')) {
            $query->where('is_read', (bool) $request->is_read);
        }

        $submissions = $query->paginate(config('contact-form.per_page', 15))
                             ->withQueryString();

        // Stats for header cards
        $stats = [
            'total'   => ContactSubmission::count(),
            'unread'  => ContactSubmission::unread()->count(),
            'today'   => ContactSubmission::whereDate('created_at', today())->count(),
        ];

        // For the "filter by user" dropdown - get distinct users who submitted
        $users = ContactSubmission::whereNotNull('user_id')
            ->with('user:id,name,email')
            ->select('user_id')
            ->distinct()
            ->get()
            ->pluck('user')
            ->filter();

        return view('contact-form::admin.index', compact('submissions', 'stats', 'users'));
    }

    // ── Show ─────────────────────────────────────────────────────────────

    /**
     * GET /admin/contact-submissions/{id}
     *
     * View a single submission and mark it as read.
     */
    public function show(int $id): View
    {
        $submission = ContactSubmission::with('user')->findOrFail($id);

        // Auto-mark as read when admin opens it
        if (! $submission->is_read) {
            $submission->update(['is_read' => true]);
        }

        return view('contact-form::admin.show', compact('submission'));
    }

    // ── Destroy ───────────────────────────────────────────────────────────

    /**
     * DELETE /admin/contact-submissions/{id}
     *
     * Soft-delete a submission.
     */
    public function destroy(int $id): RedirectResponse
    {
        $submission = ContactSubmission::findOrFail($id);
        $submission->delete();

        return redirect()
            ->route('contact-form.admin.index')
            ->with('success', 'Submission #' . $id . ' has been removed.');
    }

    // ── Mark Read ─────────────────────────────────────────────────────────

    /**
     * PATCH /admin/contact-submissions/{id}/mark-read
     */
    public function markRead(int $id): RedirectResponse
    {
        ContactSubmission::findOrFail($id)->update(['is_read' => true]);

        return back()->with('success', 'Marked as read.');
    }
}
