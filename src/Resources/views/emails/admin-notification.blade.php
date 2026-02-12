<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Contact Submission</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f4f4;
               margin: 0; padding: 20px; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #fff;
                   border-radius: 8px; overflow: hidden;
                   box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .header { background: #1e293b; color: #fff; padding: 24px 32px; }
        .header h1 { margin: 0; font-size: 20px; }
        .body { padding: 28px 32px; }
        .field { margin-bottom: 18px; }
        .field label { display: block; font-size: 11px; font-weight: 700;
                       text-transform: uppercase; letter-spacing: .06em;
                       color: #94a3b8; margin-bottom: 4px; }
        .field .value { font-size: 15px; color: #1e293b; }
        .message-box { background: #f8fafc; border-left: 4px solid #3b82f6;
                       padding: 14px 18px; border-radius: 4px;
                       font-size: 15px; line-height: 1.7; white-space: pre-wrap; }
        .btn { display: inline-block; margin-top: 24px; padding: 10px 24px;
               background: #1e293b; color: #fff; text-decoration: none;
               border-radius: 6px; font-size: 14px; }
        .footer { background: #f8fafc; padding: 16px 32px;
                  font-size: 12px; color: #94a3b8; }
    </style>
</head>
<body>
<div class="wrapper">

    <div class="header">
        <h1>📬 New Contact Submission</h1>
        <p style="margin:6px 0 0;opacity:.7;font-size:13px">
            Submitted on {{ $submission->created_at->format('M d, Y \a\t H:i') }}
        </p>
    </div>

    <div class="body">
        <div class="field">
            <label>From</label>
            <div class="value">{{ $submission->name }}</div>
        </div>
        <div class="field">
            <label>Email</label>
            <div class="value"><a href="mailto:{{ $submission->email }}">
                {{ $submission->email }}
            </a></div>
        </div>
        <div class="field">
            <label>Subject</label>
            <div class="value" style="font-weight:600">{{ $submission->subject }}</div>
        </div>
        <div class="field">
            <label>Message</label>
            <div class="message-box">{{ $submission->message }}</div>
        </div>

        <a href="{{ url('/admin/contact-submissions/' . $submission->id) }}" class="btn">
            View in Dashboard →
        </a>
    </div>

    <div class="footer">
        This email was generated automatically by the ContactForm package.
    </div>
</div>
</body>
</html>
