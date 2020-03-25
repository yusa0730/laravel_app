<?php

use Illuminate\Database\Seeder;

// このファイルがシーディングのコマンドで実行されるスクリプト。このファイルの中に呼び出したい処理を用意しておく。
// 今回はTodosTableSeederを呼びだす処理を用意しておく。
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(TodosTableSeeder::class);
    }
}
