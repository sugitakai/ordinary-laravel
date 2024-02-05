<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $Courses = Course::all();

        return view('course.index', compact('Courses'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|string|max:100',
                'type' => 'required|string|max:100',
                'time' => 'required|integer',
                'price' => 'required|numeric',
            ]);

            // 商品登録
            Course::create([
                'name' => $request->name,
                'type' => $request->type,
                'time' => $request->time,
                'price' => $request->price,
                'detail' => $request->detail,
            ]);
            return redirect('courses');
        }

        return view('course.add');
        
    }
    public function destroy($id)
    {
        // コースを取得
        $course = Course::find($id);

        // コースが存在するかチェック
        if ($course) {
            // 削除処理を実行
            $course->delete();
        return redirect('courses');
        }

        return view('course.add');
    }
}
