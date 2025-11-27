<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Apenas as 3 colunas que realmente faltam
            if (!Schema::hasColumn('users', 'business_hours')) {
                $table->string('business_hours', 100)->nullable()->after('phone');
            }
            
            if (!Schema::hasColumn('users', 'company_description')) {
                $table->text('company_description')->nullable()->after('business_hours');
            }
            
            if (!Schema::hasColumn('users', 'sector')) {
                $table->string('sector', 100)->nullable()->after('company_description');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['business_hours', 'company_description', 'sector']);
        });
    }
};