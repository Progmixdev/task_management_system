<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <input type="hidden" name="project_id" value="{{ $project->id }}">

    <div class="mb-3">
        <label for="title" class="form-label">Task Title</label>
        <input type="text" name="title" class="form-control" id="title" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Task Description</label>
        <textarea name="description" class="form-control" id="description"></textarea>
    </div>

    <div class="mb-3">
        <label for="due_date" class="form-label">Due Date</label>
        <input type="date" name="due_date" class="form-control" id="due_date">
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
