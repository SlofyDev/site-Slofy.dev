<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Campos de contato específicos para freelancers
            $table->string('contact_email')->nullable()->after('phone');
            $table->string('linkedin')->nullable()->after('contact_email');
            $table->string('whatsapp')->nullable()->after('linkedin');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['contact_email', 'linkedin', 'whatsapp']);
        });
    }
};