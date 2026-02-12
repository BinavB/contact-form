<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Dashboard</title>
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
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%);
            transition: all 0.3s ease;
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(244, 63, 94, 0.4);
        }
        
        .submission-card {
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }
        
        .submission-card:hover {
            border-left-color: #764ba2;
            background: #f8fafc;
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="gradient-bg shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center justify-center w-10 h-10 bg-white rounded-full shadow-lg">
                        <i class="fas fa-envelope text-purple-600"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-white">Contact Form Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-white">
                        <span class="text-sm opacity-90">Welcome,</span>
                        <span id="userName" class="font-semibold ml-1">Loading...</span>
                    </div>
                    <div class="relative">
                        <img id="userAvatar" src="https://ui-avatars.com/api/?name=User&background=667eea&color=fff" 
                             alt="User Avatar" class="w-10 h-10 rounded-full border-2 border-white shadow-lg">
                        <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-400 rounded-full border-2 border-white"></div>
                    </div>
                    <button id="logoutBtn" class="btn-danger px-4 py-2 text-white font-medium rounded-lg shadow-lg">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="stats-card rounded-xl shadow-xl p-6 card-hover fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white/80 text-sm font-medium">Total Submissions</p>
                        <p id="totalSubmissions" class="text-3xl font-bold text-white mt-1">0</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-paper-plane text-white text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-xl p-6 card-hover fade-in" style="animation-delay: 0.1s">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">This Month</p>
                        <p id="monthlySubmissions" class="text-3xl font-bold text-gray-800 mt-1">0</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-xl p-6 card-hover fade-in" style="animation-delay: 0.2s">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Response Rate</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">100%</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-line text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Contact Form -->
            <div class="fade-in" style="animation-delay: 0.3s">
                <div class="bg-white rounded-xl shadow-xl overflow-hidden card-hover">
                    <div class="gradient-bg px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-edit mr-3"></i>
                            Send New Message
                        </h2>
                    </div>
                    <div class="p-6">
                        <div id="formMessages" class="mb-4"></div>
                        <form id="contactForm" class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-user mr-2 text-purple-600"></i>Full Name
                                </label>
                                <input type="text" id="name" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" 
                                       required>
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-envelope mr-2 text-purple-600"></i>Email Address
                                </label>
                                <input type="email" id="email" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" 
                                       required>
                            </div>
                            
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-heading mr-2 text-purple-600"></i>Subject
                                </label>
                                <input type="text" id="subject" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" 
                                       required>
                            </div>
                            
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-comment-dots mr-2 text-purple-600"></i>Message
                                </label>
                                <textarea id="message" rows="4" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 resize-none" 
                                          required></textarea>
                            </div>
                            
                            <button type="submit" class="btn-primary w-full py-3 text-white font-semibold rounded-lg shadow-lg">
                                <i class="fas fa-paper-plane mr-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Submissions List -->
            <div class="fade-in" style="animation-delay: 0.4s">
                <div class="bg-white rounded-xl shadow-xl overflow-hidden card-hover">
                    <div class="gradient-bg px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center justify-between">
                            <span>
                                <i class="fas fa-history mr-3"></i>
                                Your Submissions
                            </span>
                            <span id="submissionCount" class="text-sm bg-white/20 px-3 py-1 rounded-full">
                                0
                            </span>
                        </h2>
                    </div>
                    <div class="p-6">
                        <div id="submissionsList" class="space-y-4 max-h-96 overflow-y-auto">
                            <div class="text-center py-8">
                                <div class="loading-skeleton h-4 w-32 mx-auto mb-4 rounded"></div>
                                <div class="loading-skeleton h-3 w-24 mx-auto rounded"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        let currentUser = null;

        async function loadUser() {
            try {
                const result = await window.AuthAPI.me();
                currentUser = result.user;
                
                // Update UI with user data
                document.getElementById('userName').textContent = currentUser.name;
                document.getElementById('userAvatar').src = `https://ui-avatars.com/api/?name=${encodeURIComponent(currentUser.name)}&background=667eea&color=fff`;
                
                // Pre-fill form with user data
                document.getElementById('name').value = currentUser.name;
                document.getElementById('email').value = currentUser.email;
            } catch (error) {
                console.error('Failed to load user:', error);
                window.location.href = '/auth';
            }
        }

        async function loadSubmissions() {
            try {
                const result = await window.AuthAPI.getMySubmissions();
                const submissionsList = document.getElementById('submissionsList');
                const submissionCount = document.getElementById('submissionCount');
                const totalSubmissions = document.getElementById('totalSubmissions');
                const monthlySubmissions = document.getElementById('monthlySubmissions');
                
                submissionCount.textContent = result.data.length;
                totalSubmissions.textContent = result.data.length;
                
                // Calculate monthly submissions
                const currentMonth = new Date().getMonth();
                const currentYear = new Date().getFullYear();
                const monthlyCount = result.data.filter(submission => {
                    const submissionDate = new Date(submission.submitted_at);
                    return submissionDate.getMonth() === currentMonth && submissionDate.getFullYear() === currentYear;
                }).length;
                monthlySubmissions.textContent = monthlyCount;
                
                if (result.data.length === 0) {
                    submissionsList.innerHTML = `
                        <div class="text-center py-8">
                            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 text-lg font-medium">No submissions yet</p>
                            <p class="text-gray-400 text-sm mt-2">Send your first message to get started!</p>
                        </div>
                    `;
                    return;
                }

                submissionsList.innerHTML = result.data.map((submission, index) => `
                    <div class="submission-card bg-gray-50 rounded-lg p-4 fade-in" style="animation-delay: ${index * 0.1}s">
                        <div class="flex items-start justify-between mb-2">
                            <h4 class="font-semibold text-gray-800 flex items-center">
                                <i class="fas fa-envelope-open text-purple-600 mr-2"></i>
                                ${submission.subject}
                            </h4>
                            <span class="text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded-full">
                                #${submission.id}
                            </span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-2">
                            <i class="fas fa-user mr-2"></i>
                            <span>${submission.email}</span>
                        </div>
                        <p class="text-gray-700 text-sm mb-3 line-clamp-2">${submission.message}</p>
                        <div class="flex items-center justify-between">
                            <div class="text-xs text-gray-500">
                                <i class="fas fa-clock mr-1"></i>
                                ${new Date(submission.submitted_at).toLocaleString()}
                            </div>
                            <button onclick="viewSubmission(${submission.id})" 
                                    class="text-purple-600 hover:text-purple-800 text-sm font-medium transition-colors">
                                <i class="fas fa-eye mr-1"></i>View
                            </button>
                        </div>
                    </div>
                `).join('');
            } catch (error) {
                console.error('Failed to load submissions:', error);
                document.getElementById('submissionsList').innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-exclamation-triangle text-6xl text-red-300 mb-4"></i>
                        <p class="text-red-500 text-lg font-medium">Failed to load submissions</p>
                        <button onclick="loadSubmissions()" class="mt-3 text-purple-600 hover:text-purple-800 font-medium">
                            <i class="fas fa-sync-alt mr-2"></i>Try Again
                        </button>
                    </div>
                `;
            }
        }

        function viewSubmission(id) {
            // This could open a modal or navigate to a detailed view
            console.log('View submission:', id);
        }

        function showMessage(message, type = 'success') {
            const messagesDiv = document.getElementById('formMessages');
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

        document.getElementById('contactForm').addEventListener('submit', async (e) => {
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
                const result = await window.AuthAPI.submitContactForm(formData);
                showMessage('Message sent successfully! 🎉', 'success');
                document.getElementById('contactForm').reset();
                
                // Restore user data
                if (currentUser) {
                    document.getElementById('name').value = currentUser.name;
                    document.getElementById('email').value = currentUser.email;
                }
                
                // Refresh submissions list
                loadSubmissions();
                
                // Add pulse animation to submission count
                document.getElementById('submissionCount').classList.add('pulse-animation');
                setTimeout(() => {
                    document.getElementById('submissionCount').classList.remove('pulse-animation');
                }, 2000);
                
            } catch (error) {
                showMessage(error.message || 'Failed to send message', 'error');
            } finally {
                // Restore button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });

        document.getElementById('logoutBtn').addEventListener('click', async () => {
            try {
                await window.AuthAPI.logout();
                window.location.href = '/auth';
            } catch (error) {
                console.error('Logout failed:', error);
                window.location.href = '/auth';
            }
        });

        // Check if user is authenticated
        if (!window.AuthAPI.isAuthenticated()) {
            window.location.href = '/auth';
        } else {
            loadUser();
            loadSubmissions();
        }
    </script>
</body>
</html>
