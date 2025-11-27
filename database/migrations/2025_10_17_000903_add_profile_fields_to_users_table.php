<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Adiciona novos campos à tabela users.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Papel do usuário: freelancer ou empresa
            $table->string('role')->after('password');

            // Campos para Freelancer
            $table->text('bio')->nullable()->after('role');
            $table->string('skills')->nullable()->after('bio');
            $table->string('experience')->nullable()->after('skills');
            $table->string('education')->nullable()->after('experience');
            $table->string('specialization')->nullable()->after('education');
            $table->date('date_of_birth')->nullable()->after('specialization');
            $table->string('cpf')->nullable()->unique()->after('date_of_birth');

            // Campos para Empresa
            $table->string('company_name')->nullable()->after('cpf');
            $table->string('cnpj')->nullable()->unique()->after('company_name');
            $table->string('website')->nullable()->after('cnpj');
            $table->string('phone')->nullable()->after('website');

            // Foto de perfil
            $table->string('profile_image')->nullable()->after('phone');
        });
    }

    /**
     * Remove os campos caso o rollback seja executado.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'bio',
                'skills',
                'experience',
                'education',
                'specialization',
                'date_of_birth',
                'cpf',
                'company_name',
                'cnpj',
                'website',
                'phone',
                'profile_image',
            ]);
        });
    }
};
