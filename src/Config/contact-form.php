<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Email
    |--------------------------------------------------------------------------
    | The email address that receives admin notifications for every new
    | contact-form submission.
    */
    'admin_email' => env('CONTACT_FORM_ADMIN_EMAIL', 'admin@example.com'),

    /*
    |--------------------------------------------------------------------------
    | Admin Name
    |--------------------------------------------------------------------------
    */
    'admin_name' => env('CONTACT_FORM_ADMIN_NAME', 'Site Admin'),

    /*
    |--------------------------------------------------------------------------
    | Mail Queue Connection
    |--------------------------------------------------------------------------
    | Which queue connection should be used for notification emails.
    | Set to 'sync' to dispatch synchronously (useful in testing).
    */
    'queue_connection' => env('CONTACT_FORM_QUEUE', 'default'),

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    | Number of submissions per page in admin dashboard.
    */
    'per_page' => 15,

    /*
    |--------------------------------------------------------------------------
    | JWT Guard
    |--------------------------------------------------------------------------
    | The guard used for JWT authentication in API routes.
    */
    'jwt_guard' => 'api',

    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    | The Eloquent model used for the authenticated user.
    */
    'user_model' => \App\Models\User::class,

];
