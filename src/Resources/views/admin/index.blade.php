@extends('contact-form::admin.layout')

@section('content')

{{-- ── Page Header ──────────────────────────────────────────────────────── --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-0">Contact Submissions</h4>
        <p class="text-muted small mb-0">Manage all incoming contact form messages.</p>
    </div>
</div>

{{-- ── Stat Cards ───────────────────────────────────────────────────────── --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card stat-card bg-white p-3 shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:48px;height:48px;background:#e0f2fe">
                    <i class="bi bi-envelope fs-5 text-info"></i>
                </div>
                <div>
                    <div class="text-muted small">Total</div>
                    <div class="fw-bold fs-4">{{ $stats['total'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card bg-white p-3 shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:48px;height:48px;background:#fef3c7">
                    <i class="bi bi-envelope-open fs-5 text-warning"></i>
                </div>
                <div>
                    <div class="text-muted small">Unread</div>
                    <div class="fw-bold fs-4">{{ $stats['unread'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card bg-white p-3 shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:48px;height:48px;background:#d1fae5">
                    <i class="bi bi-calendar-day fs-5 text-success"></i>
                </div>
                <div>
                    <div class="text-muted small">Today</div>
                    <div class="fw-bold fs-4">{{ $stats['today'] }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── Filter Card ──────────────────────────────────────────────────────── --}}
<div class="card filter-card bg-white shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('contact-form.admin.index') }}"
              class="row g-3 align-items-end">

            {{-- Filter: User --}}
            <div class="col-md-3">
                <label class="form-label fw-semibold text-muted small">Filter by User</label>
                <select name="user_id" class="form-select form-select-sm">
                    <option value="">— All Users —</option>
                    @foreach ($users as $u)
                        <option value="{{ $u->id }}"
                            {{ request('user_id') == $u->id ? 'selected' : '' }}>
                            {{ $u->name }} ({{ $u->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filter: Email --}}
            <div class="col-md-3">
                <label class="form-label fw-semibold text-muted small">Search Email</label>
                <input type="text" name="email" class="form-control form-control-sm"
                       placeholder="email@example.com"
                       value="{{ request('email') }}" />
            </div>

            {{-- Filter: Date From --}}
            <div class="col-md-2">
                <label class="form-label fw-semibold text-muted small">Date From</label>
                <input type="date" name="date_from" class="form-control form-control-sm"
                       value="{{ request('date_from') }}" />
            </div>

            {{-- Filter: Date To --}}
            <div class="col-md-2">
                <label class="form-label fw-semibold text-muted small">Date To</label>
                <input type="date" name="date_to" class="form-control form-control-sm"
                       value="{{ request('date_to') }}" />
            </div>

            {{-- Filter: Read Status --}}
            <div class="col-md-1">
                <label class="form-label fw-semibold text-muted small">Status</label>
                <select name="is_read" class="form-select form-select-sm">
                    <option value="">All</option>
                    <option value="0" {{ request('is_read') === '0' ? 'selected' : '' }}>Unread</option>
                    <option value="1" {{ request('is_read') === '1' ? 'selected' : '' }}>Read</option>
                </select>
            </div>

            {{-- Buttons --}}
            <div class="col-md-1 d-flex gap-2">
                <button type="submit" class="btn btn-dark btn-sm">
                    <i class="bi bi-funnel-fill"></i>
                </button>
                <a href="{{ route('contact-form.admin.index') }}"
                   class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
        </form>
    </div>
</div>

{{-- ── Submissions Table ────────────────────────────────────────────────── --}}
<div class="card bg-white shadow-sm" style="border-radius:12px; border:none;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">#ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Submitted At</th>
                        <th>Status</th>
                        <th class="pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($submissions as $submission)
                        <tr class="{{ $submission->is_read ? '' : 'table-warning' }}">
                            <td class="ps-4 text-muted">#{{ $submission->id }}</td>

                            <td>
                                <div class="fw-semibold">{{ $submission->name }}</div>
                                @if ($submission->user)
                                    <div class="text-muted small">
                                        <i class="bi bi-person-fill"></i>
                                        {{ $submission->user->name }}
                                    </div>
                                @endif
                            </td>

                            <td>{{ $submission->email }}</td>

                            <td>
                                <span class="text-truncate d-inline-block" style="max-width:220px">
                                    {{ $submission->subject }}
                                </span>
                            </td>

                            <td>
                                <div>{{ $submission->created_at->format('M d, Y') }}</div>
                                <div class="text-muted small">
                                    {{ $submission->created_at->format('H:i') }}
                                </div>
                            </td>

                            <td>
                                @if ($submission->is_read)
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3">
                                        Read
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3">
                                        Unread
                                    </span>
                                @endif
                            </td>

                            <td class="pe-4">
                                <div class="d-flex gap-2">
                                    {{-- View --}}
                                    <a href="{{ route('contact-form.admin.show', $submission->id) }}"
                                       class="btn btn-sm btn-outline-primary" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- Mark read (only if unread) --}}
                                    @unless ($submission->is_read)
                                        <form method="POST"
                                              action="{{ route('contact-form.admin.mark-read', $submission->id) }}">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-success"
                                                    title="Mark as read">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                        </form>
                                    @endunless

                                    {{-- Delete --}}
                                    <form method="POST"
                                          action="{{ route('contact-form.admin.destroy', $submission->id) }}"
                                          onsubmit="return confirm('Delete submission #{{ $submission->id }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                title="Delete">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                No submissions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if ($submissions->hasPages())
        <div class="card-footer bg-white border-top px-4 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Showing {{ $submissions->firstItem() }}–{{ $submissions->lastItem() }}
                    of {{ $submissions->total() }} submissions
                </small>
                {{ $submissions->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>

@endsection
