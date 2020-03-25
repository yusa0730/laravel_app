<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 存在するテーブルを更新するには、Schemaファサードのtableメソッドを使います。createメソッドと同様に、tableメソッドは２つの引数を取ります。テーブルの名前と、テーブルにカラムを追加するために使用するBlueprintインスタンスを受け取る「クロージャ」です。
        // todoを作成する際にログインしているユーザー固有の id をtodos tableのuser_idに格納しtodos tableとusers tableを関連づけます。
        Schema::table('todos', function (Blueprint $table) {
            $table->integer('user_id');
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
            $table->dropColumn('user_id');
        });
    }
}
