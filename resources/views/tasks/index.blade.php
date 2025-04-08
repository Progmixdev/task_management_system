<div class="container">
    <h3>All tasks</h3>

    @if ($tasks->count() > 0)
        <ul class="list-group">
            @foreach ($tasks as $task)
            <form action="{{ route('tasks.toggleStatus', ['taskId' => $task->id]) }}" method="POST">
                @csrf
                <button type="submit">
                    <strong>{{ $task->name }}</strong>
                    <p>{{ $task->description }}</p>
                </button>
            </form>
            @endforeach
        </ul>
    @else
        <p>No tasks available.</p>
    @endif
    <a href="{{ route('tasks.create', ['projectId' => $projectId]) }}">
        Add Task
    </a>
</div>
