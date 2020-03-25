<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // マイグレーションとはデータベースのバージョンコントロールのような機能です。どのような SQL をどの順番で実行したかを管理します
    // マイグレーションはupとdownの２メソッドを含んでいます。upメソッドは新しいテーブル、カラム、インデックスをデータベースに追加するために使用し、一方のdownメソッドはupメソッドが行った操作を元に戻します。
    public function up()
    {
        // テーブルの作成はSchemaクラスのcreateメソッドを使って行う。createメソッドは第一引数にテーブル名、第二引数にテーブルを作成するための処理をまとめたクロージャが用意されている。
        // フィールドの設定はクロージャ(無名関数=関数名を指定しなくても関数を作成できるものです。)の引数として渡されるBlueprintクラスのメソッドを使って行う。
        // 変更に強い
        Schema::create('todos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // downメソッドはupメソッドが行った操作を元に戻します。
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
