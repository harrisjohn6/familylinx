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
        Schema::drop("linx");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create("linx", function (Blueprint $table) {
            $table->increments("id");
            $table->integer("user_id_1");
            $table->integer("user_id_2");
            $table->integer("relationship_type_id");
            $table->dateTime("created_at");
            $table->dateTime("updated_at");
            $table->boolean("is_biological");
        });
    }
};
