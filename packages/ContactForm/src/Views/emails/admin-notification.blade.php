<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #4f46e5;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background: #f9fafb;
            padding: 30px;
            border: 1px solid #e5e7eb;
            border-radius: 0 0 8px 8px;
        }
        .field {
            margin-bottom: 20px;
        }
        .field-label {
            font-weight: bold;
            color: #4b5563;
            margin-bottom: 5px;
        }
        .field-value {
            background: white;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #6b7280;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            background: #4f46e5;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📧 New Contact Form Submission</h1>
    </div>
    
    <div class="content">
        <p>A new contact form submission has been received. Here are the details:</p>
        
        <div class="field">
            <div class="field-label">From:</div>
            <div class="field-value">{{ $submission->name }} ({{ $submission->email }})</div>
        </div>
        
        <div class="field">
            <div class="field-label">Subject:</div>
            <div class="field-value">{{ $submission->subject }}</div>
        </div>
        
        <div class="field">
            <div class="field-label">Message:</div>
            <div class="field-value">{{ $submission->message }}</div>
        </div>
        
        <div class="field">
            <div class="field-label">Submitted At:</div>
            <div class="field-value">{{ $submission->created_at->format('F j, Y, g:i A') }}</div>
        </div>
        
        @if($submission->user)
        <div class="field">
            <div class="field-label">Registered User:</div>
            <div class="field-value">{{ $submission->user->name }} ({{ $submission->user->email }})</div>
        </div>
        @endif
        
        <a href="{{ url('/admin/contact-submissions') }}" class="btn">View in Admin Dashboard</a>
    </div>
    
    <div class="footer">
        <p>This email was sent automatically by the {{ config('app.name') }} contact form system.</p>
    </div>
</body>
</html>
