<?php

namespace YourVendor\ContactForm\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactSubmission extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contact_submissions';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'subject',
        'message',
        'is_read',
    ];

    protected $casts = [
        'is_read'    => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // ── Relationships ─────────────────────────────────────────────────────

    /**
     * The user who created this submission (nullable for guest submissions).
     */
    public function user(): BelongsTo
    {
        $userModel = config('contact-form.user_model', \App\Models\User::class);

        return $this->belongsTo($userModel, 'user_id');
    }

    // ── Scopes ────────────────────────────────────────────────────────────

    /**
     * Filter submissions by a specific user.
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Filter submissions by email (admin search).
     */
    public function scopeByEmail($query, string $email)
    {
        return $query->where('email', 'LIKE', "%{$email}%");
    }

    /**
     * Filter submissions in a date range.
     */
    public function scopeInDateRange($query, ?string $from, ?string $to)
    {
        if ($from) {
            $query->whereDate('created_at', '>=', $from);
        }

        if ($to) {
            $query->whereDate('created_at', '<=', $to);
        }

        return $query;
    }

    /**
     * Only unread submissions.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}
