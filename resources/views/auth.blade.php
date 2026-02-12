<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form - Professional Authentication</title>
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
        
        .input-group i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            z-index: 10;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }
        
        .form-container {
            animation: slideUp 0.6s ease-out;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
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
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            right: 15%;
            animation-delay: 2s;
        }
        
        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            left: 70%;
            bottom: 20%;
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #9ca3af;
            z-index: 10;
        }
        
        .error-shake {
            animation: shake 0.5s;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <div class="form-container w-full max-w-md relative z-10">
        <div class="glass-effect rounded-2xl shadow-2xl p-8">
            <!-- Logo/Brand -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full shadow-lg mb-4">
                    <i class="fas fa-envelope text-2xl text-purple-600"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">
                    <span id="loginTitle" style="display: block;">Welcome Back</span>
                    <span id="registerTitle" style="display: none;">Create Account</span>
                </h1>
                <p class="text-gray-600 text-sm">
                    <span id="loginSubtitle">Sign in to your account to continue</span>
                    <span id="registerSubtitle" style="display: none;">Join us and get started</span>
                </p>
            </div>

            <div id="messages" class="mb-4"></div>

            <!-- Login Form -->
            <form id="loginForm" class="space-y-4">
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="loginEmail" placeholder="Email Address" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" required>
                    <div class="error text-red-500 text-xs mt-1" id="loginEmailError"></div>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="loginPassword" placeholder="Password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" required>
                    <i class="fas fa-eye password-toggle" onclick="togglePassword('loginPassword', this)"></i>
                    <div class="error text-red-500 text-xs mt-1" id="loginPasswordError"></div>
                </div>
                
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-purple-600 hover:text-purple-500 transition-colors">Forgot password?</a>
                </div>
                
                <button type="submit" class="btn-primary w-full py-3 text-white font-semibold rounded-lg shadow-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                </button>
            </form>

            <!-- Register Form -->
            <form id="registerForm" class="space-y-4" style="display: none;">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" id="registerName" placeholder="Full Name" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" required>
                    <div class="error text-red-500 text-xs mt-1" id="registerNameError"></div>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="registerEmail" placeholder="Email Address" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" required>
                    <div class="error text-red-500 text-xs mt-1" id="registerEmailError"></div>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="registerPassword" placeholder="Password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" required>
                    <i class="fas fa-eye password-toggle" onclick="togglePassword('registerPassword', this)"></i>
                    <div class="error text-red-500 text-xs mt-1" id="registerPasswordError"></div>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="registerPasswordConfirm" placeholder="Confirm Password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" required>
                    <i class="fas fa-eye password-toggle" onclick="togglePassword('registerPasswordConfirm', this)"></i>
                    <div class="error text-red-500 text-xs mt-1" id="registerPasswordConfirmError"></div>
                </div>
                
                <div class="flex items-center">
                    <input type="checkbox" id="terms" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500" required>
                    <label for="terms" class="ml-2 text-sm text-gray-600">
                        I agree to the <a href="#" class="text-purple-600 hover:text-purple-500">Terms & Conditions</a>
                    </label>
                </div>
                
                <button type="submit" class="btn-primary w-full py-3 text-white font-semibold rounded-lg shadow-lg">
                    <i class="fas fa-user-plus mr-2"></i>Create Account
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Or continue with</span>
                </div>
            </div>

            <!-- Social Login -->
            <div class="grid grid-cols-2 gap-3">
                <button class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fab fa-google text-red-500 mr-2"></i>
                    <span class="text-sm font-medium text-gray-700">Google</span>
                </button>
                <button class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fab fa-github text-gray-800 mr-2"></i>
                    <span class="text-sm font-medium text-gray-700">GitHub</span>
                </button>
            </div>

            <!-- Toggle Form -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">
                    <span id="toggleText">Don't have an account?</span>
                    <a href="#" id="toggleForm" class="font-medium text-purple-600 hover:text-purple-500 transition-colors ml-1">
                        <span id="toggleLink">Sign up</span>
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        let isLogin = true;

        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        document.getElementById('toggleForm').addEventListener('click', (e) => {
            e.preventDefault();
            isLogin = !isLogin;
            
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const loginTitle = document.getElementById('loginTitle');
            const registerTitle = document.getElementById('registerTitle');
            const loginSubtitle = document.getElementById('loginSubtitle');
            const registerSubtitle = document.getElementById('registerSubtitle');
            const toggleText = document.getElementById('toggleText');
            const toggleLink = document.getElementById('toggleLink');
            
            // Clear messages and errors
            document.getElementById('messages').innerHTML = '';
            document.querySelectorAll('.error').forEach(el => el.textContent = '');
            
            if (isLogin) {
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
                loginTitle.style.display = 'block';
                registerTitle.style.display = 'none';
                loginSubtitle.style.display = 'block';
                registerSubtitle.style.display = 'none';
                toggleText.textContent = "Don't have an account?";
                toggleLink.textContent = "Sign up";
            } else {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
                loginTitle.style.display = 'none';
                registerTitle.style.display = 'block';
                loginSubtitle.style.display = 'none';
                registerSubtitle.style.display = 'block';
                toggleText.textContent = "Already have an account?";
                toggleLink.textContent = "Sign in";
            }
        });

        function showMessage(message, type = 'success') {
            const messagesDiv = document.getElementById('messages');
            const bgColor = type === 'success' ? 'bg-green-50 border-green-200 text-green-800' : 
                           type === 'error' ? 'bg-red-50 border-red-200 text-red-800' : 
                           'bg-blue-50 border-blue-200 text-blue-800';
            
            messagesDiv.innerHTML = `
                <div class="${bgColor} border px-4 py-3 rounded-lg relative" role="alert">
                    <span class="block sm:inline">${message}</span>
                    <button onclick="this.parentElement.remove()" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            setTimeout(() => messagesDiv.innerHTML = '', 5000);
        }

        function showErrors(errors, formType) {
            // Clear all errors first
            document.querySelectorAll('.error').forEach(el => el.textContent = '');
            
            if (errors.name) document.getElementById('registerNameError').textContent = errors.name[0];
            if (errors.email) document.getElementById(`${formType}EmailError`).textContent = errors.email[0];
            if (errors.password) {
                document.getElementById(`${formType}PasswordError`).textContent = errors.password[0];
                if (formType === 'register') {
                    document.getElementById('registerPasswordConfirmError').textContent = errors.password[0];
                }
            }
            
            // Add shake animation to form
            const form = document.getElementById(`${formType}Form`);
            form.classList.add('error-shake');
            setTimeout(() => form.classList.remove('error-shake'), 500);
        }

        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            
            try {
                const result = await window.AuthAPI.login({ email, password });
                showMessage('Login successful! Redirecting to dashboard...', 'success');
                setTimeout(() => window.location.href = '/dashboard', 1500);
            } catch (error) {
                showMessage(error.message || 'Login failed. Please check your credentials.', 'error');
            }
        });

        document.getElementById('registerForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            console.log('Register form submitted');
            
            const name = document.getElementById('registerName').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            const password_confirmation = document.getElementById('registerPasswordConfirm').value;
            
            console.log('Form values:', { name, email, password: '***', password_confirmation: '***' });
            console.log('AuthAPI available:', typeof window.AuthAPI);
            console.log('AuthAPI methods:', window.AuthAPI ? Object.getOwnPropertyNames(Object.getPrototypeOf(window.AuthAPI)) : 'undefined');
            
            // Validate passwords match
            if (password !== password_confirmation) {
                showMessage('Passwords do not match', 'error');
                document.getElementById('registerPasswordConfirmError').textContent = 'Passwords do not match';
                return;
            }
            
            try {
                console.log('Calling AuthAPI.register...');
                const result = await window.AuthAPI.register({ 
                    name, email, password, password_confirmation 
                });
                console.log('Register result:', result);
                showMessage('Registration successful! Redirecting to dashboard...', 'success');
                setTimeout(() => window.location.href = '/dashboard', 1500);
            } catch (error) {
                console.error('Registration error:', error);
                if (error.errors) {
                    showErrors(error.errors, 'register');
                } else {
                    showMessage(error.message || 'Registration failed. Please try again.', 'error');
                }
            }
        });
    </script>
</body>
</html>
