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
            transition: all 0.2s ease; 
            border-radius: 8px;
            border: 1px solid transparent;
        }
        .nav-item:hover { 
            background: #f1f5f9; 
            color: #000;
        }
        .nav-item:active {
            transform: scale(0.98);
        }
        .nav-item.active { 
            background: #eef2ff; 
            border: 2px solid #000; 
            box-shadow: 2px 2px 0 0 #000;
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

    <!-- Collapsible Sidebar (Hover to Expand) -->
    <aside class="group w-[72px] hover:w-[220px] flex flex-col bg-white border-r-2 border-black/10 z-40 transition-all duration-300 ease-in-out overflow-hidden fixed h-screen top-0 left-0 hover:shadow-[4px_0_24px_rgba(0,0,0,0.06)]">
        <!-- Logo Area -->
        <div class="h-16 flex items-center px-4 border-b-2 border-black/10 flex-shrink-0">
            <a href="/" class="flex items-center gap-3 cursor-pointer w-full">
                <div class="w-[36px] h-[36px] flex-shrink-0 bg-primary border-2 border-black rounded-lg shadow-[2px_2px_0px_0px_#000] flex items-center justify-center text-white font-bold text-sm group-hover:rotate-12 transition-transform duration-300">P</div>
                <span class="font-bold text-black tracking-tight text-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">PULSE</span>
            </a>
        </div>

        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto overflow-x-hidden py-5 space-y-8">
            <div class="px-3 space-y-1.5 w-full">
                <a href="?page=space" class="nav-item {{ $page == 'space' ? 'active' : '' }} flex items-center gap-3 px-2 py-2.5 text-sm font-semibold text-slate-600 relative overflow-hidden" title="Space">
                    <span class="material-symbols-outlined text-[20px] flex-shrink-0">space_dashboard</span>
                    <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">Space</span>
                </a>
                <a href="?page=recent" class="nav-item {{ $page == 'recent' ? 'active' : '' }} flex items-center gap-3 px-2 py-2.5 text-sm font-semibold text-slate-600 relative overflow-hidden" title="Recent">
                    <span class="material-symbols-outlined text-[20px] flex-shrink-0">schedule</span>
                    <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">Recent</span>
                </a>
                <a href="?page=starred" class="nav-item {{ $page == 'starred' ? 'active' : '' }} flex items-center gap-3 px-2 py-2.5 text-sm font-semibold text-slate-600 relative overflow-hidden" title="Starred">
                    <span class="material-symbols-outlined text-[20px] flex-shrink-0">star</span>
                    <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">Starred</span>
                </a>
                <a href="?page=plans" class="nav-item {{ $page == 'plans' ? 'active' : '' }} flex items-center gap-3 px-2 py-2.5 text-sm font-semibold text-slate-600 relative overflow-hidden" title="Plans">
                    <span class="material-symbols-outlined text-[20px] flex-shrink-0">event_note</span>
                    <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">Plans</span>
                </a>
            </div>
        </div>

        <!-- Bottom Action (Logout) -->
        <div class="p-3 border-t-2 border-black/5 bg-white flex-shrink-0">
            <form action="{{ route('welcome') }}" method="GET" class="m-0 p-0 w-full">
                <button type="submit" title="Log out" class="w-full flex items-center gap-3 px-2 py-2.5 text-sm font-semibold text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors overflow-hidden">
                    <span class="material-symbols-outlined text-[20px] flex-shrink-0">logout</span>
                    <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">Log out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0 relative ml-[72px] transition-all duration-300">
        
        <!-- Header / Navbar -->
        <header class="h-16 flex items-center justify-between px-6 md:px-8 flex-shrink-0 bg-white/60 border-b-2 border-black/5 z-20 backdrop-blur-md sticky top-0">
            
            <!-- Left Side: Title & Search -->
            <div class="flex items-center gap-6 flex-1 min-w-0">
                <h1 class="text-xl font-bold text-black tracking-tight whitespace-nowrap hidden sm:block">
                    {{ $currentTitle }}
                </h1>
                
                <!-- Search Bar -->
                <div class="relative w-full max-w-sm group-search hidden md:block">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[18px] transition-colors pointer-events-none">search</span>
                    <input type="text" placeholder="Search spaces, tasks..." class="w-full bg-slate-100 border-2 border-transparent rounded-lg pl-9 pr-4 py-1.5 text-sm font-semibold text-black focus:outline-none focus:border-black focus:bg-white focus:shadow-[2px_2px_0px_0px_#000] transition-all placeholder:text-slate-400">
                </div>
            </div>

            <!-- Right Side: Create & Profile -->
            <div class="flex items-center gap-4 flex-shrink-0">
                <button class="bg-primary text-white font-bold py-1.5 px-3.5 rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000] btn-fun flex items-center gap-1.5 text-sm">
                    <span class="material-symbols-outlined text-[18px]">add</span> <span class="hidden sm:inline">Create</span>
                </button>

                <div class="w-px h-6 bg-slate-200 hidden sm:block"></div>

                <!-- User Profile -->
                <div class="flex items-center gap-2.5 cursor-pointer group px-2 py-1.5 rounded-lg hover:bg-slate-100 transition-colors">
                    <div class="w-8 h-8 rounded-full border-2 border-black/80 bg-emerald-100 flex items-center justify-center text-xs font-bold text-emerald-800 shadow-sm group-hover:bg-yellow-200 group-hover:text-yellow-800 transition-colors">MZ</div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-bold text-black leading-none">Muhammad Zidane</p>
                    </div>
                    <span class="material-symbols-outlined text-[18px] text-slate-400 group-hover:text-black transition-colors hidden md:block">expand_more</span>
                </div>
            </div>
        </header>

        <!-- Dynamic Content Area -->
        <div class="flex-1 overflow-auto p-6 md:p-10 flex items-center justify-center fade-in">
            <!-- Empty State (Softer & Jira-like) -->
            <div class="max-w-sm w-full text-center flex flex-col items-center">
                @if($page == 'space')
                    <div class="w-16 h-16 bg-yellow-100 border-2 border-black rounded-xl shadow-[3px_3px_0px_0px_#000] flex items-center justify-center mb-6 empty-bounce">
                        <span class="material-symbols-outlined text-[28px] text-black">space_dashboard</span>
                    </div>
                    <h2 class="text-xl font-bold text-black mb-2">Your space is empty</h2>
                    <p class="text-slate-500 font-medium text-sm mb-6 leading-relaxed">Create tasks, notes, or projects to start organizing your workflow.</p>
                @elseif($page == 'recent')
                    <div class="w-16 h-16 bg-blue-100 border-2 border-black rounded-full shadow-[3px_3px_0px_0px_#000] flex items-center justify-center mb-6 empty-bounce" style="animation-delay: 0.2s;">
                        <span class="material-symbols-outlined text-[28px] text-black">history</span>
                    </div>
                    <h2 class="text-xl font-bold text-black mb-2">No recent activity</h2>
                    <p class="text-slate-500 font-medium text-sm mb-6 leading-relaxed">You haven't interacted with any items recently. Your history will appear here.</p>
                @elseif($page == 'starred')
                    <div class="w-16 h-16 bg-purple-100 border-2 border-black rounded-full shadow-[3px_3px_0px_0px_#000] flex items-center justify-center mb-6 empty-bounce" style="animation-delay: 0.1s;">
                        <span class="material-symbols-outlined text-[28px] text-black">star</span>
                    </div>
                    <h2 class="text-xl font-bold text-black mb-2">No starred items</h2>
                    <p class="text-slate-500 font-medium text-sm mb-6 leading-relaxed">Keep your most important projects one click away by starring them.</p>
                @elseif($page == 'plans')
                    <div class="w-16 h-16 bg-emerald-100 border-2 border-black rounded-xl shadow-[3px_3px_0px_0px_#000] flex items-center justify-center mb-6 empty-bounce" style="animation-delay: 0.3s;">
                        <span class="material-symbols-outlined text-[28px] text-black">event_note</span>
                    </div>
                    <h2 class="text-xl font-bold text-black mb-2">No plans defined</h2>
                    <p class="text-slate-500 font-medium text-sm mb-6 leading-relaxed">Map out your strategy and create a roadmap for your team.</p>
                @endif
                
                <button class="bg-white border-2 border-black text-black font-bold py-2 px-4 rounded-lg shadow-[2px_2px_0px_0px_#000] btn-fun flex items-center gap-1.5 text-sm hover:bg-slate-50">
                    <span class="material-symbols-outlined text-[18px]">add_circle</span> Get Started
                </button>
            </div>
        </div>
    </main>

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

