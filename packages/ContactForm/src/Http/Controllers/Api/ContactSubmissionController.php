<?php

namespace ContactForm\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use ContactForm\Models\ContactSubmission;
use Tymon\JWTAuth\Facades\JWTAuth;

class ContactSubmissionController extends Controller
{
    /**
     * Store a newly created contact submission.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'subject' => ['required', 'string', 'min:3', 'max:200'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ], [
            'name.required' => 'Your name is required.',
            'email.required' => 'A valid email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'subject.required' => 'Please provide a subject.',
            'message.required' => 'Message cannot be empty.',
            'message.min' => 'Message must be at least 10 characters.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = JWTAuth::user();

        $submission = ContactSubmission::create([
            'user_id' => $user?->id,
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your message has been received. We will get back to you soon.',
            'data' => [
                'id' => $submission->id,
                'subject' => $submission->subject,
                'submitted_at' => $submission->created_at->toIso8601String(),
            ],
        ], 201);
    }

    /**
     * Display a listing of the user's own submissions.
     */
    public function mySubmissions(): JsonResponse
    {
        $user = JWTAuth::user();

        $submissions = ContactSubmission::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $submissions->map(fn ($s) => [
                'id' => $s->id,
                'name' => $s->name,
                'email' => $s->email,
                'subject' => $s->subject,
                'message' => $s->message,
                'submitted_at' => $s->created_at->toIso8601String(),
            ]),
            'meta' => [
                'current_page' => $submissions->currentPage(),
                'last_page' => $submissions->lastPage(),
                'per_page' => $submissions->perPage(),
                'total' => $submissions->total(),
            ],
        ]);
    }

    /**
     * Display the specified submission.
     */
    public function show(int $id): JsonResponse
    {
        $user = JWTAuth::user();

        $submission = ContactSubmission::where('user_id', $user->id)->find($id);

        if (!$submission) {
            return response()->json([
                'success' => false,
                'message' => 'Submission not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $submission->id,
                'name' => $submission->name,
                'email' => $submission->email,
                'subject' => $submission->subject,
                'message' => $submission->message,
                'submitted_at' => $submission->created_at->toIso8601String(),
            ],
        ]);
    }
}
