<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PULSE — Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media (pointer: fine) {
            * { cursor: none !important; }
            #cursor-dot, #cursor-ring { pointer-events: none; position: fixed; border-radius: 50%; z-index: 99999; transform: translate(-50%, -50%); }
            #cursor-dot { width: 6px; height: 6px; background: #630ed4; transition: width .15s, height .15s, background .15s, transform .08s; }
            #cursor-ring { width: 32px; height: 32px; border: 2px solid rgba(0,0,0,0.8); transition: width .2s ease, height .2s ease, border-color .2s; }
            .cursor-on-btn #cursor-dot  { width: 0; height: 0; }
            .cursor-on-btn #cursor-ring { width: 40px; height: 40px; background: rgba(99,14,212,.08); border-color: rgba(99,14,212,1); }
        }
        @keyframes pop-in { 0% { opacity: 0; transform: scale(.95) translateY(15px); } 100% { opacity: 1; transform: none; } }
        @keyframes float-y { 0%,100% { transform: translateY(0) rotate(var(--r,0deg)); } 50% { transform: translateY(-10px) rotate(var(--r,0deg)); } }
        .pop-in { animation: pop-in 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; opacity: 0; }
        .bf1 { --r: -6deg; animation: pop-in .5s ease .2s forwards, float-y 4.5s ease-in-out .7s infinite; }
        .bf2 { --r: 4deg; animation: pop-in .5s ease .4s forwards, float-y 5s ease-in-out .9s infinite; }
        
        .btn-social {
            transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .btn-social:hover {
            transform: translateY(-3px);
            box-shadow: 4px 4px 0 0 #000;
        }
        .btn-social:active {
            transform: translateY(0);
            box-shadow: 0 0 0 0 #000 !important;
        }
    </style>
</head>
<body class="bg-[#fafafa] min-h-screen flex flex-col items-center justify-center p-4 relative overflow-hidden selection:bg-primary selection:text-white" style="font-family:'Space Grotesk',sans-serif; background-image: radial-gradient(rgba(0,0,0,0.06) 1.5px, transparent 1.5px); background-size: 24px 24px;">

    {{-- Custom cursor --}}
    <div id="cursor-dot"></div>
    <div id="cursor-ring"></div>

    {{-- Decorative backgrounds (Soft) --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
        <div class="absolute -top-20 -right-20 w-[400px] h-[400px] bg-primary/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[500px] h-[500px] bg-yellow-300/20 rounded-full blur-3xl"></div>
    </div>

    {{-- Floating Badges --}}
    <div class="bf1 absolute top-12 left-6 md:top-24 md:left-24 bg-[#fed01b] p-3 border-2 border-black shadow-[4px_4px_0px_0px_#000] w-[160px] z-10 hidden sm:block rounded-xl" style="--r:-6deg;">
        <p class="text-[10px] font-black text-black/60 uppercase tracking-widest mb-1">Pro Tip</p>
        <p class="text-xs font-bold text-black leading-tight">Sign in to start shipping faster! 🚀</p>
    </div>
    <div class="bf2 absolute bottom-12 right-6 md:bottom-24 md:right-24 bg-white p-2.5 border-2 border-black shadow-[4px_4px_0px_0px_#000] z-10 hidden sm:flex items-center gap-3 rounded-xl" style="--r:4deg;">
        <div class="w-8 h-8 rounded-full border-2 border-black bg-emerald-400 flex items-center justify-center text-black font-black shadow-[2px_2px_0px_0px_#000]">
            <span class="material-symbols-outlined text-[16px]">bolt</span>
        </div>
        <p class="text-[11px] font-bold leading-tight text-black">All systems<br>operational.</p>
    </div>

    {{-- Login Card as a Playful Window Frame --}}
    <div class="w-full max-w-[460px] bg-white border-2 border-black rounded-2xl shadow-[8px_8px_0px_0px_#000] z-20 pop-in flex flex-col overflow-hidden relative" style="animation-delay: 0.1s">
        
        <!-- Window Header -->
        <div class="bg-indigo-50 border-b-2 border-black px-4 py-2.5 flex items-center justify-between">
            <div class="flex gap-1.5">
                <div class="w-3 h-3 rounded-full border-2 border-black bg-red-400"></div>
                <div class="w-3 h-3 rounded-full border-2 border-black bg-yellow-400"></div>
                <div class="w-3 h-3 rounded-full border-2 border-black bg-green-400"></div>
            </div>
            <div class="font-black text-[11px] tracking-widest text-black/80 uppercase">PULSE.EXE</div>
            <div class="w-12"></div> <!-- Spacer for balance -->
        </div>

        <div class="p-6 sm:px-8 sm:py-6">
            <!-- Playful Logo Inside -->
            <div class="flex justify-center mb-4">
                <a href="/" class="inline-flex flex-col items-center gap-2 group cursor-pointer">
                    <div class="w-12 h-12 bg-primary border-2 border-black rounded-xl shadow-[3px_3px_0px_0px_#000] flex items-center justify-center text-white font-black text-xl group-hover:-rotate-12 transition-transform duration-300">P</div>
                </a>
            </div>

            <div class="text-center mb-5">
                <h1 class="text-xl sm:text-2xl font-black text-black mb-1 tracking-tight">Welcome Back</h1>
                <p class="text-slate-500 text-xs sm:text-sm font-bold">Ready to get back to work?</p>
            </div>

            <div class="space-y-2.5 mb-5">
                <button class="btn-social w-full bg-white border-2 border-black text-black font-bold py-2 px-4 rounded-xl shadow-[2px_2px_0px_0px_#000] flex items-center justify-center gap-3 text-sm">
                    <svg class="w-4 h-4" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/><path fill="none" d="M1 1h22v22H1z"/></svg>
                    Continue with Google
                </button>
                <button class="btn-social w-full bg-[#f8fafc] border-2 border-black text-black font-bold py-2 px-4 rounded-xl shadow-[2px_2px_0px_0px_#000] flex items-center justify-center gap-3 text-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                    Continue with GitHub
                </button>
            </div>
            
            <div class="relative flex items-center mb-5">
                <div class="flex-grow border-t-2 border-black/10"></div>
                <span class="flex-shrink-0 mx-3 text-[10px] font-black text-slate-400 uppercase tracking-widest bg-white px-2 py-0.5 rounded-full border-2 border-black/10">Or</span>
                <div class="flex-grow border-t-2 border-black/10"></div>
            </div>

            <form action="{{ route('dashboard') }}" method="GET" class="space-y-3.5">
                <div>
                    <label class="block text-[13px] font-bold text-black mb-1">Email address</label>
                    <input type="email" class="w-full bg-[#f8fafc] border-2 border-black rounded-xl px-3 py-2 text-black font-bold text-sm focus:outline-none focus:bg-white focus:shadow-[3px_3px_0px_0px_#630ed4] transition-all placeholder:text-slate-400" placeholder="sarah@example.com" required>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-[13px] font-bold text-black">Password</label>
                        <a href="#" class="text-[11px] font-bold text-primary hover:underline underline-offset-2">Forget?</a>
                    </div>
                    <input type="password" class="w-full bg-[#f8fafc] border-2 border-black rounded-xl px-3 py-2 text-black font-bold text-sm focus:outline-none focus:bg-white focus:shadow-[3px_3px_0px_0px_#630ed4] transition-all placeholder:text-slate-400" placeholder="••••••••" required>
                </div>
                <div class="pt-2">
                    <button type="submit" class="btn-social w-full bg-primary text-white font-black text-sm py-2.5 rounded-xl border-2 border-black shadow-[3px_3px_0px_0px_#000] flex justify-center items-center gap-1.5">
                        Let's Go!
                        <span class="material-symbols-outlined text-[18px]">rocket_launch</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <p class="text-center text-xs text-slate-500 mt-4 z-20 font-semibold pop-in" style="animation-delay: 0.2s">
        Don't have an account? <a href="#" class="font-bold text-black border-b-[2px] border-black hover:text-primary hover:border-primary transition-colors pb-0.5">Sign up instantly</a>
    </p>

    <script>
        (function () {
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
                    rx += (mx - rx) * 0.14;
                    ry += (my - ry) * 0.14;
                    ring.style.left = rx + 'px';
                    ring.style.top  = ry + 'px';
                    requestAnimationFrame(loop);
                })();
                document.querySelectorAll('a, button, input').forEach(el => {
                    el.addEventListener('mouseenter', () => document.body.classList.add('cursor-on-btn'));
                    el.addEventListener('mouseleave', () => document.body.classList.remove('cursor-on-btn'));
                });
            }
        })();
    </script>
</body>
</html>
