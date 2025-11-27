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
        Schema::table('users', function (Blueprint $table) {
            // Adiciona o campo de gênero, se ainda não existir
            if (!Schema::hasColumn('users', 'gender')) {
                $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('email');
            }

            // Garante que o campo de imagem de perfil existe, mas não cria duplicado
            if (!Schema::hasColumn('users', 'profile_image')) {
                $table->string('profile_image')->nullable()->after('gender');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove os campos se existirem
            if (Schema::hasColumn('users', 'gender')) {
                $table->dropColumn('gender');
            }

            // Só remove profile_image se ela tiver sido criada por essa migration
            // (não remova se já existia antes)
            if (Schema::hasColumn('users', 'profile_image')) {
                // ⚠️ Descomente a linha abaixo apenas se tiver certeza que foi criada aqui
                // $table->dropColumn('profile_image');
            }
        });
    }
};
