@extends('adminlte::page')
<!-- アサイドとサイドバーを付ける -->
@section('title', '施術予約')
@section('content')
@section('css')
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
{{-- <link rel="stylesheet" href="/css/official_home.css"> --}}
@stop
@section('js')
<script>
</script>
@stop

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
		<div class="card card-primary bg-dark-subtle">
			<div class="container">
				<div class="row">
					<div class="col-md-4 offset-md-4">
						<form method="post" action="{{ route('store') }}">
							@csrf
							<div class="form-group bg-light-subtle">
								<h1>施術予約</h1>
								<div class="card-body">
									<div class="form-group">
										<label for="name">名前</label>
										<input type="text" class="form-control" id="name" name="name" placeholder="名前" required>
									</div>

									<div class="form-group">
										<label for="tel_number">電話番号</label>
										<input type="text" class="form-control" id="tel_number" name="tel_number" placeholder="電話番号" required>
									</div>

									<div class="form-group">
										<label for="name">メールアドレス</label>
										<input type="text" class="form-control" id="email" name="email" placeholder="メールアドレス" required>
									</div>

									<div class="form-group">
										<label for="name">希望コース</label>
										<select class="form-select form-select-sm" aria-label=".form-select-lg example" name="course" required>
											@foreach ($courses as $course)
											@if ($course->type === 'course')
											<option value="{{ $course->id }}">{{ $course->name }}</option>
											@endif
											@endforeach
										</select>
									</div>

									<div class="form-group">
										<label for="name">希望施術場所 出張を選択した場合はホテル名・部屋番号・最寄り駅・住所を必ず併記してください。</label>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked required>
											<label class="form-check-label" for="flexRadioDefault1">
												個室
											</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" required>
											<label class="form-check-label" for="flexRadioDefault2">
												出張（自宅を含む）
											</label>
										</div>
									</div>

									<div class="form-group">
										<label for="name">希望セラピスト1</label>
										<select class="form-select form-select-sm" aria-label=".form-select-lg example" name="therapist_id1" required>
											@foreach ($Users as $User)
											<option value="{{ $User->id }}">{{ $User->name }}</option>
											@endforeach
										</select>
									</div>

									<div class="form-group">
										<label for="name">希望セラピスト2</label>
										<select class="form-select form-select-sm" aria-label=".form-select-lg example" name="therapist_id2" required> 
											@foreach ($Users as $User)
											<option value="{{ $User->id }}">{{ $User->name }}</option>
											@endforeach
										</select>
									</div>

									<div class="form-group">
										<label for="name">施術希望日1</label>
										<input type="date" class="form-control" id="reservation_date1" name="reservation_date1" placeholder="施術希望日1" required>
									</div>
									<div class="form-group">
										<label for="name">施術希望日2</label>
										<input type="date" class="form-control" id="reservation_date2" name="reservation_date2" placeholder="施術希望日2" required>
									</div>

									<div class="form-group">
										<label for="start_time1">希望時間1</label>
										<select name="start_time1" required>
											<option value="--"> -- </option>
											<option value="1100"> 11時 </option>
											<option value="1200"> 12時 </option>
											<option value="1300"> 13時 </option>
											<option value="1400"> 14時 </option>
											<option value="1500"> 15時 </option>
											<option value="1600"> 16時 </option>
											<option value="1700"> 17時 </option>
											<option value="1800"> 18時 </option>
											<option value="1900"> 19時 </option>
											<option value="2000"> 20時 </option>
											<option value="2100"> 21時 </option>
											<option value="2200"> 22時 </option>
											<option value="2300"> 23時 </option>
											<!-- 00分と付ける -->
										</select>
									</div>
									<div class="form-group">
										<label for="start_time2">希望時間2</label>
										<select name="start_time2" required>
											<option value="--"> -- </option>
											<option value="1100"> 11時 </option>
											<option value="1200"> 12時 </option>
											<option value="1300"> 13時 </option>
											<option value="1400"> 14時 </option>
											<option value="1500"> 15時 </option>
											<option value="1600"> 16時 </option>
											<option value="1700"> 17時 </option>
											<option value="1800"> 18時 </option>
											<option value="1900"> 19時 </option>
											<option value="2000"> 20時 </option>
											<option value="2100"> 21時 </option>
											<option value="2200"> 22時 </option>
											<option value="2300"> 23時 </option>
											<!-- 00分と付ける -->
										</select>
									</div>

									<div class="form-group">
										<label for="Add_option1">追加OP1</label>
										<select class="form-select form-select-sm" aria-label=".form-select-lg example" name="Add_option1">
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
								<div class="card-footer">
									<button type="submit" class="btn btn-primary">発注決定</button>
								</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section('css')
@stop
@section('js')
@stop