<!DOCTYPE html>
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
</html>
