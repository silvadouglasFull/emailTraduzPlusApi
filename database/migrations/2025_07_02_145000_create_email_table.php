<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id('email_id');
            $table->string('recipient_email', 255);
            $table->string('subject', 255);
            $table->text('body');
            $table->enum('status', ['pending', 'sent', 'failed'])->default('pending');
            $table->timestamps(); // Cria 'created_at' e 'updated_at'
            $table->timestamp('sent_at')->nullable();
            $table->string('error_message', 512)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email');
    }
};
