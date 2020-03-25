<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // マイグレーションとはデータベースのバージョンコントロールのような機能です。
    // マイグレーションはupとdownの２メソッドを含んでいます。upメソッドは新しいテーブル、カラム、インデックスをデータベースに追加するために使用し、一方のdownメソッドはupメソッドが行った操作を元に戻します。
    public function up()
    {
        // テーブルの作成はSchemaクラスのcreateメソッドを使って行う。createメソッドは第一引数にテーブル名、第二引数にテーブルを作成するための処理まとめたクロージャが用意されている。
        // フィールドの設定はクロージャ(無名関数=関数名を指定しなくても関数を作成できるものです。)の引数として渡されるBlueprintクラスのメソッドを使って行う。
        // カラムを「NULL値設定可能(nullable)」にしたい場合は、nullableメソッドを使います。
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            // unique()は指定したカラムの値を一意にする。これで同じemailが登録されないようにしている。
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
