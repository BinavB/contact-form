<?php

namespace YourVendor\ContactForm\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use YourVendor\ContactForm\Http\Requests\StoreContactSubmissionRequest;
use YourVendor\ContactForm\Jobs\SendContactFormEmailsJob;
use YourVendor\ContactForm\Models\ContactSubmission;

class ContactSubmissionController extends Controller
{
    // ── Store (Submit form) ───────────────────────────────────────────────

    /**
     * POST /api/contact-form/submit
     *
     * Any authenticated user can submit.
     */
    public function store(StoreContactSubmissionRequest $request): JsonResponse
    {
        $user = JWTAuth::user();

        $submission = ContactSubmission::create([
            'user_id' => $user->id,
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Dispatch queued email notifications
        SendContactFormEmailsJob::dispatch($submission)
            ->onConnection(config('contact-form.queue_connection', 'default'));

        return response()->json([
            'success' => true,
            'message' => 'Your message has been received. We will get back to you soon.',
            'data'    => [
                'id'           => $submission->id,
                'subject'      => $submission->subject,
                'submitted_at' => $submission->created_at->toIso8601String(),
            ],
        ], 201);
    }

    // ── Index (User's own submissions) ────────────────────────────────────

    /**
     * GET /api/contact-form/my-submissions
     *
     * Returns the paginated list of the current user's submissions only.
     */
    public function mySubmissions(): JsonResponse
    {
        $user = JWTAuth::user();

        $submissions = ContactSubmission::forUser($user->id)
            ->orderByDesc('created_at')
            ->paginate(config('contact-form.per_page', 15));

        return response()->json([
            'success' => true,
            'data'    => $submissions->map(fn ($s) => [
                'id'           => $s->id,
                'name'         => $s->name,
                'email'        => $s->email,
                'subject'      => $s->subject,
                'message'      => $s->message,
                'submitted_at' => $s->created_at->toIso8601String(),
            ]),
            'meta' => [
                'current_page' => $submissions->currentPage(),
                'last_page'    => $submissions->lastPage(),
                'per_page'     => $submissions->perPage(),
                'total'        => $submissions->total(),
            ],
        ]);
    }

    // ── Show (Single submission) ──────────────────────────────────────────

    /**
     * GET /api/contact-form/my-submissions/{id}
     *
     * A user may only view their own submission.
     */
    public function show(int $id): JsonResponse
    {
        $user = JWTAuth::user();

        $submission = ContactSubmission::forUser($user->id)->find($id);

        if (! $submission) {
            return response()->json([
                'success' => false,
                'message' => 'Submission not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => [
                'id'           => $submission->id,
                'name'         => $submission->name,
                'email'        => $submission->email,
                'subject'      => $submission->subject,
                'message'      => $submission->message,
                'submitted_at' => $submission->created_at->toIso8601String(),
            ],
        ]);
    }
}
