<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form System</title>
    <script src="{{ asset('app.js') }}" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 50%, #dc2626 100%);
        }
        
        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4v-4z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .feature-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(135deg, #f97316, #ea580c) border-box;
        }
        
        .feature-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 30px 60px -15px rgba(249, 115, 22, 0.3);
            border-color: #f97316;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -10px rgba(249, 115, 22, 0.4);
        }
        
        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-3px);
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        
        .stats-number {
            background: linear-gradient(135deg, #f97316, #ea580c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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
            animation: float 8s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Hero Section -->
    <section class="hero-gradient hero-pattern text-white py-24 relative overflow-hidden">
        <div class="floating-shapes">
            <div class="shape" style="width: 100px; height: 100px; left: 10%; top: 20%; animation-delay: 0s;"></div>
            <div class="shape" style="width: 150px; height: 150px; right: 15%; top: 60%; animation-delay: 2s;"></div>
            <div class="shape" style="width: 80px; height: 80px; left: 70%; bottom: 30%; animation-delay: 4s;"></div>
            <div class="shape" style="width: 120px; height: 120px; right: 25%; top: 10%; animation-delay: 6s;"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-full shadow-2xl mb-8 float-animation">
                    <i class="fas fa-envelope-open-text text-4xl text-orange-600"></i>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold mb-6 fade-in">Contact Form System</h1>
                <p class="text-xl md:text-2xl opacity-95 max-w-3xl mx-auto mb-12 fade-in" style="animation-delay: 0.2s">
                    Professional contact management with seamless communication and powerful admin dashboard
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center fade-in" style="animation-delay: 0.4s">
                    <a href="/contact-form" class="btn-primary inline-flex items-center px-8 py-4 text-white font-bold rounded-2xl shadow-2xl text-lg">
                        <i class="fas fa-paper-plane mr-3"></i>
                        Access Contact Form
                    </a>
                    <a href="/admin/login" class="btn-secondary inline-flex items-center px-8 py-4 text-white font-bold rounded-2xl shadow-xl text-lg">
                        <i class="fas fa-user-shield mr-3"></i>
                        Admin Login
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Powerful Features</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Everything you need for professional contact management
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="feature-card bg-white rounded-2xl p-8 fade-in" style="animation-delay: 0.1s">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-lock text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Secure Authentication</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">JWT-based authentication with role-based access control and secure session management</p>
                </div>
                
                <div class="feature-card bg-white rounded-2xl p-8 fade-in" style="animation-delay: 0.2s">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-envelope-open-text text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Email Notifications</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">Instant email alerts for new contact submissions with detailed information</p>
                </div>
                
                <div class="feature-card bg-white rounded-2xl p-8 fade-in" style="animation-delay: 0.3s">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Analytics Dashboard</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">Comprehensive admin dashboard with real-time statistics and submission management</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-gradient-to-br from-orange-50 to-red-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div class="fade-in" style="animation-delay: 0.1s">
                    <div class="text-5xl font-bold stats-number mb-2">24/7</div>
                    <div class="text-lg text-gray-700 font-medium">Availability</div>
                </div>
                <div class="fade-in" style="animation-delay: 0.2s">
                    <div class="text-5xl font-bold stats-number mb-2">100%</div>
                    <div class="text-lg text-gray-700 font-medium">Uptime</div>
                </div>
                <div class="fade-in" style="animation-delay: 0.3s">
                    <div class="text-5xl font-bold stats-number mb-2">SSL</div>
                    <div class="text-lg text-gray-700 font-medium">Secured</div>
                </div>
                <div class="fade-in" style="animation-delay: 0.4s">
                    <div class="text-5xl font-bold stats-number mb-2">API</div>
                    <div class="text-lg text-gray-700 font-medium">Ready</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 hero-gradient text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-6">Ready to Get Started?</h2>
            <p class="text-xl mb-8 opacity-95">Join thousands of users who trust our contact management system</p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="/contact-form" class="btn-primary inline-flex items-center px-8 py-4 text-white font-bold rounded-2xl shadow-2xl text-lg">
                    <i class="fas fa-rocket mr-3"></i>
                    Try Contact Form
                </a>
                <a href="/admin/login" class="btn-secondary inline-flex items-center px-8 py-4 text-white font-bold rounded-2xl shadow-xl text-lg">
                    <i class="fas fa-cog mr-3"></i>
                    Admin Panel
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-orange-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-envelope text-white"></i>
                        </div>
                        <span class="text-xl font-bold">Contact Form System</span>
                    </div>
                </div>
                <div class="text-center md:text-right">
                    <p class="text-gray-400">&copy; 2024 Contact Form System. All rights reserved.</p>
                    <p class="text-gray-500 text-sm mt-1">Built with Laravel & Modern Web Technologies</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
