<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Tasks') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if ($tasks->count() > 0)
                    <ul class="space-y-4">
                        @foreach ($tasks as $task)
                            <li>
                                <form action="{{ route('tasks.toggleStatus', ['taskId' => $task->id]) }}" method="POST"
                                    class="toggle-status-form" data-task-id="{{ $task->id }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left p-4 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $task->title }}
                                                </h3>
                                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                                    {{ $task->description }}
                                                </p>
                                            </div>
                                            <div>
                                                <span
                                                    class="status-text {{ $task->is_done ? 'text-green-600' : 'text-yellow-500' }}">
                                                    {{ $task->is_done ? '✓ Done' : '⏳ Pending' }}
                                                </span>
                                            </div>
                                        </div>
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600 dark:text-gray-300">No tasks available.</p>
                @endif

                <div class="mt-6">
                    <a href="#task-popup" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded open-popup-link" data-project-id="{{ $projectId }}">
                        + Add Task
                    </a>
                </div>

                <!-- Popup Content -->
                <div id="task-popup" class="mfp-hide">
                    <div id="popup-content"></div>
                </div>
                <div class="mt-6">
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
