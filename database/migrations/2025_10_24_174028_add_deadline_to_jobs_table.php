<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            // Só cria a coluna se não existir
            if (!Schema::hasColumn('jobs', 'deadline')) {
                $table->date('deadline')->nullable()->after('budget');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            // Só remove se existir
            if (Schema::hasColumn('jobs', 'deadline')) {
                $table->dropColumn('deadline');
            }
        });
    }
};
