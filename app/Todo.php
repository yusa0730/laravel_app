<?php
// モデルはテーブルの内容を定義したクラスです。

// namespace名前空間はディレクトリ構造に近い考え方です。
// この仕組みを利用することで同じクラス名でも重複エラーを避けることができます。
namespace App;

// useはパスの記述を短くできる。requireと同じような使い方。
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// この Model を継承したfileというのが DB への操作を可能にするfileとなります。
// 継承することでModelクラスにあるプロパティ(idなどを)を利用するため。
// Illuminate\Database\Eloquent名前空間にある「Model」を継承したクラスとしてTodoクラスを作成。
class Todo extends Model
{
    use SoftDeletes;

    // $fillable（代入可能）に配列を設定した上でprotectedすれば、設定したもののみ書き換えることができます。今回はtitleのみ書き換え可能。
    protected $fillable = [
        'title',
        'user_id'
    ];
    // 論理削除の実装のために必要。削除したら自動で削除日付を入れる。
    protected $dates = ['deleted_at'];

    // これを書くことで保存することが可能になり、またユーザーに紐づいたデータ取得のための記述
    public function getByUserId($id)
    {
        // Illuminate\Database\Eloquent\Collectionクラス
        // get()の返り値はCollectionクラス

        return $this->where('user_id', $id)->get();
    }
}
