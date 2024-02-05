@extends('adminlte::page')

@section('title', 'マッサージ店 予約管理システムMMS')

@section('content_header')
<h1>Sphinx Managements System</h1>
@stop

@section('content')
<p>こちらマッサージ店 予約管理システムMMSです</p>
<p>こちらはスタッフ専用ホーム画面になります。予約管理機能も付属しております。</p>
<div>
	本システムの使い方を説明します。
	<UL>
		<li>施術メニューを設定しましょう！ 名称・費用・施術種類（選択式）・施術時間を登録してください</li>
		<li>施術スタッフ情報を作成・編集しましょう！ 編集画面から、ログイン済みのスタッフに追加データを挿入できるようになっています。<br>
			施術スタッフの情報は外部公式ホームページからお客様から確認できるようになっております。</li>
		<li>スタッフ専用ホーム画面では外部公式ホームページからお客様より頂いた予約登録を施術予約管理表にて管理できるようになっております<br>
			こちらに届いた予約内容を確認し問題がなければ予約ステータスを確定へ、施術が終了している場合は施術終了に変更してください</li>
		<li><!-- シフト設定 --></li>
	</UL>
</div>



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