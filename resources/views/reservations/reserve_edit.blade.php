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
			<th>希望施術場所</th>
			<th>希望セラピスト1</th>
			<th>希望セラピスト2</th>
			<th>施術希望日1</th>
			<th>希望時間1</th>
			<th>施術希望日2</th>
			<th>希望時間2</th>
			<th>希望コース</th>
			<th>追加OP1</th>
			<th>追加OP2</th>
			<th>追加OP3</th>
			<th>施術所要時間</th>
			<th>要望</th>
			<th>登録日時</th>
			<th>更新日時</th>
			<th>予約ステータス</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="p-2">{{ $Reservation->id }}</td>
			<td class="p-2">{{ $Reservation->name }}</td>
			<td class="p-2">{{ $Reservation->tel_number }}</td>
			<td class="p-2">{{ $Reservation->email }}</td>
			<td class="p-2">{{ $Reservation->location }}</td>
			<td class="p-2">{{ $Reservation->Therapist_id1->name }}</td>
			<td class="p-2">{{ $Reservation->Therapist_id2->name }}</td>
			<td class="p-2">{{ $Reservation->reservation_date1 }}</td>
			<td class="p-2">{{ $Reservation->start_time1 }}</td>
			<td class="p-2">{{ $Reservation->reservation_date2 }}</td>
			<td class="p-2">{{ $Reservation->start_time2 }}</td>
			<td class="p-2">{{ $Reservation->mainCourse->name }}</td>
			<td class="p-2">{{ optional($Reservation->add_option1)->name }}</td>
			<td class="p-2">{{ optional($Reservation->add_option2)->name }}</td>
			<td class="p-2">{{ optional($Reservation->add_option3)->name }}</td>
			<td class="p-2">{{ $Reservation->course_time }}時間</td>
			<td class="p-2">{{ $Reservation->request }}</td>
			<td class="p-2">{{ $Reservation->created_at }}</td>
			<td class="p-2">{{ $Reservation->updated_at }}</td>
			<td class="p-2">{{ $Reservation->status }}</td>
		</tr>
		<form method="post" action="{{ route('Reservations.update', $Reservation->id) }}">
			<div class="form-group">
				@csrf
				<div class="form-group">
					<label for="name">施術希望日2</label>
					<input type="date" class="form-control" id="reservation_date2" name="reservation_date2" placeholder="施術希望日2" >
				</div>
				<div class="form-group">
					<label for="start_time2">希望時間2</label>
					<select name="start_time2" >
						<option value="--"> -- </option>
						<option value="12:00"> 12時 </option>
						<option value="13:00"> 13時 </option>
						<option value="14:00"> 14時 </option>
						<option value="15:00"> 15時 </option>
						<option value="16:00"> 16時 </option>
						<option value="17:00"> 17時 </option>
						<option value="18:00"> 18時 </option>
						<option value="19:00"> 19時 </option>
						<option value="20:00"> 20時 </option>
						<option value="21:00"> 21時 </option>
						<option value="22:00"> 22時 </option>
						<option value="23:00"> 23時 </option>
						<!-- 00分と付ける -->
					</select>
				</div>
				<label for="Add_option1">追加OP1</label>
				<select class="form-select form-select-sm" aria-label=".form-select-lg example" name="Add_option1">
					<option value=""> -- </option>
					@foreach ($courses as $course)
					@if ($course->type === 'option')
					<option value="{{ $course->id }}">{{ $course->name }}</option>
					@endif
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="Add_option2">追加OP2</label>
				<select class="form-select form-select-sm" aria-label=".form-select-lg example" name="Add_option2">
					<option value=""> -- </option>
					@foreach ($courses as $course)
					@if ($course->type === 'option')
					<option value="{{ $course->id }}">{{ $course->name }}</option>
					@endif
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="Add_option3">追加OP3</label>
				<select class="form-select form-select-sm" aria-label=".form-select-lg example" name="Add_option3">
					<option value=""> -- </option>
					@foreach ($courses as $course)
					@if ($course->type === 'option')
					<option value="{{ $course->id }}">{{ $course->name }}</option>
					@endif
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="detail">ご要望</label>
				<input type="text" class="form-control" id="request" name="request" placeholder="ご要望や出張先住所等をお書きください" style="height: 100px;">
			</div>
			</div>

			<div class="form-group">
				<label for="Add_option3">予約ステータス</label>
				<select class="form-select form-select-sm" aria-label=".form-select-lg example" name="status">
					<option value="予約中"> 予約中 </option>
					<option value="確定">確定</option>
					<option value="施術済み">施術済み</option>
				</select>
			</div>

			<div class="card-footer">
				<button type="submit" class="btn btn-primary">発注決定</button>
			</div>
			</div>
		</form>
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