@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>タスク一覧</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">新規作成</a>
    </div>

    @foreach ($tasks as $task)
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $task->title }}</h5>
                <p class="card-text">{{ $task->description }}</p>
                <p class="card-text"><small class="text-muted">作成日: {{  $task->created_at->format('Y-m-d H:i') }}</small></p>
                <p class="card-text"><small class="text-muted">更新日: {{  $task->updated_at->format('Y-m-d H:i') }}</small></p>
                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-info">詳細</a>
                @can ('update', $task)
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">編集</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('削除しますか？')">削除</button>
                    </form>
                @endcan
            </div>
        </div>
    @endforeach
@endsection

{{-- <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>タスク一覧</title>
</head>
<body>
    <h1>タスク一覧</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('tasks.create') }}">＋ 新規タスク</a>

    <ul>
        @foreach ($tasks as $task)
            <li>
                <strong>{{ $task->title }}</strong><br>
                {{ $task->description }}<br>

                <a href="{{ route('tasks.edit', $task->id) }}">編集</a>

                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('削除してもよいですか？')">削除</button>
                </form>
            </li>
        @endforeach
    </ul>

</body>
</html> --}}
