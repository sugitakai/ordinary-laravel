@extends('adminlte::page')

@section('title', 'マッサージ店 予約管理システムMMS')

@section('content_header')
<h1>Sphinx Managements System</h1>
@stop

@section('content')
<table class="table table-striped task-table">
	<thead>
		<h1>施術予約管理表</h1>
		<tr>
			<th>予約ID</th>
			<th>名前</th>
			<th>電話番号</th>
			<th>メールアドレス</th>
			<th>希望コース</th>
			<th>希望施術場所</th>
			<th>希望セラピスト1</th>
			<th>希望セラピスト2</th>
			<th>施術希望日1</th>
			<th>施術希望日2</th>
			<th>希望時間1</th>
			<th>希望時間2</th>
			<th>追加OP1</th>
			<th>追加OP2</th>
			<th>追加OP3</th>
			<th>施術所要時間</th>
			<th>要望</th>
			<th>予約ステータス</th>
			<th>登録日時</th>
			<th>更新日時</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td class="text-center" colspan="5">予約が見つかりません</td>
		</tr>
	</tbody>
</table>
@stop

@section('css')
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
	console.log('Hi!');
</script>
@stop