<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PULSE � {{ $project->name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Soft Neobrutal Cursor */
        @media (pointer: fine) {
            * { cursor: none !important; }
            #cursor-dot, #cursor-ring { pointer-events: none; position: fixed; border-radius: 50%; z-index: 99999; transform: translate(-50%, -50%); }
            #cursor-dot { width: 6px; height: 6px; background: #630ed4; transition: width .1s, height .1s, background .1s, transform .05s; }
            #cursor-ring { width: 28px; height: 28px; border: 2px solid rgba(0,0,0,0.8); transition: width .2s ease, height .2s ease, border-color .2s; }
            .cursor-on-btn #cursor-dot  { width: 0; height: 0; }
            .cursor-on-btn #cursor-ring { width: 36px; height: 36px; background: rgba(99,14,212,.05); border-color: rgba(99,14,212,0.8); }
        }
        
        body { 
            font-family: 'Space Grotesk', sans-serif; 
            background-color: #fafafa; 
        }

        .btn-fun {
            transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .btn-fun:hover {
            transform: translateY(-2px);
            box-shadow: 3px 3px 0 0 #000;
        }
        .btn-fun:active {
            transform: translateY(0);
            box-shadow: 0 0 0 0 #000;
        }

        /* Kanban Specific Styles */
        .board-container {
            background-color: #fafafa;
        }
        
        .kanban-col {
            min-height: 200px;
        }
        .task-card {
            cursor: grab;
            transition: transform 0.1s;
        }
        .task-card:active {
            cursor: grabbing;
        }
        .task-card.dragging {
            opacity: 0.5;
            transform: scale(0.98) rotate(2deg);
        }
        .drag-over {
            background-color: #f3ebfa;
            border-style: dashed;
        }
        
        .fade-in { animation: fadeIn 0.3s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
        .pop-in { animation: pop-in 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
        @keyframes pop-in { 0% { opacity: 0; transform: scale(.95) translateY(15px); } 100% { opacity: 1; transform: none; } }
        
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #fff;
            border: 2px solid #000;
            border-radius: 8px;
        }
        ::-webkit-scrollbar-thumb {
            background: #000; 
            border-radius: 6px;
            border: 2px solid #fff;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #630ed4; 
        }
    </style>
</head>
<body class="text-slate-800 overflow-hidden flex flex-col h-screen selection:bg-purple-600 selection:text-white">

    {{-- Custom cursor --}}
    <div id="cursor-dot"></div>
    <div id="cursor-ring"></div>

    <!-- Top Navigation / Application Header -->
    <header class="h-16 flex items-center justify-between px-6 bg-white border-b-2 border-black z-20 shrink-0">
        <div class="flex items-center gap-6">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:bg-purple-100 p-2 rounded-xl border-2 border-transparent hover:border-black transition-all text-black font-bold">
                <span class="material-symbols-outlined text-[28px] text-purple-600 font-bold">view_kanban</span>
                <span class="font-extrabold text-[20px] tracking-tight">PULSE</span>
            </a>
            <nav class="hidden md:flex items-center gap-2 text-[15px]">
                <a href="javascript:void(0)" onclick="showToast('Loading your work...', 'work')" class="px-4 py-2 text-black hover:bg-slate-100 border-2 border-transparent hover:border-black rounded-xl font-bold transition-all">Your work</a>
                <a href="/dashboard" class="px-4 py-2 bg-purple-100 text-purple-800 border-2 border-black rounded-xl font-bold transition-all shadow-[2px_2px_0px_0px_#000]">Projects</a>
                <a href="javascript:void(0)" onclick="showToast('Saved filters mapped.', 'filter_list')" class="px-4 py-2 text-black hover:bg-slate-100 border-2 border-transparent hover:border-black rounded-xl font-bold transition-all">Filters</a>
                <button onclick="document.getElementById('createTaskModal').classList.remove('hidden')" class="ml-2 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-xl font-bold border-2 border-black transition-all btn-fun">
                    Create
                </button>
            </nav>
        </div>
        <div class="flex items-center gap-4 text-black">
            <div class="relative hidden lg:block">
                <span class="material-symbols-outlined absolute left-3 top-2 text-[20px] text-black font-bold">search</span>
                <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 bg-white border-2 border-black rounded-xl text-[14px] w-[240px] outline-none transition-all focus:shadow-[3px_3px_0px_0px_#630ed4] font-bold">
            </div>
            <div class="w-10 h-10 rounded-full border-2 border-black bg-orange-400 flex items-center justify-center text-[16px] font-bold text-black cursor-pointer shadow-[2px_2px_0px_0px_#000] btn-fun select-none">
                {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0 relative h-full">
        <div class="flex flex-1 h-full overflow-hidden">
            <!-- Sidebar -->
            <aside class="w-[260px] bg-white border-r-2 border-black hidden md:flex flex-col shrink-0 flex-shrink-0 z-10 transition-all duration-300">
                <div class="p-6 flex items-center gap-4 border-b-2 border-black bg-purple-50">
                    <div class="w-12 h-12 rounded-xl border-2 border-black bg-white flex items-center justify-center text-purple-600 shadow-[2px_2px_0px_0px_#000]">
                        <span class="material-symbols-outlined text-[28px] font-bold">book</span>
                    </div>
                    <div class="overflow-hidden">
                        <h2 class="font-extrabold text-[16px] text-black leading-tight truncate" title="{{ $project->name }}">{{ $project->name }}</h2>
                        <p class="text-[13px] font-bold text-slate-500 truncate">Software project</p>
                    </div>
                </div>
                <!-- sidebar links -->
                <div class="p-4 flex-1">
                    <div class="space-y-2">
                        <a href="javascript:void(0)" onclick="showToast('Timeline page is under construction!', 'construction')" class="flex items-center gap-3 px-4 py-3 rounded-xl border-2 border-transparent text-[15px] text-black hover:bg-slate-100 hover:border-black font-bold transition-all">
                            <span class="material-symbols-outlined text-[22px]">timeline</span> <span class="truncate">Timeline</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl border-2 border-black bg-purple-100 text-purple-800 font-bold shadow-[2px_2px_0px_0px_#000] transition-all">
                            <span class="material-symbols-outlined text-[22px]">view_kanban</span> <span class="truncate">Board</span>
                        </a>
                        <div class="my-4 border-b-2 border-black border-dashed mx-4"></div>
                        <a href="javascript:void(0)" onclick="showToast('Project Settings menu opening soon', 'settings')" class="flex items-center gap-3 px-4 py-3 rounded-xl border-2 border-transparent text-[15px] text-black hover:bg-slate-100 hover:border-black font-bold transition-all">
                            <span class="material-symbols-outlined text-[22px]">settings</span> <span class="truncate">Settings</span>
                        </a>
                    </div>
                </div>
            </aside>

            <!-- Board Area -->
            <div class="flex-1 flex flex-col min-w-0 bg-[#fafafa] fade-in relative">
                <!-- Decorative background elements -->
                <div class="absolute top-10 right-10 w-32 h-32 bg-yellow-300 rounded-full mix-blend-multiply opacity-20 blur-xl pointer-events-none"></div>
                <div class="absolute bottom-10 right-1/4 w-40 h-40 bg-purple-300 rounded-full mix-blend-multiply opacity-20 blur-xl pointer-events-none"></div>
                
                <!-- Board Header -->
                <div class="px-8 pt-8 pb-4 shrink-0 relative z-10">
                    <div class="text-[14px] font-bold text-slate-500 mb-2 flex items-center gap-2">
                        <a href="/dashboard" class="hover:text-black hover:underline px-2 py-1 rounded-lg hover:border-black border-2 border-transparent transition-all">Projects</a>
                        <span class="material-symbols-outlined text-[16px]">chevron_right</span> 
                        <span class="text-black bg-white border-2 border-black px-2 py-1 rounded-lg">{{ $project->name }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-[32px] font-extrabold text-black tracking-tight">{{ $project->name }} Board</h1>
                        <div class="flex items-center gap-3">
                            <button onclick="navigator.clipboard.writeText(window.location.href); showToast('Board link copied to clipboard! 🚀', 'share')" class="w-10 h-10 rounded-xl border-2 border-black bg-white flex items-center justify-center text-black hover:bg-yellow-200 transition-all btn-fun shadow-[2px_2px_0px_0px_#000]" title="Share Board">
                                <span class="material-symbols-outlined font-bold">ios_share</span>
                            </button>
                            <button onclick="showToast('Timeline is being prepared!', 'timeline')" class="w-10 h-10 rounded-xl border-2 border-black bg-white flex items-center justify-center text-black hover:bg-emerald-200 transition-all btn-fun shadow-[2px_2px_0px_0px_#000]" title="More Options">
                                <span class="material-symbols-outlined font-bold">timeline</span>
                            </button>
                            <button onclick="showToast('Board options opening soon!', 'settings')" class="w-10 h-10 rounded-xl border-2 border-black bg-white flex items-center justify-center text-black hover:bg-purple-200 transition-all btn-fun shadow-[2px_2px_0px_0px_#000]" title="Settings">
                                <span class="material-symbols-outlined font-bold">more_horiz</span>
                            </button>
                        </div>
                    </div>

                    <!-- Filters toolbar -->
                    <div class="flex flex-wrap items-center gap-4 mb-2">
                        <div class="relative">
                            <input type="text" placeholder="Search board..." class="pl-4 pr-10 py-2 bg-white border-2 border-black rounded-xl text-[14px] font-bold w-[220px] focus:outline-none focus:shadow-[3px_3px_0px_0px_#630ed4] transition-all">
                            <span class="material-symbols-outlined absolute right-3 top-2 text-[20px] text-black font-bold">search</span>
                        </div>
                        <div class="flex -space-x-2">
                            <div class="w-10 h-10 rounded-full border-2 border-black bg-orange-400 flex items-center justify-center text-[14px] font-extrabold text-black cursor-pointer shadow-[2px_2px_0px_0px_#000] z-10" title="{{ auth()->user()->name ?? 'User' }}">
                                {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                            </div>
                            <div class="w-10 h-10 rounded-full border-2 border-black bg-white flex items-center justify-center text-[20px] font-bold text-black cursor-pointer shadow-[2px_2px_0px_0px_#000] hover:bg-slate-100 z-0">
                                <span class="material-symbols-outlined">person_add</span>
                            </div>
                        </div>
                        <div class="h-8 w-px bg-black opacity-20 hidden md:block"></div>
                        <button onclick="showToast('Advanced filtering is rolling out soon!', 'filter_list')" class="px-4 py-2 bg-white border-2 border-black rounded-xl font-bold text-black hover:bg-pink-100 transition-all shadow-[2px_2px_0px_0px_#000] btn-fun text-[14px] flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">filter_list</span> Filter
                        </button>
                        <button onclick="showToast('Grouping by epic coming soon!', 'expand_more')" class="px-4 py-2 bg-white border-2 border-black rounded-xl font-bold text-black hover:bg-blue-100 transition-all shadow-[2px_2px_0px_0px_#000] btn-fun text-[14px] flex items-center gap-2">
                            Group <span class="material-symbols-outlined text-[18px]">expand_more</span>
                        </button>
                    </div>
                </div>

                @if($errors->any())
                    <div class="mx-8 mb-4 p-4 bg-red-100 border-2 border-red-500 rounded-xl text-red-700 font-bold text-[14px] shadow-[2px_2px_0px_0px_rgba(239,68,68,1)] relative z-10">
                        {{ $errors->first() }}
                    </div>
                @endif
                
                <!-- Kanban Board Scrollable Area -->
                <div class="flex-1 overflow-x-auto overflow-y-hidden px-8 pb-6 flex gap-6 h-full items-start board-container select-none scroll-smooth relative z-10">
                    
                    @foreach($statuses as $status)
                    <div class="flex-shrink-0 w-80 max-h-full flex flex-col bg-white border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000] z-10">
                        <div class="p-4 border-b-2 border-black bg-{{ $status->color }}-100 rounded-t-xl flex justify-between items-center shadow-sm">
                            <h2 class="font-extrabold text-black flex items-center gap-2 uppercase tracking-wide text-[15px]">
                                <div class="w-3 h-3 rounded-full bg-{{ $status->color }}-500 border-2 border-black"></div>
                                {{ $status->name }}
                            </h2>
                            <span class="bg-white border-2 border-black text-[12px] font-extrabold px-2.5 py-0.5 rounded-full count-badge shadow-[1px_1px_0px_0px_#000]" data-status="{{ $status->id }}">{{ $status->tasks->count() }}</span>
                        </div>
                        
                        <div class="flex-1 overflow-y-auto p-3 space-y-3 kanban-col bg-slate-50" id="col-{{ $status->id }}" data-status="{{ $status->id }}">
                            @foreach($status->tasks as $task)
                                @include('components.task-card', ['task' => $task, 'project' => $project])
                            @endforeach
                        </div>
                        
                        <div class="p-3 bg-white rounded-b-xl border-t-2 border-black border-dashed">
                            <button onclick="document.getElementById('createTaskModal').classList.remove('hidden')" class="w-full py-2.5 px-4 bg-white border-2 border-black rounded-lg font-bold text-black border-dashed hover:border-solid hover:bg-purple-100 transition-all flex items-center justify-center gap-2 btn-fun group">
                                <span class="material-symbols-outlined font-bold group-hover:rotate-90 transition-transform">add</span> Create issue
                            </button>
                        </div>
                    </div>
                    @endforeach

                    <!-- Add Column Button -->
                    <button onclick="document.getElementById('createColumnModal').classList.remove('hidden')" class="shrink-0 w-16 h-16 rounded-xl border-2 border-dashed border-black bg-white flex items-center justify-center text-black hover:bg-yellow-200 transition-all mt-0 ml-2 btn-fun shadow-[2px_2px_0px_0px_#000]" title="Add Column">
                        <span class="material-symbols-outlined text-[28px] font-bold">add</span>
                    </button>

                </div>
            </div>
        </div>
    </main>

    <!-- Create Task Modal -->
    <div id="createTaskModal" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center hidden backdrop-blur-sm">
        <div class="bg-white border-4 border-black rounded-2xl w-full max-w-[600px] shadow-[8px_8px_0px_0px_#000] pop-in flex flex-col max-h-[90vh]">
            <div class="flex justify-between items-center p-6 border-b-4 border-black bg-yellow-100 rounded-t-xl shrink-0">
                <h2 class="text-[24px] font-extrabold text-black">Create Issue</h2>
                <button onclick="document.getElementById('createTaskModal').classList.add('hidden')" class="w-10 h-10 flex items-center justify-center rounded-xl border-2 border-black hover:bg-white transition-colors bg-yellow-200 btn-fun">
                    <span class="material-symbols-outlined font-bold">close</span>
                </button>
            </div>
            
            <div class="flex-1 overflow-y-auto p-8 text-[15px]">
                <form action="{{ route('tasks.store', $project) }}" method="POST" id="createTaskForm" class="space-y-6">
                    @csrf
                    
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block font-extrabold text-black mb-2">Project</label>
                            <div class="w-full bg-slate-100 border-2 border-slate-300 rounded-xl px-4 py-2.5 text-slate-500 font-bold flex items-center gap-3 cursor-not-allowed">
                                <span class="material-symbols-outlined">book</span> {{ $project->name }}
                            </div>
                        </div>
                        <div class="flex-1">
                            <label class="block font-extrabold text-black mb-2">Issue Type</label>
                            <select name="type" class="w-full bg-white border-2 border-black rounded-xl px-4 py-2.5 text-black font-bold focus:outline-none focus:shadow-[3px_3px_0px_0px_#630ed4] transition-all cursor-pointer">
                                <option value="task">Task</option>
                                <option value="bug">Bug</option>
                                <option value="story">Story</option>
                            </select>
                        </div>
                    </div>
                    
                    <hr class="border-2 border-black border-dashed">

                    <div>
                        <label class="block font-extrabold text-black mb-2">Summary <span class="text-red-500">*</span></label>
                        <input type="text" name="title" class="w-full bg-[#f8fafc] border-2 border-black rounded-xl px-4 py-3 text-black font-bold focus:outline-none focus:bg-white focus:shadow-[3px_3px_0px_0px_#630ed4] transition-all" placeholder="What needs to be done?" required>
                    </div>
                    
                    <div>
                        <label class="block font-extrabold text-black mb-2">Description</label>
                        <textarea name="description" rows="5" class="w-full bg-[#f8fafc] border-2 border-black rounded-xl px-4 py-3 text-black font-medium focus:outline-none focus:bg-white focus:shadow-[3px_3px_0px_0px_#630ed4] transition-all" placeholder="Add detailed descriptions..."></textarea>
                    </div>
                    
                    <div>
                        <label class="block font-extrabold text-black mb-2">Priority</label>
                        <select name="priority" class="w-full sm:w-1/2 bg-white border-2 border-black rounded-xl px-4 py-2.5 text-black font-bold focus:outline-none focus:shadow-[3px_3px_0px_0px_#630ed4] transition-all cursor-pointer">
                            <option value="high">High</option>
                            <option value="medium" selected>Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                </form>
            </div>
            
            <div class="px-8 py-5 flex justify-end gap-4 mt-auto border-t-4 border-black shrink-0 bg-slate-50 rounded-b-xl">
                <button type="button" onclick="document.getElementById('createTaskModal').classList.add('hidden')" class="px-6 py-2.5 text-[15px] font-bold text-black border-2 border-transparent hover:border-black rounded-xl transition-all">Cancel</button>
                <button type="submit" form="createTaskForm" class="px-8 py-2.5 bg-purple-600 border-2 border-black text-white rounded-xl font-extrabold text-[15px] shadow-[3px_3px_0px_0px_#000] btn-fun">Create Issue</button>
            </div>
        </div>
    </div>

    <!-- Task Details Modal -->
    <div id="taskDetailsModal" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center hidden backdrop-blur-sm">
        <div class="bg-white border-4 border-black rounded-2xl w-full max-w-[1040px] shadow-[8px_8px_0px_0px_#000] pop-in flex flex-col h-[90vh]">
            <div class="flex justify-between items-center px-8 py-4 border-b-4 border-black shrink-0 bg-blue-100 rounded-t-xl">
                <div class="flex items-center gap-4">
                    <div id="detailTaskTypeBg" class="w-8 h-8 rounded border-2 border-black bg-blue-500 flex items-center justify-center text-white shadow-[2px_2px_0px_0px_#000]">
                        <span id="detailTaskType" class="material-symbols-outlined font-bold text-[18px]">check</span>
                    </div>
                    <span id="detailTaskKey" class="text-[16px] font-extrabold text-black bg-white border-2 border-black px-3 py-1 rounded-lg shadow-[2px_2px_0px_0px_#000]">DESK-1</span>
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="this.classList.toggle('bg-blue-300'); showToast('Vote registered!', 'thumb_up')" class="w-10 h-10 rounded-xl border-2 border-black bg-white flex items-center justify-center text-black hover:bg-blue-100 transition-colors shadow-[2px_2px_0px_0px_#000] btn-fun" title="Vote">
                        <span class="material-symbols-outlined font-bold">thumb_up</span>
                    </button>
                    <button type="button" onclick="navigator.clipboard.writeText(window.location.href); showToast('Task link copied to clipboard! 🚀', 'share')" class="w-10 h-10 rounded-xl border-2 border-black bg-white flex items-center justify-center text-black hover:bg-yellow-100 transition-colors shadow-[2px_2px_0px_0px_#000] btn-fun" title="Share">
                        <span class="material-symbols-outlined font-bold">ios_share</span>
                    </button>
                    <button type="button" onclick="showToast('Task options coming soon!', 'more_horiz')" class="w-10 h-10 rounded-xl border-2 border-black bg-white flex items-center justify-center text-black hover:bg-emerald-100 transition-colors shadow-[2px_2px_0px_0px_#000] btn-fun" title="Options">
                        <span class="material-symbols-outlined font-bold">more_horiz</span>
                    </button>
                    <button onclick="document.getElementById('taskDetailsModal').classList.add('hidden')" class="w-10 h-10 ml-4 rounded-xl border-2 border-black bg-red-400 hover:bg-red-500 transition-colors flex items-center justify-center text-black shadow-[2px_2px_0px_0px_#000] btn-fun" title="Close">
                        <span class="material-symbols-outlined font-bold text-[24px]">close</span>
                    </button>
                </div>
            </div>
            
            <div class="flex-1 overflow-hidden flex flex-col md:flex-row">
                <!-- Left Content -->
                <div class="flex-1 overflow-y-auto p-8 md:pr-10 border-r-4 border-black bg-white">
                    <form id="editTaskForm" method="POST" action="">
                        @csrf
                        @method('PATCH')
                        
                        <textarea name="title" id="detailTaskTitle" rows="1" class="w-full text-[28px] font-extrabold text-black bg-transparent border-2 border-transparent hover:border-slate-300 focus:border-black rounded-xl px-4 py-2 mb-8 resize-none overflow-hidden transition-all focus:shadow-[3px_3px_0px_0px_#630ed4] outline-none" required></textarea>
                        
                        <div class="mb-8">
                            <label class="block text-[15px] font-extrabold text-black mb-3">Description</label>
                            <textarea name="description" id="detailTaskDesc" rows="6" class="w-full text-[15px] font-medium text-black bg-[#f8fafc] border-2 border-black focus:bg-white focus:shadow-[3px_3px_0px_0px_#630ed4] transition-all rounded-xl px-4 py-3 outline-none" placeholder="Add a description..."></textarea>
                        </div>
                        
                        <!-- Activity -->
                        <div class="mt-12 pt-8 border-t-4 border-black border-dashed">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-[18px] font-extrabold text-black">Activity</h3>
                                <div class="text-[14px] font-bold text-black border-2 border-black bg-white px-3 py-1.5 rounded-lg shadow-[2px_2px_0px_0px_#000]">
                                    Comments
                                </div>
                            </div>
                            
                            <div class="flex gap-4 items-start mb-6">
                                <div class="w-10 h-10 rounded-full border-2 border-black bg-orange-400 flex items-center justify-center text-[14px] font-extrabold text-black shrink-0 shadow-[2px_2px_0px_0px_#000]">
                                    {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                                </div>
                                <div class="flex-1">
                                    <input type="text" class="w-full bg-white border-2 border-black rounded-xl px-4 py-3 text-[15px] font-bold outline-none focus:shadow-[3px_3px_0px_0px_#630ed4] transition-all" placeholder="Add a comment...">
                                    <div class="mt-3 flex gap-2">
                                        <button type="submit" class="px-6 py-2 bg-purple-600 border-2 border-black text-white hover:bg-purple-700 rounded-xl font-extrabold text-[14px] shadow-[3px_3px_0px_0px_#000] btn-fun">Save Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Right Sidebar -->
                <div class="w-full md:w-[380px] bg-slate-50 p-8 flex flex-col gap-8 overflow-y-auto shrink-0">
                    
                    <!-- Status Dropdown -->
                    <div>
                        <select name="status_id" id="detailTaskStatus" form="editTaskForm" class="w-full bg-white border-2 border-black rounded-xl px-4 py-3 text-[14px] font-extrabold text-black uppercase focus:shadow-[3px_3px_0px_0px_#630ed4] transition-all cursor-pointer shadow-[2px_2px_0px_0px_#000] outline-none">
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="bg-white border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000] overflow-hidden">
                        <div class="p-4 border-b-2 border-black bg-pink-100 flex items-center justify-between font-extrabold text-black">
                            Details
                        </div>
                        <div class="p-5 space-y-5">
                            <div class="flex flex-col gap-2">
                                <label class="text-[13px] font-bold text-slate-500 uppercase tracking-widest">Assignee</label>
                                <select name="assignee_id" id="detailTaskAssignee" form="editTaskForm" class="w-full bg-[#f8fafc] border-2 border-black rounded-lg px-3 py-2 text-[14px] font-bold text-black focus:shadow-[2px_2px_0px_0px_#630ed4] transition-all cursor-pointer outline-none">
                                    <option value="">Unassigned</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="flex flex-col gap-2">
                                <label class="text-[13px] font-bold text-slate-500 uppercase tracking-widest">Type</label>
                                <select name="type" id="detailTaskTypeSelect" form="editTaskForm" class="w-full bg-[#f8fafc] border-2 border-black rounded-lg px-3 py-2 text-[14px] font-bold text-black focus:shadow-[2px_2px_0px_0px_#630ed4] transition-all cursor-pointer outline-none">
                                    <option value="task">Task</option>
                                    <option value="bug">Bug</option>
                                    <option value="story">Story</option>
                                </select>
                            </div>
                            
                            <div class="flex flex-col gap-2">
                                <label class="text-[13px] font-bold text-slate-500 uppercase tracking-widest">Priority</label>
                                <select name="priority" id="detailTaskPriority" form="editTaskForm" class="w-full bg-[#f8fafc] border-2 border-black rounded-lg px-3 py-2 text-[14px] font-bold text-black focus:shadow-[2px_2px_0px_0px_#630ed4] transition-all cursor-pointer outline-none">
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Column Modal -->
    <div id="createColumnModal" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center hidden backdrop-blur-sm">
        <div class="bg-white border-4 border-black rounded-2xl w-full max-w-[400px] shadow-[8px_8px_0px_0px_#000] pop-in">
            <div class="flex justify-between items-center p-6 border-b-4 border-black bg-pink-100 rounded-t-xl">
                <h2 class="text-[24px] font-extrabold text-black">Add Column</h2>
                <button onclick="document.getElementById('createColumnModal').classList.add('hidden')" class="w-10 h-10 flex items-center justify-center rounded-xl border-2 border-black hover:bg-white transition-colors bg-pink-200 btn-fun">
                    <span class="material-symbols-outlined font-bold">close</span>
                </button>
            </div>
            <div class="p-8">
                <form action="{{ route('statuses.store', $project) }}" method="POST" id="createColForm" class="space-y-6 font-bold text-[15px]">
                    @csrf
                    <div>
                        <label class="block font-extrabold text-black mb-2">Column Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" class="w-full bg-[#f8fafc] border-2 border-black rounded-xl px-4 py-3 focus:outline-none focus:shadow-[3px_3px_0px_0px_#630ed4] transition-all" placeholder="e.g. IN REVIEW" required>
                    </div>
                    <div>
                        <label class="block font-extrabold text-black mb-2">Category Color</label>
                        <select name="color" class="w-full bg-white border-2 border-black rounded-xl px-4 py-3 focus:outline-none focus:shadow-[3px_3px_0px_0px_#630ed4] transition-all cursor-pointer">
                            <option value="slate">Slate (Gray)</option>
                            <option value="blue" selected>Blue</option>
                            <option value="yellow">Yellow</option>
                            <option value="green">Green</option>
                            <option value="purple">Purple</option>
                            <option value="pink">Pink</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="p-6 flex justify-end gap-3 border-t-4 border-black bg-slate-50 rounded-b-xl">
                <button type="button" onclick="document.getElementById('createColumnModal').classList.add('hidden')" class="px-6 py-2.5 text-[15px] font-bold text-black border-2 border-transparent hover:border-black rounded-xl transition-all">Cancel</button>
                <button type="submit" form="createColForm" class="px-8 py-2.5 bg-pink-500 border-2 border-black text-white hover:bg-pink-600 rounded-xl font-extrabold text-[15px] shadow-[3px_3px_0px_0px_#000] btn-fun">Add</button>
            </div>
        </div>
    </div>

    <!-- Confirm Dialog -->
    <div id="confirmDialog" class="fixed inset-0 bg-black/60 z-[60] flex items-center justify-center hidden backdrop-blur-sm">
        <div class="bg-white border-4 border-black rounded-2xl w-full max-w-[400px] shadow-[8px_8px_0px_0px_#000] p-8 pop-in">
            <div class="flex items-center gap-4 text-red-500 mb-6">
                <div class="w-12 h-12 bg-red-100 border-2 border-red-500 rounded-xl flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[28px] font-bold">warning</span>
                </div>
                <h3 class="text-[24px] font-extrabold text-black">Delete Issue?</h3>
            </div>
            <p class="text-[15px] font-medium text-black mb-8">You're about to permanently delete this issue, its comments, and attachments. This action <span class="font-bold underline decoration-red-500 decoration-4">cannot be undone</span>.</p>
            <div class="flex justify-end gap-3">
                <button type="button" id="confirmCancel" class="px-6 py-2.5 font-bold text-black border-2 border-transparent hover:border-black rounded-xl transition-all">Cancel</button>
                <button type="button" id="confirmOk" class="px-8 py-2.5 bg-red-500 border-2 border-black hover:bg-red-600 text-white rounded-xl font-extrabold shadow-[3px_3px_0px_0px_#000] btn-fun">Delete</button>
            </div>
        </div>
    </div>

    <script>
        (function () {
            // Smooth custom cursor
            const dot  = document.getElementById('cursor-dot');
            const ring = document.getElementById('cursor-ring');
            if (dot && ring) {
                let mx = 0, my = 0, rx = 0, ry = 0;
                document.addEventListener('mousemove', e => {
                    mx = e.clientX; my = e.clientY;
                    dot.style.left = mx + 'px';
                    dot.style.top  = my + 'px';
                });
                (function loop() {
                    rx += (mx - rx) * 0.15;
                    ry += (my - ry) * 0.15;
                    ring.style.left = rx + 'px';
                    ring.style.top  = ry + 'px';
                    requestAnimationFrame(loop);
                })();
                
                const interactiveElements = document.querySelectorAll('a, button, input, select, textarea, .cursor-pointer');
                interactiveElements.forEach(el => {
                    el.addEventListener('mouseenter', () => document.body.classList.add('cursor-on-btn'));
                    el.addEventListener('mouseleave', () => document.body.classList.remove('cursor-on-btn'));
                });
            }

            // Confirm delete feature
            window.customConfirmDelete = function(form) {
                const dialog = document.getElementById('confirmDialog');
                dialog.classList.remove('hidden');
                
                document.getElementById('confirmCancel').onclick = function() {
                    dialog.classList.add('hidden');
                };
                
                document.getElementById('confirmOk').onclick = function() {
                    form.submit();
                };
            };

            // Drag and Drop Logic
            const columns = document.querySelectorAll('.kanban-col');
            let draggedItem = null;

            document.querySelectorAll('.task-card').forEach(card => {
                card.addEventListener('dragstart', function(e) {
                    draggedItem = this;
                    setTimeout(() => this.classList.add('dragging'), 0);
                    e.dataTransfer.effectAllowed = 'move';
                });

                card.addEventListener('dragend', function() {
                    this.classList.remove('dragging');
                    draggedItem = null;
                    columns.forEach(col => col.classList.remove('drag-over', 'border-black'));
                });
            });

            columns.forEach(col => {
                col.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.classList.add('drag-over', 'border-black');
                    
                    const afterElement = getDragAfterElement(col, e.clientY);
                    if (afterElement == null) {
                        col.appendChild(draggedItem);
                    } else {
                        col.insertBefore(draggedItem, afterElement);
                    }
                });

                col.addEventListener('dragleave', function() {
                    this.classList.remove('drag-over', 'border-black');
                });

                col.addEventListener('drop', function(e) {
                    this.classList.remove('drag-over', 'border-black');
                    if (!draggedItem) return;
                    
                    const taskId = draggedItem.dataset.id;
                    const newStatus = this.dataset.status;
                    
                    updateCounts();

                    const taskElements = [...this.querySelectorAll('.task-card')];
                    const newOrder = taskElements.indexOf(draggedItem);

                    fetch(`/tasks/${taskId}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            status_id: newStatus,
                            order: newOrder
                        })
                    }).catch(console.error);
                });
            });

            function getDragAfterElement(container, y) {
                const draggableElements = [...container.querySelectorAll('.task-card:not(.dragging)')];
                return draggableElements.reduce((closest, child) => {
                    const box = child.getBoundingClientRect();
                    const offset = y - box.top - box.height / 2;
                    if (offset < 0 && offset > closest.offset) {
                        return { offset: offset, element: child };
                    } else {
                        return closest;
                    }
                }, { offset: Number.NEGATIVE_INFINITY }).element;
            }

            function updateCounts() {
                document.querySelectorAll('.count-badge').forEach(badge => {
                    const statusId = badge.dataset.status;
                    const count = document.querySelectorAll(`#col-${statusId} .task-card`).length;
                    badge.textContent = count;
                });
            }

            // Task Details Modal Logic
            window.openTaskDetails = function(task, projectKey) {
                const modal = document.getElementById('taskDetailsModal');
                const form = document.getElementById('editTaskForm');
                
                document.getElementById('detailTaskKey').textContent = `${projectKey}-${task.id}`;
                
                // Icon based on type
                const iconMap = {'task': 'check', 'bug': 'bug_report', 'story': 'bookmark'};
                const bgMap = {'task': 'bg-blue-500', 'bug': 'bg-red-500', 'story': 'bg-green-500'};
                
                const typeIcon = document.getElementById('detailTaskType');
                const typeBg = document.getElementById('detailTaskTypeBg');
                const t = task.type || 'task';
                
                typeIcon.textContent = iconMap[t] || 'check';
                typeBg.className = `w-8 h-8 rounded border-2 border-black flex items-center justify-center text-white shadow-[2px_2px_0px_0px_#000] ${bgMap[t] || 'bg-blue-500'}`;
                
                form.action = `/tasks/${task.id}`;
                
                document.getElementById('detailTaskTitle').value = task.title;
                document.getElementById('detailTaskDesc').value = task.description || '';
                document.getElementById('detailTaskStatus').value = task.status_id;
                document.getElementById('detailTaskPriority').value = task.priority;
                document.getElementById('detailTaskTypeSelect').value = t;
                document.getElementById('detailTaskAssignee').value = task.assignee_id || '';
                
                modal.classList.remove('hidden');
                
                const titleTextarea = document.getElementById('detailTaskTitle');
                titleTextarea.style.height = 'auto';
                titleTextarea.style.height = (titleTextarea.scrollHeight) + 'px';
                
                titleTextarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
            };
        })();

        // Neo-brutalist Toast System
        window.showToast = function(message, icon = 'info') {
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-10 left-1/2 -translate-x-1/2 bg-white border-4 border-black px-6 py-4 rounded-2xl shadow-[8px_8px_0px_0px_#000] flex items-center gap-4 z-[9999] pop-in font-bold text-black border-b-8 border-b-purple-600';
            toast.innerHTML = `
                <span class="material-symbols-outlined text-[24px] text-purple-600">${icon}</span>
                <span class="text-[15px]">${message}</span>
            `;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translate(-50%, 20px)';
                toast.style.transition = 'all 0.3s';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        };
    </script>
</body>
</html>
