<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Só cria a tabela se não existir
        if (!Schema::hasTable('job_applications')) {
            Schema::create('job_applications', function (Blueprint $table) {
                $table->id();
                $table->foreignId('job_id')->constrained('jobs')->onDelete('cascade');
                $table->foreignId('freelancer_id')->constrained('users')->onDelete('cascade');
                $table->text('proposal_text');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        // Só remove se a tabela existir
        if (Schema::hasTable('job_applications')) {
            Schema::dropIfExists('job_applications');
        }
    }
};
