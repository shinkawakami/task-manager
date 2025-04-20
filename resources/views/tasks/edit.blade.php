<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>タスク編集</title>
</head>
<body>
    <h1>タスク編集</h1>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>タイトル:</label><br>
        <input type="text" name="title" value="{{ old('title', $task->title) }}"><br><br>

        <label>説明:</label><br>
        <textarea name="description">{{ old('description', $task->description) }}</textarea><br><br>

        <button type="submit">更新</button>
    </form>

    <a href="{{ route('tasks.index') }}">← 戻る</a>
</body>
</html>
