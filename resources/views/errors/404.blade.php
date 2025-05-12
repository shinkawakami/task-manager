@extends('layouts.app')

@section('content')
<div class="container">
    <h1>タスクが見つかりません</h1>
    <p>お探しのタスクは存在しないか、削除された可能性があります。</p>
    <a href="{{ route('tasks.index') }}">タスク一覧に戻る</a>
</div>
@endsection
