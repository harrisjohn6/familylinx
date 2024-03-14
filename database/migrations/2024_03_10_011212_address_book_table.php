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
        Schema::create("addressBook", function (Blueprint $table) {
            $table->increments("addressId");
            $table->integer("linkedToUserId");
            $table->foreign('linkedToUserId')->references('id')->on('users')->onDelete('cascade');
            $table->string("Name");
            $table->string("address1");
            $table->string("address2");
            $table->string("city");
            $table->string("state");
            $table->string("postalCode");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addressBook');
    }
};
