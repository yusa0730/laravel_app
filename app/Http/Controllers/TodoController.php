<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Auth;


class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $todo;

    // コントローラーがインスタンス化された時は毎回動く
    public function __construct(Todo $instanceClass)
    {


        $this->middleware('auth');

        $this->todo = $instanceClass;
    }

    public function index()
    {
        // collectionが連想配列みたいな使い方ができる。機能付きの配列。collectionインスタンスで連想配列と同じ形でデータ入っています。が返ってきます。
        // dd($this->todo->all());
        // $todos = $this->todo->all();
        $todos = $this->todo->getByUserId(Auth::id());
        return view('todo.index', compact('todos'));
        // return view('todo.index', ['todos' => $this->todo->all()]);
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

    // クライアント側が送るデータを受け取るクラス
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->todo->fill($input)->save();
        return redirect()->to('todo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $todo = $this->todo->find($id);
        // viewを呼び出している。
        // dd(compact('todo'));
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
        dump($request);
        $input = $request->all();
        dump($request->all());
        dump($input);
        // dd($request, $input, $id);
        dump($this->todo->find($id));
        dump($this->todo->find($id)->fill($input));
        dd($this->todo->find($id)->fill($input)->save());
        // $this->todo->find($id)->fill($input)->save();


        // fill()はfillableの値をチェックし、attributeに値をセット
        // find()で一意のレコードを持った新しいインスタンスが返ってくる。
        $todo = $this->todo->find($id);
        // $this -> todo ではなく find()で返ってきた$todo。
        $todo->fill($input);
        // 呼び出し元のTodoインスタンスの情報からsaveするsql文、どの値を変更するのかを決定する。
        $todo->save();


        return redirect()->to('todo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    // 呼び出し元の
        $this->todo->find($id)->delete();
        return redirect()->to('todo');
    }
}
