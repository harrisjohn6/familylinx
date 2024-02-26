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
        Schema::table("users", function (Blueprint $table) {
            $table->renameColumn("date_birth", "dateBirth");
            $table->renameColumn("is_registered", "isRegistered");
            $table->renameColumn("gender_id", "genderId");
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("users", function (Blueprint $table) {
            $table->renameColumn("dateBirth", "date_birth");
            $table->renameColumn("isRegistered", "is_registered");
            $table->renameColumn("genderId", "gender_id");
        });
    }
};
