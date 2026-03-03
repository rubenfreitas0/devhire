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
        if (Schema::hasColumn('employers', 'logo')) {
            Schema::table('employers', function (Blueprint $table) {
                $table->dropColumn('logo');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('employers', 'logo')) {
            Schema::table('employers', function (Blueprint $table) {
                $table->string('logo')->nullable();
            });
        }
    }
};
