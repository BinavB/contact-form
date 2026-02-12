<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Contacting Us</title>
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
            background: #10b981;
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
        .message-details {
            background: white;
            padding: 20px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            margin: 20px 0;
        }
        .field {
            margin-bottom: 15px;
        }
        .field-label {
            font-weight: bold;
            color: #4b5563;
            margin-bottom: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #6b7280;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            background: #10b981;
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
        <h1>✅ Thank You for Contacting Us!</h1>
    </div>
    
    <div class="content">
        <p>Dear {{ $submission->name }},</p>
        
        <p>Thank you for reaching out to us through our contact form. We have successfully received your message and will get back to you as soon as possible.</p>
        
        <div class="message-details">
            <h3>Your Message Details:</h3>
            <div class="field">
                <div class="field-label">Subject:</div>
                <div>{{ $submission->subject }}</div>
            </div>
            
            <div class="field">
                <div class="field-label">Message:</div>
                <div>{{ $submission->message }}</div>
            </div>
            
            <div class="field">
                <div class="field-label">Submitted At:</div>
                <div>{{ $submission->created_at->format('F j, Y, g:i A') }}</div>
            </div>
        </div>
        
        <p><strong>What happens next?</strong></p>
        <ul>
            <li>Our team will review your message within 24 hours</li>
            <li>You'll receive a response at your email address: {{ $submission->email }}</li>
            <li>If your inquiry requires additional information, we'll contact you</li>
        </ul>
        
        <p>If you have any urgent questions or need to update your message, please don't hesitate to contact us again.</p>
        
        <a href="{{ url('/contact-form') }}" class="btn">Visit Our Contact Page</a>
    </div>
    
    <div class="footer">
        <p>This email was sent automatically by the {{ config('app.name') }} contact form system.</p>
        <p>If you didn't submit this form, please ignore this email.</p>
    </div>
</body>
</html>
