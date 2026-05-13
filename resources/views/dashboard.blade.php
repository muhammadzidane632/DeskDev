<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PULSE — Dashboard</title>
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

        /* Clean Sidebar Nav (Soft Neobrutal) */
        .nav-item { 
            transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1); 
            border-radius: 12px;
            border: 2px solid transparent;
            font-weight: 800;
        }
        .nav-item:hover { 
            background: #fdf2f8; 
            border-color: #000;
            color: #000;
            box-shadow: 2px 2px 0 0 #000;
            transform: translateY(-2px);
        }
        .nav-item:active {
            transform: translateY(0);
            box-shadow: 0 0 0 0 #000;
        }
        .nav-item.active { 
            background: #f3e8ff; 
            border: 2px solid #000; 
            box-shadow: 3px 3px 0 0 #000;
            color: #000;
        }

        /* Fun Elements */
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

        /* Empty State Animation (Softer) */
        .empty-bounce {
            animation: floatSoft 4s ease-in-out infinite;
        }
        @keyframes floatSoft {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
            100% { transform: translateY(0px); }
        }
        
        .fade-in { animation: fadeIn 0.3s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="text-slate-800 overflow-hidden flex h-screen selection:bg-primary selection:text-white">

    @php
        $page = request()->query('page', 'space');
        $pageTitles = [
            'space' => 'My Space',
            'recent' => 'Recent Activity',
            'starred' => 'Starred Items',
            'plans' => 'My Plans'
        ];
        $currentTitle = $pageTitles[$page] ?? 'Dashboard';
    @endphp

    {{-- Custom cursor --}}
    <div id="cursor-dot"></div>
    <div id="cursor-ring"></div>

    <!-- Fixed Sidebar (Playful Neo-Brutal Jira Style) -->
    <aside class="w-[260px] flex flex-col bg-white border-r-4 border-black z-40 fixed h-screen top-0 left-0 flex-shrink-0">
        <!-- Logo Area -->
        <div class="h-16 flex items-center px-6 border-b-4 border-black flex-shrink-0 bg-yellow-100">
            <a href="/" class="flex items-center gap-3 cursor-pointer w-full group">
                <div class="w-9 h-9 flex-shrink-0 bg-blue-600 border-2 border-black rounded-xl shadow-[2px_2px_0px_0px_#000] flex items-center justify-center text-white font-black text-lg group-hover:-rotate-12 transition-transform duration-300 btn-fun">P</div>
                <span class="font-black text-black tracking-tight text-2xl whitespace-nowrap">PULSE</span>
            </a>
        </div>

        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto overflow-x-hidden py-6 space-y-8">
            <div class="px-4 space-y-2 w-full">
                <!-- Group: Main -->
                <a href="?page=space" class="nav-item {{ $page == 'space' ? 'active' : '' }} flex items-center gap-4 px-3 py-3 text-[15px] text-slate-700 relative overflow-hidden" title="For you">
                    <span class="material-symbols-outlined text-[24px] {{ $page == 'space' ? 'text-purple-600' : '' }}">person</span>
                    <span class="whitespace-nowrap">For you</span>
                </a>
                <a href="?page=recent" class="nav-item {{ $page == 'recent' ? 'active' : '' }} flex items-center justify-between px-3 py-3 text-[15px] text-slate-700 relative overflow-hidden" title="Recent">
                    <div class="flex items-center gap-4">
                        <span class="material-symbols-outlined text-[24px]">schedule</span>
                        <span class="whitespace-nowrap">Recent</span>
                    </div>
                    <span class="material-symbols-outlined text-[20px]">chevron_right</span>
                </a>
                <a href="?page=starred" class="nav-item {{ $page == 'starred' ? 'active' : '' }} flex items-center justify-between px-3 py-3 text-[15px] text-slate-700 relative overflow-hidden" title="Starred">
                    <div class="flex items-center gap-4">
                        <span class="material-symbols-outlined text-[24px]">star</span>
                        <span class="whitespace-nowrap">Starred</span>
                    </div>
                    <span class="material-symbols-outlined text-[20px]">chevron_right</span>
                </a>
                <a href="javascript:void(0)" class="nav-item flex items-center gap-4 px-3 py-3 text-[15px] text-slate-700 relative overflow-hidden" title="Apps">
                    <span class="material-symbols-outlined text-[24px]">apps</span>
                    <span class="whitespace-nowrap">Apps</span>
                </a>
                <a href="?page=plans" class="nav-item {{ $page == 'plans' ? 'active' : '' }} flex items-center gap-4 px-3 py-3 text-[15px] text-slate-700 relative overflow-hidden" title="Plans">
                    <span class="material-symbols-outlined text-[24px]">layers</span>
                    <span class="whitespace-nowrap">Plans</span>
                </a>
                
                <div class="my-4 border-b-2 border-black border-dashed mx-2 opacity-30"></div>
                
                <!-- Spaces / Projects -->
                <div class="px-3 flex items-center justify-between text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 mt-4">
                    <span>Spaces</span>
                    <span class="material-symbols-outlined text-[18px] cursor-pointer hover:text-black">add</span>
                </div>
                
                <div class="space-y-1">
                    <div class="text-[11px] font-bold text-slate-400 px-3 py-2 uppercase tracking-wide">Recent</div>
                    @if(isset($projects) && $projects->count() > 0)
                        <a href="{{ route('projects.show', $projects->first()) }}" class="flex items-center gap-3 px-3 py-2 hover:bg-slate-100 border-2 border-transparent hover:border-black rounded-xl font-bold transition-all text-[14px]">
                            <div class="w-6 h-6 rounded-md bg-purple-100 border-2 border-black flex items-center justify-center text-xs shadow-[1px_1px_0px_0px_#000]">
                                {{ substr($projects->first()->name, 0, 1) }}
                            </div>
                            <span class="truncate">{{ $projects->first()->name }}</span>
                        </a>
                    @endif
                    <a href="javascript:void(0)" class="flex items-center justify-between px-3 py-2 hover:bg-slate-100 border-2 border-transparent hover:border-black rounded-xl font-bold transition-all text-[14px]">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[20px]">view_list</span>
                            <span class="truncate">More spaces</span>
                        </div>
                        <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                    </a>
                </div>
                
                <!-- Teams -->
                <div class="px-3 flex items-center justify-between text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 mt-8">
                    <span>Teams</span>
                    <span class="material-symbols-outlined text-[18px] cursor-pointer hover:text-black">open_in_new</span>
                </div>
            </div>
        </div>

        <!-- Bottom Action (Logout) -->
        <div class="p-4 border-t-4 border-black bg-pink-50 flex-shrink-0">
            <form action="{{ route('welcome') }}" method="GET" class="m-0 p-0 w-full">
                <button type="submit" title="Log out" class="w-full flex items-center gap-3 px-4 py-3 text-[15px] font-extrabold text-black bg-white border-2 border-black rounded-xl shadow-[3px_3px_0px_0px_#000] btn-fun text-left">
                    <span class="material-symbols-outlined text-[20px]">logout</span>
                    <span class="whitespace-nowrap">Log out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0 relative ml-[260px]">
        
        <!-- Header / Navbar -->
        <header class="h-16 flex items-center justify-between px-6 md:px-8 flex-shrink-0 bg-white border-b-4 border-black z-20 sticky top-0">
            
            <!-- Left Side: Search (Takes up flex space) -->
            <div class="flex items-center gap-6 flex-1 min-w-0 mr-8">
                <!-- Search Bar -->
                <div class="relative w-full max-w-2xl group-search">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-black font-extrabold text-[20px] pointer-events-none">search</span>
                    <input type="text" placeholder="Search" class="w-full bg-white border-2 border-black rounded-xl pl-12 pr-4 py-2 text-[15px] font-bold text-black focus:outline-none focus:shadow-[4px_4px_0px_0px_#000] focus:-translate-y-1 transition-all placeholder:text-slate-400">
                </div>
            </div>

            <!-- Right Side: Create & Profile -->
            <div class="flex items-center gap-5 flex-shrink-0">
                <button onclick="document.getElementById('createProjectModal').classList.remove('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-2 px-5 rounded-xl border-2 border-black shadow-[3px_3px_0px_0px_#000] btn-fun flex items-center gap-2 text-[15px]">
                    <span class="material-symbols-outlined text-[20px] font-black">add</span> <span class="hidden sm:inline">Create</span>
                </button>

                <div class="flex items-center gap-4 text-black">
                    <button class="w-10 h-10 rounded-xl border-2 border-transparent hover:border-black bg-white hover:bg-yellow-200 flex items-center justify-center transition-all">
                        <span class="material-symbols-outlined text-[22px]">notifications</span>
                    </button>
                    <button class="w-10 h-10 rounded-xl border-2 border-transparent hover:border-black bg-white hover:bg-pink-200 flex items-center justify-center transition-all">
                        <span class="material-symbols-outlined text-[22px]">help</span>
                    </button>
                    <button class="w-10 h-10 rounded-xl border-2 border-transparent hover:border-black bg-white hover:bg-slate-200 flex items-center justify-center transition-all">
                        <span class="material-symbols-outlined text-[22px]">settings</span>
                    </button>
                    <!-- User Profile Avatar -->
                    <div class="w-10 h-10 rounded-full border-2 border-black bg-emerald-400 flex items-center justify-center text-[15px] font-extrabold text-black shadow-[2px_2px_0px_0px_#000] btn-fun cursor-pointer select-none">
                        MZ
                    </div>
                </div>
            </div>
        </header>

        <!-- Dynamic Content Area -->
        <div class="flex-1 overflow-auto p-8 fade-in flex">
            @if($page == 'space')
                
                <!-- Main Content (Left Column) -->
                <div class="flex-1 pr-10">
                    <h2 class="text-3xl font-black text-black mb-8">For you</h2>
                    
                    <!-- Recent Spaces Section -->
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-xl font-extrabold text-black">Recent spaces</h3>
                        <a href="#" class="text-sm font-bold text-blue-600 hover:text-blue-800 hover:underline">View all spaces</a>
                    </div>
                    
                    @if(isset($projects) && $projects->count() > 0)
                        <!-- Horizontal Scroll / Flex container for projects -->
                        <div class="flex gap-6 mb-12 overflow-x-auto pb-4 pt-2 px-2 -mx-2">
                            @foreach($projects->take(4) as $project)
                            <a href="{{ route('projects.show', $project) }}" class="min-w-[240px] flex-1 bg-white border-2 border-black rounded-2xl p-4 shadow-[4px_4px_0px_0px_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0px_0px_#000] transition-all cursor-pointer group flex items-start gap-4">
                                <div class="w-12 h-12 flex-shrink-0 rounded-xl border-2 border-black bg-purple-100 flex items-center justify-center font-black text-lg text-black group-hover:bg-yellow-200 transition-colors shadow-[2px_2px_0px_0px_#000]">
                                    {{ substr($project->name, 0, 1) }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-base font-bold text-black truncate">{{ $project->name }}</h4>
                                    <p class="text-xs font-bold text-slate-500 mt-1">Pulse Software project</p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        
                        <!-- Tabs -->
                        <div class="flex gap-8 mb-6 border-b-2 border-black">
                            <button class="pb-3 text-[15px] font-extrabold text-blue-600 border-b-4 border-blue-600 relative top-[2px]">Worked on</button>
                            <button class="pb-3 text-[15px] font-bold text-slate-500 hover:text-black transition-colors">Viewed</button>
                            <button class="pb-3 text-[15px] font-bold text-slate-500 hover:text-black transition-colors">Assigned to me</button>
                            <button class="pb-3 text-[15px] font-bold text-slate-500 hover:text-black transition-colors">Starred</button>
                        </div>
                        
                        <!-- List of Projects / Items -->
                        <div class="bg-white border-2 border-black rounded-2xl shadow-[4px_4px_0px_0px_#000] overflow-hidden">
                            @foreach($projects as $project)
                            <div class="flex items-center gap-4 p-4 border-b-2 border-black last:border-b-0 hover:bg-yellow-50 transition-colors cursor-pointer group">
                                <div class="w-5 h-5 rounded-md border-2 border-black bg-white group-hover:shadow-[1px_1px_0px_0px_#000] flex-shrink-0 cursor-pointer"></div>
                                <div class="w-10 h-10 flex-shrink-0 rounded-xl border-2 border-black bg-purple-100 flex items-center justify-center font-black text-black group-hover:bg-purple-200 transition-colors shadow-[2px_2px_0px_0px_#000]">
                                    {{ substr($project->name, 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-[15px] font-bold text-black truncate">{{ $project->name }}</h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <p class="text-xs font-bold text-slate-500">{{ $project->name }} \ Pulse Software project</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Existing empty state -->
                        <div class="h-64 flex items-center justify-center bg-white border-2 border-black rounded-2xl shadow-[4px_4px_0px_0px_#000]">
                            <div class="text-center flex flex-col items-center">
                                <div class="w-16 h-16 bg-yellow-300 border-2 border-black rounded-2xl shadow-[3px_3px_0px_0px_#000] flex items-center justify-center mb-4 empty-bounce">
                                    <span class="material-symbols-outlined text-[32px] text-black font-black">space_dashboard</span>
                                </div>
                                <h2 class="text-xl font-extrabold text-black mb-2">Your space is empty</h2>
                                <p class="text-slate-600 font-bold text-[14px] mb-6">Create projects to start organizing your workflow.</p>
                                
                                <button onclick="document.getElementById('createProjectModal').classList.remove('hidden')" class="bg-purple-600 border-2 border-black text-white font-extrabold py-2 px-6 rounded-xl shadow-[3px_3px_0px_0px_#000] btn-fun flex items-center gap-2 text-[14px]">
                                    <span class="material-symbols-outlined text-[18px] font-black">add_circle</span> Create Project
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Right Column (Widget / Promo) -->
                <div class="w-[320px] flex-shrink-0">
                    <div class="bg-pink-100 border-4 border-black rounded-2xl p-6 shadow-[6px_6px_0px_0px_#000] sticky top-24 transform rotate-1 hover:rotate-0 transition-transform btn-fun">
                        <div class="w-14 h-14 bg-white border-2 border-black rounded-xl shadow-[2px_2px_0px_0px_#000] flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-pink-500 text-[28px]">support_agent</span>
                        </div>
                        <h3 class="text-xl font-black text-black leading-tight mb-2">Try Pulse Service Management</h3>
                        <p class="text-[14px] font-bold text-slate-800 mb-6 leading-relaxed">High-velocity IT service management for Dev, IT, and business teams.</p>
                        <button class="w-full bg-black text-white font-extrabold py-3 border-2 border-black rounded-xl shadow-[2px_2px_0px_0px_#000] hover:bg-slate-800 hover:text-white transition-all transform hover:-translate-y-1 hover:shadow-[4px_4px_0px_0px_#000] flex items-center justify-center gap-2">
                            <span>Get started</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </button>
                    </div>
                </div>

            @elseif($page == 'recent')
                <!-- Keeping existing empty states for other pages for now -->
                <div class="h-full flex items-center justify-center">
                    <div class="max-w-sm w-full text-center flex flex-col items-center border-4 border-black rounded-3xl p-10 bg-white shadow-[8px_8px_0px_0px_#000]">
                        <div class="w-20 h-20 bg-blue-300 border-4 border-black rounded-2xl shadow-[4px_4px_0px_0px_#000] flex items-center justify-center mb-6 empty-bounce" style="animation-delay: 0.2s;">
                            <span class="material-symbols-outlined text-[36px] text-black font-black">history</span>
                        </div>
                        <h2 class="text-2xl font-extrabold text-black mb-3">No recent activity</h2>
                        <p class="text-slate-800 font-bold text-[15px] mb-6 leading-relaxed">You haven't interacted with any items recently. Your history will appear here.</p>
                    </div>
                </div>
            @elseif($page == 'starred')
                <div class="h-full flex items-center justify-center">
                    <div class="max-w-sm w-full text-center flex flex-col items-center border-4 border-black rounded-3xl p-10 bg-white shadow-[8px_8px_0px_0px_#000]">
                        <div class="w-20 h-20 bg-pink-300 border-4 border-black rounded-2xl shadow-[4px_4px_0px_0px_#000] flex items-center justify-center mb-6 empty-bounce" style="animation-delay: 0.1s;">
                            <span class="material-symbols-outlined text-[36px] text-black font-black">star</span>
                        </div>
                        <h2 class="text-2xl font-extrabold text-black mb-3">No starred items</h2>
                        <p class="text-slate-800 font-bold text-[15px] mb-6 leading-relaxed">Keep your most important projects one click away by starring them.</p>
                    </div>
                </div>
            @elseif($page == 'plans')
                <div class="h-full flex items-center justify-center">
                    <div class="max-w-sm w-full text-center flex flex-col items-center border-4 border-black rounded-3xl p-10 bg-white shadow-[8px_8px_0px_0px_#000]">
                        <div class="w-20 h-20 bg-emerald-300 border-4 border-black rounded-2xl shadow-[4px_4px_0px_0px_#000] flex items-center justify-center mb-6 empty-bounce" style="animation-delay: 0.3s;">
                            <span class="material-symbols-outlined text-[36px] text-black font-black">event_note</span>
                        </div>
                        <h2 class="text-2xl font-extrabold text-black mb-3">No plans defined</h2>
                        <p class="text-slate-800 font-bold text-[15px] mb-6 leading-relaxed">Map out your strategy and create a roadmap for your team.</p>
                    </div>
                </div>
            @endif
        </div>
    </main>

    <!-- Create Project Modal -->
    <div id="createProjectModal" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center hidden backdrop-blur-sm">
        <div class="bg-white border-4 border-black rounded-2xl w-full max-w-md p-6 shadow-[8px_8px_0px_0px_#000] pop-in">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-black">New Project</h2>
                <button onclick="document.getElementById('createProjectModal').classList.add('hidden')" class="w-8 h-8 flex items-center justify-center rounded-full border-2 border-black hover:bg-slate-100 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
            <form action="{{ route('projects.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-black mb-1">Project Name</label>
                    <input type="text" name="name" class="w-full bg-[#f8fafc] border-2 border-black rounded-xl px-3 py-2 text-black font-bold text-sm focus:outline-none focus:bg-white focus:shadow-[3px_3px_0px_0px_#630ed4] transition-all" placeholder="e.g. Website Redesign" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-black mb-1">Project Key (Prefix)</label>
                    <input type="text" name="key" class="w-full bg-[#f8fafc] border-2 border-black rounded-xl px-3 py-2 text-black font-bold text-sm focus:outline-none focus:bg-white focus:shadow-[3px_3px_0px_0px_#630ed4] transition-all uppercase" placeholder="e.g. WEB" maxlength="10" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-black mb-1">Description (Optional)</label>
                    <textarea name="description" rows="3" class="w-full bg-[#f8fafc] border-2 border-black rounded-xl px-3 py-2 text-black font-bold text-sm focus:outline-none focus:bg-white focus:shadow-[3px_3px_0px_0px_#630ed4] transition-all"></textarea>
                </div>
                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('createProjectModal').classList.add('hidden')" class="px-4 py-2 font-bold text-slate-600 hover:text-black transition-colors">Cancel</button>
                    <button type="submit" class="bg-primary text-white font-bold py-2 px-6 rounded-xl border-2 border-black shadow-[3px_3px_0px_0px_#000] btn-fun">Create Project</button>
                </div>
            </form>
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
                
                // Add hover state for interactive elements
                const interactiveElements = document.querySelectorAll('a, button, input, .nav-item, .cursor-pointer');
                interactiveElements.forEach(el => {
                    el.addEventListener('mouseenter', () => document.body.classList.add('cursor-on-btn'));
                    el.addEventListener('mouseleave', () => document.body.classList.remove('cursor-on-btn'));
                });
            }
        })();
    </script>
</body>
</html>

