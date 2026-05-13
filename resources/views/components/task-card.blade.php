@props(['task', 'project'])

@php
    $priorityIcons = [
        'low' => ['icon' => 'keyboard_arrow_down', 'color' => 'text-blue-500', 'bg' => 'bg-blue-100'],
        'medium' => ['icon' => 'drag_handle', 'color' => 'text-orange-500', 'bg' => 'bg-orange-100'],
        'high' => ['icon' => 'keyboard_arrow_up', 'color' => 'text-red-500', 'bg' => 'bg-red-100'],
    ];
    $prio = $priorityIcons[$task->priority] ?? $priorityIcons['medium'];

    $typeIcons = [
        'task' => ['icon' => 'check', 'bg' => 'bg-blue-500', 'color' => 'text-white'],
        'bug' => ['icon' => 'bug_report', 'bg' => 'bg-red-500', 'color' => 'text-white'],
        'story' => ['icon' => 'bookmark', 'bg' => 'bg-green-500', 'color' => 'text-white'],
        'epic' => ['icon' => 'bolt', 'bg' => 'bg-purple-500', 'color' => 'text-white'],
    ];
    $typeData = $typeIcons[$task->type ?? 'task'];
@endphp

<div class="task-card bg-white rounded-xl flex flex-col p-4 border-2 border-black shadow-[2px_2px_0px_0px_#000] hover:shadow-[4px_4px_0px_0px_#630ed4] hover:-translate-y-1 mb-3 transition-all relative group cursor-pointer" 
     draggable="true" 
     data-id="{{ $task->id }}"
     onclick="openTaskDetails({{ json_encode($task) }}, '{{ $project->key }}')">
    
    <div class="flex-1 mb-4">
        <h4 class="text-[15px] font-extrabold text-black leading-snug">{{ $task->title }}</h4>
    </div>
    
    <div class="flex justify-between items-center mt-auto">
        <div class="flex items-center gap-2">
            <!-- Issue Type -->
            <div class="w-6 h-6 rounded-md border-2 border-black {{ $typeData['bg'] }} flex items-center justify-center shadow-[1px_1px_0px_0px_#000]" title="{{ ucfirst($task->type) }}">
                <span class="material-symbols-outlined text-[14px] {{ $typeData['color'] }} font-bold">{{ $typeData['icon'] }}</span>
            </div>
            <!-- Key -->
            <span class="text-[12px] font-bold text-slate-600 hover:text-black hover:underline cursor-pointer">{{ $project->key }}-{{ $task->id }}</span>
        </div>

        <div class="flex items-center gap-3">
            <!-- Delete Button (Only on hover) -->
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity" onclick="event.stopPropagation()">
                @csrf
                @method('DELETE')
                <button type="button" class="w-7 h-7 rounded border-2 border-transparent hover:border-black hover:bg-red-400 text-slate-400 hover:text-black flex items-center justify-center transition-all shadow-none hover:shadow-[1px_1px_0px_0px_#000]" onclick="customConfirmDelete(this.form)">
                    <span class="material-symbols-outlined text-[18px]">delete</span>
                </button>
            </form>

            <!-- Priority -->
            <div class="{{ $prio['color'] }} {{ $prio['bg'] }} w-6 h-6 rounded-md border-2 border-black flex items-center justify-center shadow-[1px_1px_0px_0px_#000]" title="Priority: {{ ucfirst($task->priority) }}">
                <span class="material-symbols-outlined text-[16px] font-extrabold">{{ $prio['icon'] }}</span>
            </div>

            <!-- Assignee -->
            @if($task->assignee_id)
                <div class="w-7 h-7 rounded-full border-2 border-black bg-orange-300 flex items-center justify-center text-[10px] font-extrabold text-black overflow-hidden shadow-[1px_1px_0px_0px_#000]" title="{{ $task->assignee->name }}">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($task->assignee->name) }}&background=E2E8F0&color=374151&size=28" alt="Assignee">
                </div>
            @else
                <div class="w-7 h-7 rounded-full border-2 border-black border-dashed bg-slate-50 flex items-center justify-center text-slate-400" title="Unassigned">
                    <span class="material-symbols-outlined text-[16px]">person_outline</span>
                </div>
            @endif
        </div>
    </div>
</div>
