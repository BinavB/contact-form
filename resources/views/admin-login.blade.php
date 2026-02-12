<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - Contact Form System</title>
    <script src="{{ asset('app.js') }}" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
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
        
        .input-group i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            z-index: 10;
        }
        
        .btn-admin {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            transition: all 0.3s ease;
        }
        
        .btn-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(30, 41, 59, 0.4);
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .error-shake {
            animation: shake 0.5s;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }
        
        .shield-icon {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <div class="floating-shapes">
        <div class="shape" style="width: 80px; height: 80px; left: 10%; animation-delay: 0s;"></div>
        <div class="shape" style="width: 120px; height: 120px; right: 15%; animation-delay: 2s;"></div>
        <div class="shape" style="width: 60px; height: 60px; left: 70%; bottom: 20%; animation-delay: 4s;"></div>
    </div>
    
    <div class="w-full max-w-md relative z-10">
        <div class="glass-effect rounded-2xl shadow-2xl p-8 fade-in">
            <!-- Logo/Brand -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 shield-icon rounded-full shadow-lg mb-4">
                    <i class="fas fa-user-shield text-2xl text-white"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Admin Login</h1>
                <p class="text-gray-600 text-sm">Enter your admin credentials</p>
            </div>

            <div id="messages" class="mb-4"></div>

            <!-- Login Form -->
            <form id="adminLoginForm" class="space-y-4">
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" placeholder="Admin Email" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent transition-all duration-200" 
                           required>
                    <div class="error text-red-500 text-xs mt-1" id="emailError"></div>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" placeholder="Admin Password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent transition-all duration-200" 
                           required>
                    <div class="error text-red-500 text-xs mt-1" id="passwordError"></div>
                </div>
                
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-gray-800 focus:ring-gray-500">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-gray-600 hover:text-gray-800 transition-colors">Forgot password?</a>
                </div>
                
                <button type="submit" class="btn-admin w-full py-3 text-white font-semibold rounded-lg shadow-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Admin Login
                </button>
            </form>

            <!-- Back to Home -->
            <div class="text-center mt-6">
                <a href="/" class="text-gray-600 hover:text-gray-800 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Home
                </a>
            </div>
        </div>
    </div>

    <style>
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
    </style>

    <script>
        function showMessage(message, type = 'error') {
            const messagesDiv = document.getElementById('messages');
            const bgColor = type === 'success' ? 'bg-green-50 border-green-200 text-green-800' : 
                           type === 'error' ? 'bg-red-50 border-red-200 text-red-800' : 
                           'bg-blue-50 border-blue-200 text-blue-800';
            
            const icon = type === 'success' ? 'fa-check-circle' : 
                        type === 'error' ? 'fa-exclamation-circle' : 
                        'fa-info-circle';
            
            messagesDiv.innerHTML = `
                <div class="${bgColor} border px-4 py-3 rounded-lg relative fade-in" role="alert">
                    <div class="flex items-center">
                        <i class="fas ${icon} mr-3"></i>
                        <span class="block">${message}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            setTimeout(() => messagesDiv.innerHTML = '', 5000);
        }

        function showErrors(errors) {
            // Clear all errors first
            document.querySelectorAll('.error').forEach(el => el.textContent = '');
            
            if (errors.email) document.getElementById('emailError').textContent = errors.email[0];
            if (errors.password) document.getElementById('passwordError').textContent = errors.password[0];
            
            // Add shake animation to form
            const form = document.getElementById('adminLoginForm');
            form.classList.add('error-shake');
            setTimeout(() => form.classList.remove('error-shake'), 500);
        }

        document.getElementById('adminLoginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            console.log('Attempting admin login with:', { email, password: '***' });
            
            try {
                const response = await fetch('/api/admin/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                    },
                    body: JSON.stringify({ email, password })
                });
                
                console.log('Response status:', response.status);
                const result = await response.json();
                console.log('Response data:', result);
                
                if (result.success) {
                    console.log('Login successful, storing token...');
                    // Store admin token in session via cookie
                    document.cookie = `admin_token=${result.token}; path=/; max-age=3600`;
                    showMessage('Login successful! Redirecting...', 'success');
                    console.log('Redirecting to /admin/dashboard...');
                    setTimeout(() => {
                        console.log('Performing redirect...');
                        window.location.href = '/admin/dashboard';
                    }, 1500);
                } else {
                    console.log('Login failed:', result);
                    if (result.errors) {
                        showErrors(result.errors);
                    } else {
                        showMessage(result.message || 'Login failed. Please check your credentials.', 'error');
                    }
                }
            } catch (error) {
                console.error('Login error:', error);
                showMessage('Network error. Please try again.', 'error');
            }
        });
    </script>
</body>
</html>
