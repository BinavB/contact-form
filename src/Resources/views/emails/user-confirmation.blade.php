<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>We received your message</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f4f4;
               margin: 0; padding: 20px; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #fff;
                   border-radius: 8px; overflow: hidden;
                   box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .header { background: linear-gradient(135deg, #3b82f6, #6366f1);
                  color: #fff; padding: 32px; text-align: center; }
        .header h1 { margin: 0 0 8px; font-size: 22px; }
        .header p  { margin: 0; opacity: .85; font-size: 14px; }
        .body { padding: 32px; }
        .summary { background: #f8fafc; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .summary table { width: 100%; border-collapse: collapse; }
        .summary td { padding: 8px 0; font-size: 14px; vertical-align: top; }
        .summary td:first-child { color: #94a3b8; font-weight: 600;
                                  text-transform: uppercase; font-size: 11px;
                                  letter-spacing: .06em; width: 110px; padding-top: 10px; }
        .footer { background: #f8fafc; padding: 16px 32px;
                  font-size: 12px; color: #94a3b8; text-align: center; }
    </style>
</head>
<body>
<div class="wrapper">

    <div class="header">
        <h1>✅ Message Received!</h1>
        <p>Thank you for reaching out, {{ $submission->name }}.</p>
    </div>

    <div class="body">
        <p style="color:#374151;line-height:1.7">
            We have received your message and will respond as soon as possible.
            Here's a summary of what you sent:
        </p>

        <div class="summary">
            <table>
                <tr>
                    <td>Subject</td>
                    <td style="font-weight:600">{{ $submission->subject }}</td>
                </tr>
                <tr>
                    <td>Sent At</td>
                    <td>{{ $submission->created_at->format('M d, Y H:i') }}</td>
                </tr>
                <tr>
                    <td>Message</td>
                    <td style="white-space:pre-wrap;line-height:1.6">
                        {{ $submission->message }}
                    </td>
                </tr>
            </table>
        </div>

        <p style="color:#6b7280;font-size:14px">
            If you have any urgent queries, you can also reach us at
            <a href="mailto:{{ config('contact-form.admin_email') }}">
                {{ config('contact-form.admin_email') }}
            </a>.
        </p>
    </div>

    <div class="footer">
        © {{ date('Y') }} {{ config('app.name') }} · You received this because you
        submitted our contact form.
    </div>
</div>
</body>
</html>
