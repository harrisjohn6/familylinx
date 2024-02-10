<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. Add the column
            $table->string('biological_sex')->nullable()->after('gender_id');

            // 2. Set the default to 'Other'
            //DB::statement("UPDATE users SET biological_sex = 'Other' WHERE biological_sex IS NULL");
        });
    }


    /**
     * Reverse the migrations.
     */
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('biological_sex');
        });
    }
};
