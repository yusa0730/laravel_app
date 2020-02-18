<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// この記述をすることによって app\Todo.php を使用することができます。
use App\Todo;
// ログインしているユーザーを Auth::id() という形で取得を可能にするために追記
use Auth;


class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Class 内でしか使用しない変数、言い換えれば このClass以外からのアクセスを避けたい変数 の定義のさいに使用されます。
    private $todo;

    // この Class が使用される際 = Classのインスタンス化 が行われた際に設定しておきたい値などを設定するメソッドとして使われます。
    // これを初期化とか初期値設定などと呼んだりします。
    public function __construct(Todo $instanceClass)
    {
        // ログインしていない場合は、Todo の一覧が表示されなくなりました。
        $this->middleware('auth');
        $this->todo = $instanceClass;
    }

    public function index()
    {
        // DBから全件取得(SELECT * FROM todos;)して変数$todosに代入
        // $todos = $this->todo->all();
        $todos = $this->todo->getByUserId(Auth::id());
        // compact() にview側に渡したい変数を記述してあげます。そうすることによってview側で変数を使用することが可能となります。
        return view('todo.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // fileの上部に記載ある use Illuminate\Http\Request; の Request を使用してます。
    // これを使うことで何が実現できているかというとForm タグで送信した POST 情報を取得することを実現してます。
    public function store(Request $request)
    {
        // 全入力を「配列」として受け取りたい場合は、allメソッドを使用します。
        $input = $request->all();
        $input['user_id'] = Auth::id();
        // fillは、引数を設定できるかどうかを確認してくれます。これは、Model ファイル に追記した記述をしていることによって可能としてます。かつ最後の save() でデータの保存を行います。
        $this->todo->fill($input)->save();
        // 一覧画面に遷移させる記述
        // return redirect()->to('todo');
        return redirect()->route('todo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // editアクションのrouteはtodo/{todo}/edit となっているはずです。
    // この {todo} の箇所がパラメータ扱いになります。view側で引数で渡すことによって画面遷移用のURLが作成できるようになっています。
    public function edit($id)
    {
        // パラメータで渡ってきた値を元にDBへ検索を行なっています。これにより指定のデータのみ取得することが可能になり、編集画面に一覧で選択したTitileのものを表示し更新を可能にします。
        $todo = $this->todo->find($id);
        return view('todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        // find で検索し、fill で設定の確認(検証)し、保存という流れです。
        $this->todo->find($id)->fill($input)->save();
        // return redirect()->to('todo');
        // route メソッドを使用すると、名前付きルートへのリダイレクトを行うことができます。
        return redirect()->route('todo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find で検索し、delete で削除という流れになります。
        $this->todo->find($id)->delete();
        // return redirect()->to('todo');
        // route メソッドを使用すると、名前付きルートへのリダイレクトを行うことができます。
        return redirect()->route('todo.index');
    }
}
