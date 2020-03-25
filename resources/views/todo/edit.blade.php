@extends ('layouts.app')
@section ('content')

<h2 class="mb-3">ToDo編集</h2>
<!-- ブラウザがpostかGETでしか判断できない。hiddenでputメソッドを送ってlaravelがupdateアクションであることを判別。 -->
<!-- routeでactionのURLを設定している。 -->


{!! Form::open([ 'route' => ['todo.update', $todo->id], 'method' => 'PUT']) !!}
    <div class="form-group">
        {!! Form::input('text', 'title', $todo->title, ['required', 'class' => 'form-control'])!!}
        }
    </div>
    {!! Form::submit('更新', ['class' => 'btn btn-success float-right']) !!}
{!! Form::close() !!}

@endsection
