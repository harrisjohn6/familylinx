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
            $table->string("nameFirst")->nullable()->before("name");
            $table->string("nameMiddle")->nullable()->before("name");
            $table->string("nameLast")->nullable()->before("name");
            $table->string("namePrefix")->nullable()->after("id");
            $table->string("nameSuffix")->nullable()->after("name");

        });

        Schema::table("users", function (Blueprint $table) {
            $table->renameColumn("address_line_1", "addressLine1");
            $table->renameColumn("address_line_2", "addressLine2");
            $table->renameColumn("biological_sex", "biologicalSex");
            $table->renameColumn("zip_code", "zip");
            $table->renameColumn("phone_number", "phoneNumber");
            $table->renameColumn("phone_type", "phoneType");
            $table->renameColumn("profile_photo", "profilePhoto");
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("users", function (Blueprint $table) {
            $table->renameColumn("addressLine1", "address_line_1");
            $table->renameColumn("addressLine2", "address_line_2", );
            $table->renameColumn("biologicalSex", "biological_sex");
            $table->renameColumn("zip", "zip_code");
            $table->renameColumn("phoneNumber", "phone_number");
            $table->renameColumn("phoneType", "phone_type");
            $table->renameColumn("profilePhoto", "profile_photo");
        });

        Schema::table("users", function (Blueprint $table) {
            $table->dropColumn("nameFirst");
            $table->dropColumn("nameMiddle");
            $table->dropColumn("nameLast");
            $table->dropColumn("namePrefix");
            $table->dropColumn("nameSuffix");

        });
    }

};
