<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSoftDeletesTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 存在するテーブルを更新するには、Schemaファサードのtableメソッドを使います。createメソッドと同様に、tableメソッドは２つの引数を取ります。テーブルの名前と、テーブルにカラムを追加するために使用するBlueprintインスタンスを受け取る「クロージャ」です。
        Schema::table('todos', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}
