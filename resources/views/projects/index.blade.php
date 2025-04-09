<x-app-layout>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700 p-4">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Projects</h2>
            <ul class="space-y-2">
                @foreach ($projects as $project)
                    <li>
                        <a href="{{ route('projects.tasks', $project->id) }}"
                           class="block px-4 py-2 rounded-md
                           {{ isset($selectedProject) && $selectedProject->id === $project->id
                               ? 'bg-indigo-600 text-white'
                               : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                            {{ $project->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>
    </div>
</x-app-layout>
