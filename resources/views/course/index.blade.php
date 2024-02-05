@extends('adminlte::page')

@section('title', 'コース一覧')

@section('content_header')
<h1>コース一覧</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">施術メニュー 一覧</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <div class="input-group-append">
                            <a href="{{ route('courses.create') }}" class="btn btn-default">施術メニュー登録</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>コース名</th>
                            <th>施術種類</th>
                            <th>施術時間</th>
                            <th>施術費用</th>
                            <th>詳細</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Courses as $Course)
                        <tr>
                            <td>{{ $Course->id }}</td>
                            <td>{{ $Course->name }}</td>
                            <td>{{ $Course->type }}</td>
                            <td>{{ $Course->time }}時間</td>
                            <td>{{ $Course->price }}円</td>
                            <td>{{ $Course->detail }}</td>

                            <td>
                                <form method="POST" action="{{ route('courses.destroy', $Course->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onClick="return confirm('本当に削除しますか？');">削除</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop