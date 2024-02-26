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
        Schema::table("relationships", function (Blueprint $table) {

            $table->renameColumn("parent_flag", "isDirect");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("relationships", function (Blueprint $table) {
            $table->dateTime("updated_at");
            $table->dateTime("created_at");
            $table->string("description")->nullable();
            $table->boolean("includes_adopted")->nullable();
            $table->boolean("includes_half")->nullable();
            $table->boolean("includes_step")->nullable();
            $table->renameColumn("isDirect", "parent_flag");
        });
    }
};
