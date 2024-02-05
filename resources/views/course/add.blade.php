@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
<h1>施術メニュー登録</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-10">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card card-primary">
            <form method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="名前" style="width: 200px;">
                    </div>

                    <div class="form-group">
                        <label for="type">種類</label>
                        <select name="type" placeholder="種別" required>
                            <option value="course"> course </option>
                            <option value="option"> option </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="time">施術時間(有料オプションの設定時は0時間です)</label>
                        <select name="time" required>
                            <option value="0"> 0 </option>
                            <option value="1"> 1 </option>
                            <option value="2"> 2 </option>
                        </select>時間
                    </div>

                    <div class="form-group">
                        <label for="price">施術費用</label>
                        <input type="text" class="form-control" id="detail" name="price" placeholder="施術費用" style="width: 200px; display:inline-block">
                        <span>円</span>
                    </div>

                    <div class=" form-group">
                        <label for="detail">詳細</label>
                        <input type="text" class="form-control" id="detail" name="detail" placeholder="詳細説明" style="height: 100px; width: 200px;">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop