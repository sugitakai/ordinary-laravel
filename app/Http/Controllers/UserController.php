<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Rules\CurrentPasswordRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except(['index', 'show']);
	}

	public function admin()
	{
		return view('staffs.admin');
	}

	/**
	 * ユーザー一覧
	 */
	public function index()
	{
		$users = User::paginate(10);
		$courses = Course::all(); // Coursesモデルから全てのコース情報を取得
		return view('staffs.index', compact('users', 'courses'));
	}

	// // ユーザー登録
	// public function create(Request $request)
	// {
	// 	$courses = Course::all(); // Coursesモデルから全てのコース情報を取得
	// 	return view('staffs.create', compact('courses'));
	// 	$validatedData = $request->validate([
	// 		'name' => 'required|string|max:255',
	// 		'password' => Hash::make($data['password']),
	// 		'email' => 'required|string|email|max:255',
	// 		'tel_number' => ['required', 'string', 'max:255', 'regex:/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/'],
	// 		'height' => 'numeric|max:999',
	// 		'body_weight' => 'numeric|max:999',
	// 		'age' => 'numeric|max:999',
	// 		'sports_history' => 'max:100',
	// 		'possible_option_1' => 'max:100',
	// 		'possible_option_2' => 'max:100',
	// 		'possible_option_3' => 'max:100',
	// 		'Remarks_column1' => 'max:100',
	// 		'Remarks_column2' => 'max:100',
	// 		'profile' => 'max:500',
	// 		'owner' => 'boolean',
	// 	]);

	// 	$user = new User;
	// 	$user->name = $validatedData['name'];
	// 	$user->email = $validatedData['email'];
	// 	$user->tel_number = $validatedData['tel_number'];
	// 	$user->height = $validatedData['height'];
	// 	$user->body_weight = $validatedData['body_weight'];
	// 	$user->age = $validatedData['age'];
	// 	$user->sports_history = $validatedData['sports_history'];
	// 	$user->possible_option_1 = $validatedData['possible_option_1'];
	// 	$user->possible_option_2 = $validatedData['possible_option_2'];
	// 	$user->possible_option_3 = $validatedData['possible_option_3'];
	// 	$user->Remarks_column1 = $validatedData['Remarks_column1'];
	// 	$user->Remarks_column2 = $validatedData['Remarks_column2'];
	// 	$user->profile = $validatedData['profile'];
	// 	$user->owner = $validatedData['owner'];
	// 	$user->save();
	// 	return view('staffs.index', ['user' => $user])->with('message', '新しいユーザー情報を登録しました');
	// }

	/**
	 * ユーザープロフィール
	 */
	public function show($id)
	{
		$user = User::find($id);
		$users = User::where('id', $id)->get();
		return view('staffs.profile', compact('user', 'users'));
	}
	/**
	 * ユーザー編集画面
	 */
	public function edit(string $id)
	{
		if (Auth::id() == $id) {
			$user = User::findOrFail($id);
			$courses = Course::all(); // Coursesモデルから全てのコース情報を取得
			return view('staffs.edit', compact('user', 'courses'))->with(['id' => $id]);
		} else {
			abort(404, 'Unauthorized');
		}
	}

	/**
	 * ユーザー編集内容を保存dd($request);
	 */
	public function update(Request $request)
	{
		$validatedData = $request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255',
			'tel_number' => ['required', 'string', 'max:255', 'regex:/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/'],
			'height' => 'numeric|max:999',
			'body_weight' => 'numeric|max:999',
			'age' => 'numeric|max:999',
			'sports_history' => 'max:100',
			'possible_option_1' => 'max:100',
			'possible_option_2' => 'max:100',
			'possible_option_3' => 'max:100',
			'Remarks_column1' => 'max:100',
			'Remarks_column2' => 'max:100',
			'profile' => 'max:500',
			'owner' => 'boolean',
			'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		]);

		$user = Auth::user();
		$user->name = $validatedData['name'];
		$user->email = $validatedData['email'];
		$user->tel_number = $validatedData['tel_number'];
		$user->height = $validatedData['height'];
		$user->body_weight = $validatedData['body_weight'];
		$user->age = $validatedData['age'];
		$user->sports_history = $validatedData['sports_history'];
		$user->possible_option_1 = $validatedData['possible_option_1'];
		$user->possible_option_2 = $validatedData['possible_option_2'];
		$user->possible_option_3 = $validatedData['possible_option_3'];
		$user->Remarks_column1 = $validatedData['Remarks_column1'];
		$user->Remarks_column2 = $validatedData['Remarks_column2'];
		$user->profile = $validatedData['profile'];
		$user->owner = $validatedData['owner'];

		if ($request->hasFile('image_path')) {
			$image = $request->file('image_path');
			$fileName = time() . '_' . $image->getClientOriginalName();
			$filePath = $image->storeAs('public/images', $fileName);
			$user->image_path = $fileName;
		}

		$user->save();

		$users = User::paginate(10);
		return view('staffs.index', ['users' => $users])->with('message', 'ユーザー情報を変更しました');
	}

	/**		dd($request->file('image_path'));
	 * ユーザー情報を削除
	 */
	public function destroy(string $id)
	{
		$user = User::findOrFail($id);
		$user->delete();
		return redirect()->back()->with('message', 'ユーザーを削除しました');
	}

	/**
	 * パスワード変更画面
	 */
	public function showPasswordChangeForm(string $id)
	{
		$user = User::findOrFail($id);
		return view('staffs.passwords.change', compact('user'));
	}

	/**
	 * パスワードを変更する
	 */
	public function changePassword(Request $request, User $user)
	{
		$inputs = $request->validate([
			'current-password' => ['required', 'string', new CurrentPasswordRule],
			'password' => 'required|string|confirmed|different:current-password',
		]);

		$userId = request()->route('id');
		$user = User::findOrFail($userId);

		$user->update([
			'password' => $inputs['password'],
		]);

		return redirect()->route('staffs')->with('message', 'パスワードを変更しました');
	}

	/**
	 * ユーザー検索
	 */
	public function search(Request $request)
	{
		$keyword = $request->input('q');
		$query = User::query();

		if (!empty($keyword)) {
			$query->where('id', '=', $keyword)
				->orWhere('name', 'like', '%' . $keyword . '%');
		}

		$users = $query->paginate(10);
		return view('staffs.index', compact('users'));
	}
}
