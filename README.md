<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# Contact Form - Professional Laravel Package

A complete professional contact form system built with Laravel 12.x, featuring admin dashboard, JWT authentication, email notifications, and a modern UI.

## 🚀 Features

### 📝 **Contact Form**
- Public contact form with validation
- Fields: Name, Email, Subject, Message
- Real-time validation with user-friendly error messages
- Success notifications and confirmations

### 👨‍💼 **Admin Dashboard**
- Professional admin interface to manage submissions
- View all contact submissions in a beautiful table
- Filter submissions by email and date range
- Mark submissions as read/unread
- Delete submissions with confirmation
- Pagination support for large datasets
- Modal popup to view full message details

### 🔐 **Authentication & Security**
- JWT-based authentication system
- Role-based access control (Admin/User)
- Secure login with session management
- Admin-only access to dashboard
- CSRF protection

### 📧 **Email Notifications**
- Admin notification emails for new submissions
- User confirmation emails
- Professional HTML email templates
- Direct email sending (no job queues required)

### 🎨 **Modern UI/UX**
- Responsive design with Tailwind CSS
- Professional gradient backgrounds
- Font Awesome icons
- Mobile-friendly interface
- Smooth animations and transitions

### 🔌 **API Endpoints**
- RESTful API with JWT authentication
- User registration and login
- Submit contact forms via API
- View own submissions via API
- Proper error handling and JSON responses

## 🛠️ Technology Stack

- **Framework**: Laravel 12.x
- **Database**: MySQL
- **Authentication**: JWT (tymon/jwt-auth)
- **Frontend**: Tailwind CSS + Font Awesome
- **Email**: Laravel Mail system
- **Validation**: Laravel Form Requests

## 📋 Installation

### Prerequisites
- PHP 8.2+
- MySQL 5.7+
- Composer
- Git

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/BinavB/contact-form.git
   cd contact-form
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database configuration**
   Update your `.env` file with your MySQL credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=contact_form_test
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run migrations and seed**
   ```bash
   php artisan migrate:fresh
   php artisan db:seed --class=AdminUserSeeder
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   ```

## 🔑 Default Credentials

### Admin Account
- **Email**: `admin@example.com`
- **Password**: `password`
- **Role**: Admin (full access to dashboard)

### Test User Account
- **Email**: `user@example.com`
- **Password**: `password`
- **Role**: User (API access only)

## 🌐 Application Routes

### Web Routes
- **Landing Page**: `/` - Welcome page with navigation
- **Contact Form**: `/contact-form` - Public contact form
- **Admin Login**: `/auth/login` - Admin authentication
- **Admin Dashboard**: `/admin/contact-submissions` - Manage submissions

### API Routes
- **Register**: `POST /api/contact-form/register`
- **Login**: `POST /api/contact-form/login`
- **Logout**: `POST /api/contact-form/logout` (JWT protected)
- **Refresh Token**: `POST /api/contact-form/refresh` (JWT protected)
- **Get User**: `GET /api/contact-form/me` (JWT protected)
- **Submit Form**: `POST /api/contact-form/submit` (JWT protected)
- **My Submissions**: `GET /api/contact-form/my-submissions` (JWT protected)

## 📧 Email Configuration

Configure your email settings in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=your-mail-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

## 🗂️ Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── WebController.php
│   │   └── Api/
│   ├── Http/Requests/
│   ├── Mail/
│   └── Providers/
├── packages/ContactForm/
│   ├── src/
│   │   ├── Config/
│   │   ├── Database/Migrations/
│   │   ├── Http/
│   │   ├── Mail/
│   │   ├── Models/
│   │   ├── Routes/
│   │   └── Views/
├── database/
│   ├── migrations/
│   └── seeders/
└── routes/
    ├── web.php
    └── api.php
```

## 🎯 Usage Examples

### Submitting Contact Form (Web)
1. Visit `/contact-form`
2. Fill in the form with your details
3. Submit the form
4. Receive confirmation email

### Using the API

#### Register User
```bash
curl -X POST http://localhost:8000/api/contact-form/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

#### Login
```bash
curl -X POST http://localhost:8000/api/contact-form/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
```

#### Submit Contact Form (API)
```bash
curl -X POST http://localhost:8000/api/contact-form/submit \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_JWT_TOKEN" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "subject": "Test Subject",
    "message": "This is a test message."
  }'
```

## 🔧 Configuration

### Contact Form Configuration
The package configuration file (`config/contact-form.php`) includes:

- Admin email and name for notifications
- User and admin role definitions
- Pagination settings
- JWT guard configuration

### Customization
You can customize:
- Email templates in `packages/ContactForm/src/Views/emails/`
- UI components in `packages/ContactForm/src/Views/`
- Validation rules in request classes
- Email settings in configuration file

## 🐛 Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Ensure MySQL is running
   - Check `.env` database credentials
   - Create the database if it doesn't exist

2. **JWT Authentication Error**
   - Run `php artisan jwt:secret` to generate JWT key
   - Clear cache: `php artisan config:clear`

3. **Email Not Sending**
   - Verify email configuration in `.env`
   - Check mail server settings
   - Ensure firewall allows SMTP connections

4. **Route Not Found**
   - Clear routes cache: `php artisan route:clear`
   - Restart development server

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## 📞 Support

For support and questions:
- Create an issue in the GitHub repository
- Email: binav@example.com

---

**Built with ❤️ using Laravel 12.x**
