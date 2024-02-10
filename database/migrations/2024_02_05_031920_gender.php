<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->addColumn('Integer', 'gender')->default('0');
            $table->addColumn('date', 'date_birth')->default('1800-01-01');

        });

    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gender');

        schema::table('users', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('date_birth');
        });
    }
};
