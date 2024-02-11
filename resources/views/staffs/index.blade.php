@extends('adminlte::page')
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="/css/staffs.index.css">
@stop
@section('js')
@section('content')
<h1 class="heading">Sphinx Managements System</h1>
<div class="container">
	@if (session()->has('message'))
	<div class="alert alert-success font-bold" role="alert">
		{{ session('message') }}
	</div>
	@endif

	<div class="p-4 bg-white rounded shadow">
		<div class="mb-4 row">

			{{-- 検索フォーム --}}
			<div class="col-12 col-md-6">
				<form method="GET" action="{{ route('users.search') }}">
					@csrf
					<div class="input-group">
						<input type="text" class="form-control" name="q" value="{{ request('q') }}" placeholder="ID、名前で検索">
						<button class="btn btn-primary" type="submit" id="button-addon2"><i class="fas fa-search"></i> 検索</button>
					</div>
				</form>
			</div>

			<div class="table-responsive">
				<table class="border w-100 table align-middle" style="table-layout:auto;">
					<thead class="table-primary">
						<tr>
							<th class="p-2" scope="col">ID</th>
							<th class="p-2 w-25" scope="col">名前</th>
							<th class="p-2 w-25" scope="col">身長</th>
							<th class="p-2 w-25" scope="col">体重</th>
							<th class="p-2 w-25" scope="col">年齢</th>
							<th class="p-2 w-25" scope="col">スポーツ歴</th>
							<th class="p-2" scope="col">可能OP</th>
							<th class="p-2" scope="col">可能OP</th>
							<th class="p-2" scope="col">可能OP</th>
							<th class="p-2" scope="col">備考</th>
							<th class="p-2" scope="col">備考</th>
							<th class="p-2 w-25" scope="col">詳細</th>
							<th class="p-2 w-25" scope="col">登録日</th>
							<th class="p-2 w-25" scope="col">更新日</th>
							<th class="p-2" scope="col">メールアドレス</th>
							<th class="p-2" scope="col">電話番号</th>
							<th class="p-2 text-center" style="width: 15%;" scope="col">操作</th>
						</tr>
					</thead>
					<tbody>
						<div class="row" style="margin-right: 0px; margin-left: 0px; margin-top: 15px;">
							@foreach ($users as $user)
							<div class="col-md-4 col-xs-4" style="padding-right: 1px; padding-left: 1px;">
								<div class="panel panel-simple" style="background-color: transparent; text-align: center;">
									<a href="{{ route('profile', ['id' => $user->id]) }}">
										<div class="panel-body">
											<img src="{{ asset('storage/images/'.$user->image_path) }}" alt="" style="width:75%;">
										</div>
										<div class="panel-head" style="color: white; text-align: center;">
											<h3 class="panel-title-name bg-info">{{ $user->name }}</h3>
											<div class="panel-title-pro1 text-body"> {{ $user->height }}cm {{ $user->body_weight }}kg {{ $user->age }}歳 </div>
										</div>
										<div class="panel-title-pro1 text-body">{{ $user->Remarks_column1 }} @if ($user->courses)
											{{ $user->courses->name }}
											@endif</p>
										</div>
									</a>
								</div>
							</div>
							@endforeach
						</div>
						<div class=" row" style="margin-right:0px;margin-left:0px;margin-top:15px;">
							@foreach ($users as $user)
							@auth
							<tr>
								<td class="p-2">{{ $user->id }}</td>
								<td class="p-2">{{ $user->name }}</td>
								<td class="p-2">{{ $user->height }}</td>
								<td class="p-2">{{ $user->body_weight }}</td>
								<td class="p-2">{{ $user->age }}</td>
								<td class="p-2">{{ $user->sports_history }}</td>
								<td class="p-2">@if ($user->courses)
									{{ $user->courses->name }}
									@endif
								</td>
								<td class="p-2">@if ($user->courses)
									{{ $user->courses2->name }}
									@endif
								</td>
								<td class="p-2">@if ($user->courses)
									{{ $user->courses3->name }}
									@endif
								</td>
								<td class="p-2">{{ $user->Remarks_column1 }}</td>
								<td class="p-2">{{ $user->Remarks_column2 }}</td>
								<td class="p-2">{{ $user->profile }}</td>
								<td class="p-2">{{ $user->created_at }}</td>
								<td class="p-2">{{ $user->updated_at }}</td>
								@if (Auth::user()->owner)
								<td class="p-2">{{ $user->email }}</td>
								<td class="p-2">{{ $user->tel_number }}</td>
								<td class="p-2">
									@if($user->owner == 1)
									owner
									@else
									staff
									@endif
								</td>
								@endif
								<td class="p-2 text-center">
									<div class="d-flex justify-content-center">
										<a href="{{ route('users.profile', $user->id) }}">
											<button class="btn btn-primary btn-sm me-2">詳細</button>
										</a>
										@if (Auth::id() == $user->id)
										<!-- route('users/staffs/edit') -->
										<a href="{{ route('users.edit', $user->id) }}">
											<button class="btn btn-primary btn-sm me-2">編集</button>
										</a>
										@endif
										@if (Auth::id() == $user->id || Auth::user()->owner)
										<form method="POST" action="{{ route('users.destroy', $user->id) }}">
											@csrf
											@method('DELETE')
											<button class="btn btn-danger btn-sm" onClick="return confirm('本当に削除しますか？');">削除</button>
										</form>
										@endif
									</div>
								</td>
							</tr>
							@endauth
							@endforeach
					</tbody>
				</table>
				{{ $users->links('pagination::bootstrap-5') }}
			</div>
		</div>
	</div>
	@endsection