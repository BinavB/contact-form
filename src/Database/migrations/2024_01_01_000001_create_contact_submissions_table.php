<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->id();

            // The authenticated user who submitted the form
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            $table->string('name');
            $table->string('email');
            $table->string('subject');
            $table->text('message');

            // read / unread for admin dashboard
            $table->boolean('is_read')->default(false);

            // soft-delete so admin can archive without permanent loss
            $table->softDeletes();
            $table->timestamps();

            // Indices for common filter queries
            $table->index('user_id');
            $table->index('created_at');
            $table->index('email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_submissions');
    }
};
