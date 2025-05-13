@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>タスク詳細</h1>
    </div>

    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">{{ $task->title }}</h5>
            <p class="card-text">{{ $task->description }}</p>
            <p class="card-text"><small class="text-muted">作成日: {{ $task->created_at->format('Y-m-d H:i') }}</small></p>
            <p class="card-text"><small class="text-muted">更新日: {{ $task->updated_at->format('Y-m-d H:i') }}</small></p>
            @can ('update', $task)
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">編集</a>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('削除しますか？')">削除</button>
                </form>
            @endcan
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">戻る</a>
@endsection