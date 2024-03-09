<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        //
        DB::statement("
      CREATE VIEW viewParentChildLinx AS
      (
        SELECT DISTINCT
    user_id_1 AS childNode, pn.ParentNodes
FROM
    linx
    left join (SELECT user_id_1 as childNode,
    GROUP_CONCAT(user_id_2) AS parentNodes
FROM
    linx
WHERE
    isParent = 1 group by user_id_1) pn on pn.childNode = linx.user_id_1
WHERE
    isParent = 1
      )
    ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS viewParentChildLinx');
    }
};
