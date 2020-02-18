<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// この Model を継承したfileというのが DB への操作を可能にするfileとなります。
class Todo extends Model
{
    // $fillable（代入可能）に配列を設定した上でprotectedすれば、設定したもののみ書き換えることができます。今回はtitleのみ書き換え可能。
    protected $fillable = [
        'title',
        'user_id'
    ];

    // これを書くことで保存することが可能になり、またユーザーに紐づいたデータ取得のための記述
    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get();
    }
}
