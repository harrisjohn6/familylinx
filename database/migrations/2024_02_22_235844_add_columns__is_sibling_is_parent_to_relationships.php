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
        Schema::table('relationships', function (Blueprint $table) {
            $table->boolean('isSibling')->default(false);
            $table->boolean('isParent')->default(false);
        });

        Schema::table('linx', function (Blueprint $tableII) {
            $tableII->boolean('isSibling')->default(false);
            $tableII->boolean('isParent')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('relationships', function (Blueprint $table) {
            $table->dropColumn('isSibling');
            $table->dropColumn('isParent');
        });

        Schema::table('linx', function (Blueprint $tableII) {
            $tableII->dropColumn('isSibling');
            $tableII->dropColumn('isParent');
        });
    }
};
