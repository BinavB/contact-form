<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Contact Form System</title>
    <script src="{{ asset('app.js') }}" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #fb923c 0%, #f97316 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .submission-card {
            border-left: 4px solid #f97316;
            transition: all 0.3s ease;
        }
        
        .submission-card:hover {
            border-left-color: #ea580c;
            background: #fff7ed;
        }
        
        .stats-card {
            background: linear-gradient(135deg, #fb923c 0%, #f97316 100%);
            color: white;
        }
        
        .loading-skeleton {
            background: linear-gradient(90deg, #fed7aa 25%, #fdba74 50%, #fed7aa 75%);
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
                        <i class="fas fa-user-shield text-orange-600"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-white">Admin Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-white">
                        <span class="text-sm opacity-90">Admin:</span>
                        <span id="adminName" class="font-semibold ml-1">Loading...</span>
                    </div>
                    <button id="logoutBtn" class="bg-red-600 hover:bg-red-700 px-4 py-2 text-white font-medium rounded-lg shadow-lg transition-colors">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="stats-card rounded-xl shadow-xl p-6 card-hover fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white/90 text-sm font-medium">Total Submissions</p>
                        <p id="totalSubmissions" class="text-3xl font-bold text-white mt-1">0</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-envelope text-white text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-xl p-6 card-hover fade-in" style="animation-delay: 0.1s">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-700 text-sm font-medium">Today</p>
                        <p id="todaySubmissions" class="text-3xl font-bold text-gray-900 mt-1">0</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-day text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-xl p-6 card-hover fade-in" style="animation-delay: 0.2s">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-700 text-sm font-medium">Unread</p>
                        <p id="unreadSubmissions" class="text-3xl font-bold text-gray-900 mt-1">0</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-envelope-open text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-xl p-6 card-hover fade-in" style="animation-delay: 0.3s">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-700 text-sm font-medium">This Month</p>
                        <p id="monthlySubmissions" class="text-3xl font-bold text-gray-900 mt-1">0</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-line text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submissions Table -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden card-hover fade-in" style="animation-delay: 0.4s">
            <div class="gradient-bg px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center justify-between">
                    <span>
                        <i class="fas fa-inbox mr-3"></i>
                        All Submissions
                    </span>
                    <span id="submissionCount" class="text-sm bg-white/20 px-3 py-1 rounded-full">
                        0
                    </span>
                </h2>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-4 font-semibold text-gray-800">ID</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-800">Name</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-800">Email</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-800">Subject</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-800">Date</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-800">Status</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-800">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="submissionsTableBody">
                            <tr>
                                <td colspan="7" class="text-center py-8">
                                    <div class="loading-skeleton h-4 w-32 mx-auto mb-4 rounded"></div>
                                    <div class="loading-skeleton h-3 w-24 mx-auto rounded"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        let currentAdmin = null;

        async function loadAdminData() {
            try {
                // Get admin token from cookies
                const adminToken = document.cookie
                    .split('; ')
                    .find(row => row.startsWith('admin_token='))
                    ?.split('=')[1];
                
                if (!adminToken) {
                    window.location.href = '/admin/login';
                    return;
                }
                
                // Load submissions
                const response = await fetch('/admin/contact-submissions', {
                    headers: {
                        'Authorization': `Bearer ${adminToken}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });
                
                if (response.redirected) {
                    window.location.href = response.url;
                    return;
                }
                
                const result = await response.json();
                
                if (result.success) {
                    displaySubmissions(result.data);
                    updateStats(result.data);
                } else {
                    window.location.href = '/admin/login';
                }
            } catch (error) {
                console.error('Failed to load admin data:', error);
                window.location.href = '/admin/login';
            }
        }

        function displaySubmissions(submissions) {
            const tbody = document.getElementById('submissionsTableBody');
            const submissionCount = document.getElementById('submissionCount');
            
            submissionCount.textContent = submissions.length;
            
            if (submissions.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center py-8">
                            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 text-lg font-medium">No submissions yet</p>
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = submissions.map((submission, index) => `
                <tr class="border-b hover:bg-gray-50 transition-colors">
                    <td class="py-3 px-4">
                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-sm">#${submission.id}</span>
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-gray-600 text-sm"></i>
                            </div>
                            <span class="font-medium">${submission.name}</span>
                        </div>
                    </td>
                    <td class="py-3 px-4 text-gray-600">${submission.email}</td>
                    <td class="py-3 px-4">
                        <div class="max-w-xs truncate" title="${submission.subject}">${submission.subject}</div>
                    </td>
                    <td class="py-3 px-4 text-gray-600 text-sm">
                        ${new Date(submission.submitted_at).toLocaleString()}
                    </td>
                    <td class="py-3 px-4">
                        ${submission.read_at ? 
                            '<span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Read</span>' : 
                            '<span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Unread</span>'
                        }
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex space-x-2">
                            <button onclick="viewSubmission(${submission.id})" class="text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors">
                                <i class="fas fa-eye mr-1"></i>View
                            </button>
                            <button onclick="deleteSubmission(${submission.id})" class="text-red-600 hover:text-red-800 text-sm font-medium transition-colors">
                                <i class="fas fa-trash mr-1"></i>Delete
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        function updateStats(submissions) {
            const totalSubmissions = document.getElementById('totalSubmissions');
            const todaySubmissions = document.getElementById('todaySubmissions');
            const unreadSubmissions = document.getElementById('unreadSubmissions');
            const monthlySubmissions = document.getElementById('monthlySubmissions');
            
            const today = new Date();
            const currentMonth = today.getMonth();
            const currentYear = today.getFullYear();
            
            const todayCount = submissions.filter(s => {
                const submissionDate = new Date(s.submitted_at);
                return submissionDate.toDateString() === today.toDateString();
            }).length;
            
            const unreadCount = submissions.filter(s => !s.read_at).length;
            
            const monthlyCount = submissions.filter(s => {
                const submissionDate = new Date(s.submitted_at);
                return submissionDate.getMonth() === currentMonth && submissionDate.getFullYear() === currentYear;
            }).length;
            
            totalSubmissions.textContent = submissions.length;
            todaySubmissions.textContent = todayCount;
            unreadSubmissions.textContent = unreadCount;
            monthlySubmissions.textContent = monthlyCount;
        }

        async function viewSubmission(id) {
            try {
                // Get admin token from cookies
                const adminToken = document.cookie
                    .split('; ')
                    .find(row => row.startsWith('admin_token='))
                    ?.split('=')[1];
                
                const response = await fetch(`/admin/contact-submissions/${id}`, {
                    headers: {
                        'Authorization': `Bearer ${adminToken}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });
                
                const result = await response.json();
                
                if (result.success) {
                    alert(`Subject: ${result.data.subject}\n\nFrom: ${result.data.name} (${result.data.email})\n\nMessage: ${result.data.message}\n\nSubmitted: ${result.data.submitted_at}`);
                    // Refresh data to mark as read
                    loadAdminData();
                }
            } catch (error) {
                console.error('Failed to view submission:', error);
            }
        }

        async function deleteSubmission(id) {
            if (!confirm('Are you sure you want to delete this submission?')) {
                return;
            }
            
            try {
                // Get admin token from cookies
                const adminToken = document.cookie
                    .split('; ')
                    .find(row => row.startsWith('admin_token='))
                    ?.split('=')[1];
                
                const response = await fetch(`/admin/contact-submissions/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${adminToken}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });
                
                const result = await response.json();
                
                if (result.success) {
                    loadAdminData();
                }
            } catch (error) {
                console.error('Failed to delete submission:', error);
            }
        }

        document.getElementById('logoutBtn').addEventListener('click', () => {
            // Clear admin token cookie
            document.cookie = 'admin_token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT';
            window.location.href = '/admin/login';
        });

        // Check if admin is logged in
        const adminToken = document.cookie
            .split('; ')
            .find(row => row.startsWith('admin_token='))
            ?.split('=')[1];
            
        if (!adminToken) {
            window.location.href = '/admin/login';
        } else {
            loadAdminData();
        }
    </script>
</body>
</html>
