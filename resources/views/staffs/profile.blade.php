@extends('adminlte::page')
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="/css/official_home.css">
<link rel="stylesheet" href="/css/profile.css">
@stop
@section('js')
@section('content')
<h1>Sphinx Managements System</h1>

<div id="content">
	<h1>プロフィール</h1>
	<div id="main">
		@foreach ($users as $user)
		<h2 id="name">{{ $user->name }}</h2>
		<div id="photo" class="section profile-content">
			<div><img src="" width="180" height="240" alt=""></div>
			<div><img src="" width="180" height="240" alt=""></div>
			<div><img src="" width="180" height="240" alt=""></div>
		</div>
		<div class="container">
			<div class="profile-content">
				<div id="pNote" class="section col-md-6">
					<dl id="data" class="list01">
						@if (Auth::id() == $user->id || Auth::id() ==$user->owner)
						<dt>email</dt>
						<dd>{{ $user->email }}</dd>
						<dt>電話番号</dt>
						<dd>{{ $user->tel_number }}</dd>
						<dt>操作権限</dt>
						<dd>{{ $user->owner }}</dd>
						@endif
						<dt>身長 体重 年齢</dt>
						<dd>{{ $user->height }}cm {{ $user->body_weight }}kg {{ $user->age }}歳</dd>
						<dt>スポーツ歴</dt>
						<dd>{{ $user->sports_history }}</dd>
						<dt>備考</dt>
						<dd>{{ $user->Remarks_column1 }}</dd>
						<dt>備考</dt>
						<dd>{{ $user->Remarks_column2 }}</dd>
						<dt>可能OP</dt>
						<dd>{{ $user->possible_options_1 }}</dd>
						<dt>可能OP</dt>
						<dd>{{ $user->possible_options_2 }}</dd>
						<dt>可能OP</dt>
						<dd>{{ $user->possible_options_3 }}</dd>
						<dt>更新日</dt>
						<dd>{{ $user->created_at }}</dd>
					</dl>
				</div>
				<div id="comment col-md-6">
					<h3>店長コメント・スタッフコメント</h3>
					<p>{{ $user->profile }}</p>
				</div>

			</div>
		</div>
		@endforeach
	</div>
</div>

@stop
@endsection