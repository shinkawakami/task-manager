<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    // 一覧表示
    public function index()
    {
        $user = Auth::user(); // デフォルトガードで認証されたユーザーを取得(webガードとなる可能性が高い)
        if (!$user) {
            logger()->error('User not authenticated');
            // セッションにエラーメッセージを保存
            return redirect()->route('login')->with('error', 'ログインしてください');
        }
        // Auth::guard('admin')->user(); // adminガードで認証されたユーザーを取得
        $tasks = Task::all();
        //$tasks = Task::where('user_id', Auth::id())->get();
        return view('tasks.index', compact('tasks'));
    }

    // 詳細表示
    public function show(Task $task)
    {
        //$this->authorize('view', $task);

        return view('tasks.show', compact('task'));
    }

    // 作成フォーム表示
    public function create()
    {
        return view('tasks.create');
    }

    private function validateTask(TaskRequest $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);
    }

    // タスク保存
    public function store(TaskRequest $request)
    {
        $this->validateTask($request);

        Auth::user()->tasks()->create($request->only('title', 'description'));

        return redirect()->route('tasks.index')->with('success', 'タスクを追加しました！');
    }

    // 編集フォーム表示
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // 更新処理
    public function update(TaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $this->validateTask($request);

        $task->update($request->only('title', 'description'));

        return redirect()->route('tasks.index')->with('success', 'タスクを更新しました！');
    }

    // 削除処理
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'タスクを削除しました');
    }

}
