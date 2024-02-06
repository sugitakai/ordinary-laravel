@extends('layouts.app')

@section('content')
<div class="container">
    <div class="w-50 py-5 bg-white rounded mx-auto shadow">
        <div class="my-5">
            <h1 class="fs-4 fw-bold text-center">ユーザーの編集</h1>
        </div>
        <div class="my-5 col-md-6 mx-auto">
            @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('users.update') }}">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="name">名前</label>
                    <div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">メールアドレス</label>
                    <div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <a href="{{ route('users.password', $user->id) }}">パスワードの変更はこちら</a>
                </div>

                <div class="mb-3">
                    <label for="tel_number">電話番号</label>
                    <div>
                        <input id="tel_number" type="text" class="form-control @error('tel_number') is-invalid @enderror" name="tel_number" value="{{ old('tel_number') ?? $user->tel_number }}" required autocomplete="tel_number">
                        @error('tel_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="height">身長</label>
                    <div>
                        <input id="height" type="text" class="form-control @error('height') is-invalid @enderror" name="height" value="{{ old('height') ?? $user->height }}" autocomplete="height" autofocus>
                        @error('height')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="body_weight">体重</label>
                    <div>
                        <input id="body_weight" type="text" class="form-control @error('body_weight') is-invalid @enderror" name="body_weight" value="{{ old('body_weight') ?? $user->body_weight }}" autocomplete="body_weight" autofocus>
                        @error('body_weight')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="age">年齢</label>
                    <div>
                        <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') ?? $user->age }}" autocomplete="age" autofocus>
                        @error('age')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="sports_history">スポーツ歴</label>
                    <div>
                        <input id="sports_history" type="text" class="form-control @error('sports_history') is-invalid @enderror" name="sports_history" value="{{ old('sports_history') ?? $user->sports_history }}" autocomplete="sports_history" autofocus>
                        @error('sports_history')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>


                <div class="mb-3">
                    <label for="possible_options_1">可能OP</label>
                    <div>
                        <select class="form-select form-select-sm" class="form-control @error('possible_options_1') is-invalid @enderror" aria-label=".form-select-lg example" name="possible_option_1">
                            @foreach ($courses as $course)
                            @if ($course->type === 'option')
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('possible_options_1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="possible_options_2">可能OP</label>
                    <div>
                        <select class="form-select form-select-sm" class="form-control @error('possible_options_2') is-invalid @enderror" aria-label=".form-select-lg example" name="possible_option_2">
                            @foreach ($courses as $course)
                            @if ($course->type === 'option')
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('possible_options_2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="possible_options_3">可能OP</label>
                    <div>
                        <select class="form-select form-select-sm" aria-label=".form-select-lg example" class="form-control @error('possible_options_3') is-invalid @enderror" name="possible_option_3">
                            @foreach ($courses as $course)
                            @if ($course->type === 'option')
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('possible_options_3')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <label for="Remarks_column1">備考</label>
                <div>
                    <input id="Remarks_column1" type="text" class="form-control @error('Remarks_column1') is-invalid @enderror" name="Remarks_column1" value="{{ old('Remarks_column1') ?? $user->Remarks_column1 }}" autocomplete="Remarks_column1" autofocus>

                    @error('Remarks_column1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label for="Remarks_column2">備考</label>
                <div>
                    <input id="Remarks_column2" type="text" class="form-control @error('Remarks_column2') is-invalid @enderror" name="Remarks_column2" value="{{ old('Remarks_column2') ?? $user->Remarks_column2 }}" autocomplete="Remarks_column2" autofocus>

                    @error('Remarks_column2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="profile">詳細</label>
                    <div>
                        <input id="profile" type="text" class="form-control @error('profile') is-invalid @enderror" name="profile" value="{{ old('profile') ?? $user->profile }}" autocomplete="profile" autofocus>
                        @error('profile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <input type="file" name="image">

                <div class="mb-3">
                    <label for="owner">操作権限</label>
                    <div>
                        <select class="form-select form-select-sm" aria-label=".form-select-lg example" name="owner" class="form-control @error('owner') is-invalid @enderror" autocomplete="owner" autofocus>
                            <option value="0">false</option>
                            <option value="1">true</option>
                        </select>
                        @error('owner')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
        </div>
        <div class="my-5">
            <div class="my-5 text-center">
                <button type="submit" class="px-5 py-2 btn btn-primary fw-bold">
                    登録
                </button>
            </div>
        </div>
        </form>
    </div>
</div>
</div>
@endsection