@extends('contact-form::layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="max-w-4xl mx-auto text-center px-4">
        <div class="bg-white rounded-2xl shadow-xl p-12">
            <div class="mb-8">
                <i class="fas fa-envelope-open-text text-6xl text-blue-600 mb-4"></i>
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to Our Contact Portal</h1>
                <p class="text-xl text-gray-600 mb-8">
                    Get in touch with us through our professional contact form. We value your feedback and will respond promptly.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 mb-8">
                <div class="bg-blue-50 rounded-lg p-6">
                    <i class="fas fa-paper-plane text-3xl text-blue-600 mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Quick Contact</h3>
                    <p class="text-gray-600 mb-4">Send us a message directly through our contact form.</p>
                    <a href="{{ route('contact-form.form') }}" class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-envelope mr-2"></i>
                        Contact Us
                    </a>
                </div>

                <div class="bg-purple-50 rounded-lg p-6">
                    <i class="fas fa-user-shield text-3xl text-purple-600 mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Admin Access</h3>
                    <p class="text-gray-600 mb-4">Administrators can login to manage submissions.</p>
                    <a href="{{ route('auth.login') }}" class="inline-flex items-center bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Admin Login
                    </a>
                </div>
            </div>

            <div class="border-t pt-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Why Contact Us?</h2>
                <div class="grid md:grid-cols-3 gap-6 text-left">
                    <div class="text-center">
                        <i class="fas fa-clock text-2xl text-green-600 mb-2"></i>
                        <h4 class="font-semibold text-gray-800">Quick Response</h4>
                        <p class="text-gray-600 text-sm">We respond within 24 hours</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-lock text-2xl text-blue-600 mb-2"></i>
                        <h4 class="font-semibold text-gray-800">Secure</h4>
                        <p class="text-gray-600 text-sm">Your information is protected</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-users text-2xl text-purple-600 mb-2"></i>
                        <h4 class="font-semibold text-gray-800">Professional</h4>
                        <p class="text-gray-600 text-sm">Expert team ready to help</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
