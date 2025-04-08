<div class="container">
    <h3>All Project Tasks</h3>

    @if ($projects->count() > 0)
        <ul class="list-group">
            @foreach ($projects as $project)
                <li class="list-group-item">
                    <a href="{{ route('projects.tasks', ['projectId' => $project->id]) }}">
                        <strong>{{ $project->name }}</strong>
                        <p>{{ $project->description }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p>No projects available.</p>
    @endif
</div>
