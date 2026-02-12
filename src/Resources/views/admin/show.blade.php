@extends('contact-form::admin.layout')

@section('content')

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('contact-form.admin.index') }}"
       class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
    <div>
        <h4 class="fw-bold mb-0">Submission #{{ $submission->id }}</h4>
        <p class="text-muted small mb-0">
            Received {{ $submission->created_at->diffForHumans() }}
        </p>
    </div>
</div>

<div class="row g-4">

    {{-- ── Main message card ──────────────────────────────────────────── --}}
    <div class="col-lg-8">
        <div class="card shadow-sm" style="border:none; border-radius:12px;">
            <div class="card-body p-4">

                {{-- Subject --}}
                <h5 class="fw-bold mb-3">{{ $submission->subject }}</h5>

                {{-- Meta row --}}
                <div class="d-flex flex-wrap gap-3 mb-4 text-muted small">
                    <span><i class="bi bi-person me-1"></i>{{ $submission->name }}</span>
                    <span><i class="bi bi-envelope me-1"></i>{{ $submission->email }}</span>
                    <span><i class="bi bi-clock me-1"></i>
                        {{ $submission->created_at->format('D, M d Y \a\t H:i') }}
                    </span>
                </div>

                <hr />

                {{-- Message body --}}
                <div class="mt-3" style="white-space:pre-wrap; line-height:1.8;">
                    {{ $submission->message }}
                </div>
            </div>
        </div>
    </div>

    {{-- ── Sidebar info ─────────────────────────────────────────────────── --}}
    <div class="col-lg-4">
        <div class="card shadow-sm mb-3" style="border:none; border-radius:12px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3 text-muted small text-uppercase">
                    Submitter Info
                </h6>
                <dl class="row mb-0 small">
                    <dt class="col-sm-4 text-muted">Name</dt>
                    <dd class="col-sm-8">{{ $submission->name }}</dd>

                    <dt class="col-sm-4 text-muted">Email</dt>
                    <dd class="col-sm-8">
                        <a href="mailto:{{ $submission->email }}">
                            {{ $submission->email }}
                        </a>
                    </dd>

                    @if ($submission->user)
                        <dt class="col-sm-4 text-muted">Account</dt>
                        <dd class="col-sm-8">
                            {{ $submission->user->name }}<br />
                            <span class="badge bg-secondary-subtle text-secondary">
                                ID #{{ $submission->user->id }}
                            </span>
                        </dd>
                    @endif
                </dl>
            </div>
        </div>

        <div class="card shadow-sm" style="border:none; border-radius:12px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3 text-muted small text-uppercase">Actions</h6>
                <div class="d-grid gap-2">
                    <a href="mailto:{{ $submission->email }}?subject=Re: {{ $submission->subject }}"
                       class="btn btn-dark btn-sm">
                        <i class="bi bi-reply me-1"></i> Reply via Email
                    </a>

                    <form method="POST"
                          action="{{ route('contact-form.admin.destroy', $submission->id) }}"
                          onsubmit="return confirm('Delete this submission permanently?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                            <i class="bi bi-trash3 me-1"></i> Delete Submission
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
