<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationships', function (Blueprint $table) {
            $table->id();
            $table->string('relationship_title')->unique();
            $table->enum('parent_flag', ['0', '1'])->default('0');
            $table->enum('includes_step', ['YES', 'NO', 'UNKNOWN'])->nullable();
            $table->enum('includes_half', ['YES', 'NO', 'UNKNOWN'])->nullable();
            $table->enum('includes_adopted', ['YES', 'NO', 'UNKNOWN'])->nullable();
            $table->mediumText('description')->nullable();
            $table->timestamps();

            $table->unique(['parent_flag', 'relationship_title']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relationships');
    }
};
