<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linx', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id_1')->nullable(false);
            $table->unsignedBigInteger('user_id_2')->nullable(false);
            $table->unsignedBigInteger('relationship_type_id')->nullable(false);
            $table->date('start_date')->nullable();
            $table->tinyInteger('is_biological')->unsigned()->nullable();

            $table->foreign('user_id_1')->references('id')->on('users');
            $table->foreign('user_id_2')->references('id')->on('users');
            $table->foreign('relationship_type_id')->references('id')->on('relationships');

            // Consider adding unique constraint or index based on your needs
            $table->unique(['user_id_1', 'user_id_2', 'relationship_type_id']);
            $table->index(['user_id_1', 'user_id_2']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('linx');
    }
}
