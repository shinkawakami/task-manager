<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>タスク追加</title>
</head>
<body>
    <h1>タスク追加</h1>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <label>タイトル:</label><br>
        <input type="text" name="title" value="{{ old('title') }}"><br><br>

        <label>説明:</label><br>
        <textarea name="description">{{ old('description') }}</textarea><br><br>

        <button type="submit">保存</button>
    </form>

    <a href="{{ route('tasks.index') }}">← 戻る</a>
</body>
</html>
