<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Contact Form</title>
    <script src="{{ asset('app.js') }}" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .input-group {
            position: relative;
        }
        
        .input-group input {
            padding-left: 3rem;
        }
        
        .input-group textarea {
            padding-left: 3rem;
        }
        
        .input-group i {
            position: absolute;
            left: 1rem;
            top: 1rem;
            color: #9ca3af;
            z-index: 10;
        }
        
        .input-group textarea + i {
            top: 1.25rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .success-message {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        
        .error-message {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-2xl">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full shadow-lg mb-4">
                    <i class="fas fa-envelope text-2xl text-purple-600"></i>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Contact Us</h1>
                <p class="text-white/80">We'd love to hear from you</p>
            </div>

            <!-- Contact Form -->
            <div class="glass-effect rounded-2xl shadow-2xl p-8">
                <div id="messages" class="mb-6"></div>
                
                <form id="publicContactForm" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="input-group">
                            <i class="fas fa-user"></i>
                            <input type="text" id="name" placeholder="Your Name" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" 
                                   required>
                        </div>
                        
                        <div class="input-group">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" placeholder="Your Email" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" 
                                   required>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <i class="fas fa-heading"></i>
                        <input type="text" id="subject" placeholder="Subject" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" 
                               required>
                    </div>
                    
                    <div class="input-group">
                        <i class="fas fa-comment-dots"></i>
                        <textarea id="message" rows="6" placeholder="Your Message" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 resize-none" 
                                  required></textarea>
                    </div>
                    
                    <button type="submit" class="btn-primary w-full py-4 text-white font-semibold rounded-lg shadow-lg">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Send Message
                    </button>
                </form>
                
                <!-- Back to Home -->
                <div class="text-center mt-6">
                    <a href="/" class="text-white/80 hover:text-white transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showMessage(message, type = 'success') {
            const messagesDiv = document.getElementById('messages');
            const bgColor = type === 'success' ? 'success-message' : 'error-message';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
            
            messagesDiv.innerHTML = `
                <div class="${bgColor} text-white px-6 py-4 rounded-lg relative fade-in" role="alert">
                    <div class="flex items-center">
                        <i class="fas ${icon} mr-3 text-xl"></i>
                        <span class="block text-lg">${message}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="absolute top-0 bottom-0 right-0 px-4 py-4 text-white/80 hover:text-white">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            setTimeout(() => messagesDiv.innerHTML = '', 5000);
        }

        document.getElementById('publicContactForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const submitBtn = e.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
            submitBtn.disabled = true;
            
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                subject: document.getElementById('subject').value,
                message: document.getElementById('message').value
            };
            
            try {
                const response = await fetch('/api/public/contact', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                    },
                    body: JSON.stringify(formData)
                });
                
                const result = await response.json();
                
                if (response.success) {
                    showMessage('Message sent successfully! We will get back to you soon.', 'success');
                    document.getElementById('publicContactForm').reset();
                } else {
                    showMessage(result.message || 'Failed to send message', 'error');
                }
            } catch (error) {
                showMessage('Network error. Please try again.', 'error');
            } finally {
                // Restore button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
    </script>
</body>
</html>
