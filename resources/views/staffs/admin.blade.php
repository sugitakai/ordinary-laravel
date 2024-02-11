@extends('adminlte::page')

@section('title', 'マッサージ店 予約管理システムMMS')

@section('content_header')
<h1>Sphinx Managements System</h1>
@stop

@section('content')
<p>こちらマッサージ店 予約管理システムMMSです</p>
<p>こちらは店舗管理画面になります。予約管理機能も付属しております。</p>
<div>
	本システムの使い方を説明します。
	<UL>
		<li>施術メニューを設定しましょう！ 名称・費用・施術種類（選択式）・施術時間を登録してください</li>
		<li>施術スタッフ情報を作成・編集しましょう！ 編集画面から、ログイン済みのスタッフに追加データを挿入できるようになっています。<br>
			施術スタッフの情報は外部公式ホームページからお客様から確認できるようになっております。</li>
		<li>店舗管理画面では外部公式ホームページからお客様より頂いた予約登録を施術予約管理表にて管理できるようになっております<br>
			予約はidが若い順に第一希望の内容を優先してください。<br>
			予約登録では既存予約の施術希望日1、希望時間1、第一希望のセラピストとすべて同一の内容や<br>
			既存予約の施術時間に被る予約は全て受け付けないようになっています。<br>
			こちらに届いた予約内容を確認し問題がなければお客様へ連絡して予約ステータスを確定へ、施術が終了している場合は施術済みに変更してください<br>
			もしお客様が希望施術場所、施術希望日1、希望時間1、施術希望日2、希望時間2、希望コースの変更をお求めの際は再度予約し直して頂く様に誘導してください。
		</li>
	</UL>
</div>
@if (session()->has('message'))
<div class="alert alert-success font-bold" role="alert">
	{{ session('message') }}
</div>
@endif
<table class="table table-striped task-table">
	<thead>
		<h1>施術予約管理表</h1>
		<tr>
			<th>予約ID</th>
			<th>名前</th>
			<th>電話番号</th>
			<th>メールアドレス</th>
			<th>希望施術場所</th>
			<th>施術希望日1</th>
			<th>希望時間1</th>
			<th>施術希望日2</th>
			<th>希望時間2</th>
			<th>希望コース</th>
			<th>追加OP1</th>
			<th>追加OP2</th>
			<th>追加OP3</th>
			<th>希望セラピスト1</th>
			<th>希望セラピスト2</th>
			<th>施術所要時間</th>
			<th>要望</th>
			<th>登録日時</th>
			<th>更新日時</th>
			<th>予約ステータス</th>
		</tr>
	</thead>
	<tbody>
		<div class=" row" style="margin-right:0px;margin-left:0px;margin-top:15px;">
			@if($Reservations->count() > 0)
			@foreach ($Reservations as $Reservation)
			<tr>
				<td class="p-2">{{ $Reservation->id }}</td>
				<td class="p-2">{{ $Reservation->name }}</td>
				<td class="p-2">{{ $Reservation->tel_number }}</td>
				<td class="p-2">{{ $Reservation->email }}</td>
				<td class="p-2">{{ $Reservation->location }}</td>
				<td class="p-2">{{ $Reservation->reservation_date1 }}</td>
				<td class="p-2">{{ $Reservation->start_time1 }}</td>
				<td class="p-2">{{ $Reservation->reservation_date2 }}</td>
				<td class="p-2">{{ $Reservation->start_time2 }}</td>
				<td class="p-2">{{ $Reservation->mainCourse->name }}</td>
				<td class="p-2">{{ optional($Reservation->add_option1)->name }}</td>
				<td class="p-2">{{ optional($Reservation->add_option2)->name }}</td>
				<td class="p-2">{{ optional($Reservation->add_option3)->name }}</td>
				<td class="p-2">{{ $Reservation->Therapist_id1->name }}</td>
				<td class="p-2">{{ $Reservation->Therapist_id2->name }}</td>
				<td class="p-2">{{ $Reservation->course_time }}時間</td>
				<td class="p-2">{{ $Reservation->request }}</td>
				<td class="p-2">{{ $Reservation->created_at }}</td>
				<td class="p-2">{{ $Reservation->updated_at }}</td>
				<td class="p-2">{{ $Reservation->status }}</td>
				<td class="p-2 text-center">
					<div class="d-flex justify-content-center">
						<a href="{{ route('Reservations.edit', $Reservation->id) }}">
							<button class="btn btn-primary btn-sm me-2">編集</button>
						</a>
						<form method="POST" action="{{ route('Reservations.destroy', $Reservation->id) }}">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger btn-sm" onClick="return confirm('本当に削除しますか？');">削除</button>
						</form>
					</div>
				</td>
			</tr>
			@endforeach
			@else
			<tr>
				<td class="text-center" colspan="5">予約が見つかりません</td>
			</tr>
			@endif
		</div>
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