<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PULSE — Design. Build. Sync. Together.</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ═══════════════════════════════
           CUSTOM CURSOR
           ═══════════════════════════════ */
        @media (pointer: fine) {
            * { cursor: none !important; }
            #cursor-dot, #cursor-ring {
                pointer-events: none;
                position: fixed;
                border-radius: 50%;
                z-index: 9999;
                transform: translate(-50%, -50%);
            }
            #cursor-dot {
                width: 7px; height: 7px;
                background: #630ed4;
                transition: width .15s, height .15s, background .15s, transform .08s;
            }
            #cursor-ring {
                width: 32px; height: 32px;
                border: 2px solid rgba(99,14,212,.5);
                transition: width .22s ease, height .22s ease, border-color .2s;
            }
            .cursor-on-btn #cursor-dot  { width: 0; height: 0; }
            .cursor-on-btn #cursor-ring { width: 48px; height: 48px; background: rgba(99,14,212,.06); border-color: rgba(99,14,212,.8); }
        }

        /* ═══════════════════════════════
           KEYFRAMES
           ═══════════════════════════════ */
        @keyframes float-y     { 0%,100%{transform:translateY(0) rotate(var(--r,0deg))} 50%{transform:translateY(-12px) rotate(var(--r,0deg))} }
        @keyframes float-y-sm  { 0%,100%{transform:translateY(0) rotate(var(--r,0deg))} 50%{transform:translateY(-7px)  rotate(var(--r,0deg))} }
        @keyframes float-x     { 0%,100%{transform:translateX(0) rotate(var(--r,0deg))} 50%{transform:translateX(9px)  rotate(var(--r,0deg))} }
        @keyframes wiggle       { 0%,100%{transform:rotate(-3deg)} 50%{transform:rotate(3deg)} }
        @keyframes pulse-ring   { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(1.45)} }
        @keyframes orb-a        { 0%,100%{transform:translate(0,0)  scale(1)}   50%{transform:translate(40px,-30px) scale(1.08)} }
        @keyframes orb-b        { 0%,100%{transform:translate(0,0)  scale(1)}   50%{transform:translate(-30px,20px) scale(.94)} }
        @keyframes morph        { 0%,100%{border-radius:60% 40% 30% 70%/60% 30% 70% 40%} 50%{border-radius:30% 60% 70% 40%/50% 60% 30% 60%} }
        @keyframes shimmer      { 0%{background-position:-200% center} 100%{background-position:200% center} }
        @keyframes word-up      { 0%{opacity:0;transform:translateY(60px) skewX(-6deg)} 100%{opacity:1;transform:none} }
        @keyframes stamp        { 0%{opacity:0;transform:scale(1.7) rotate(-8deg)} 60%{opacity:1;transform:scale(.96) rotate(1.5deg)} 100%{opacity:1;transform:scale(1) rotate(1deg)} }
        @keyframes btn-glow     { 0%,100%{box-shadow:4px 4px 0 0 #000} 50%{box-shadow:4px 4px 0 0 #000, 0 0 22px 4px rgba(99,14,212,.22)} }
        @keyframes pop-in       { 0%{opacity:0;transform:scale(.5) translateY(20px)} 70%{transform:scale(1.06) translateY(-3px)} 100%{opacity:1;transform:none} }
        @keyframes count-in     { 0%{opacity:0;transform:translateY(8px)} 100%{opacity:1;transform:none} }
        @keyframes bar-grow     { 0%{transform:scaleY(0)} 100%{transform:scaleY(1)} }
        @keyframes slide-fade-l { 0%{opacity:0;transform:translateX(-32px)} 100%{opacity:1;transform:none} }
        @keyframes slide-fade-r { 0%{opacity:0;transform:translateX(32px)}  100%{opacity:1;transform:none} }
        @keyframes blink        { 0%,100%{opacity:1} 50%{opacity:0} }

        /* ═══════════════════════════════
           HERO ENTRANCE
           ═══════════════════════════════ */
        .hw { display:inline-block; opacity:0; animation:word-up .55s cubic-bezier(.25,.46,.45,.94) forwards; }
        .hw1 { animation-delay:.0s; }
        .hw2 { animation-delay:.13s; }
        .hw3 { animation-delay:.26s; }
        .hw4 { opacity:0; animation:stamp .62s cubic-bezier(.25,.46,.45,.94) .52s forwards; }

        .h-sub   { opacity:0; animation:word-up .6s ease .82s  forwards; }
        .h-ctas  { opacity:0; animation:word-up .5s ease 1.08s forwards; }
        .h-trust { opacity:0; animation:word-up .5s ease 1.3s  forwards; }
        .h-pill  { opacity:0; animation:pop-in .5s ease .3s    forwards; }

        /* floating badges */
        .bf1 { opacity:0; --r:-6deg; animation: pop-in .5s ease .6s forwards, float-y 4.5s ease-in-out 1.1s infinite; }
        .bf2 { opacity:0;            animation: pop-in .5s ease .75s forwards, float-y-sm 5.5s ease-in-out 1.25s infinite; }
        .bf3 { opacity:0; --r:2deg;  animation: pop-in .5s ease .9s forwards, float-x 3.8s ease-in-out 1.4s infinite; }

        /* ═══════════════════════════════
           SCROLL REVEAL
           ═══════════════════════════════ */
        .reveal {
            opacity:0;
            transform:translateY(28px);
            transition:opacity .65s cubic-bezier(.4,0,.2,1), transform .65s cubic-bezier(.4,0,.2,1);
        }
        .reveal.from-left  { transform:translateX(-40px); }
        .reveal.from-right { transform:translateX(40px); }
        .reveal.from-scale { transform:scale(.9); }
        .reveal.is-visible  { opacity:1; transform:none; }
        .reveal-d1 { transition-delay:.1s; }
        .reveal-d2 { transition-delay:.2s; }
        .reveal-d3 { transition-delay:.3s; }
        .reveal-d4 { transition-delay:.4s; }

        /* ═══════════════════════════════
           CARD INTERACTIONS
           ═══════════════════════════════ */
        .card-lift { transition:transform .15s ease, box-shadow .15s ease; }
        .card-lift:hover  { transform:translate(-3px,-3px); box-shadow:7px 7px 0 0 #000; }
        .card-lift:active { transform:translate(2px,2px);   box-shadow:0   0   0 0 #000; }

        .kb-card { cursor:grab; transition:transform .12s ease, box-shadow .12s ease; }
        .kb-card:hover  { transform:translate(-2px,-2px); }
        .kb-card:active { cursor:grabbing; transform:translate(2px,2px); }

        /* ═══════════════════════════════
           BTN SHIMMER
           ═══════════════════════════════ */
        .btn-shimmer { position:relative; overflow:hidden; }
        .btn-shimmer::after {
            content:'';
            position:absolute; inset:0;
            background:linear-gradient(105deg,transparent 35%,rgba(255,255,255,.3) 50%,transparent 65%);
            transform:translateX(-100%) skewX(-15deg);
        }
        .btn-shimmer:hover::after { transform:translateX(200%) skewX(-15deg); transition:transform .5s ease; }

        /* ═══════════════════════════════
           TEXT SHIMMER
           ═══════════════════════════════ */
        .text-shimmer {
            background:linear-gradient(90deg,#1d1a24 35%,#9333ea 50%,#1d1a24 65%);
            background-size:200% auto;
            -webkit-background-clip:text; background-clip:text;
            -webkit-text-fill-color:transparent;
            animation:shimmer 3s linear infinite;
        }

        /* ═══════════════════════════════
           SECTION BADGE
           ═══════════════════════════════ */
        .s-badge {
            display:inline-flex; align-items:center; gap:5px;
            background:#000; color:#fff;
            font-size:10px; font-weight:800; letter-spacing:.12em; text-transform:uppercase;
            padding:3px 10px; border-radius:999px;
        }

        /* ═══════════════════════════════
           PULSE DOT
           ═══════════════════════════════ */
        .pulse-dot { animation:pulse-ring 2s ease-in-out infinite; }

        /* ═══════════════════════════════
           AVATAR STACK
           ═══════════════════════════════ */
        .av-stack .av { transition:transform .2s ease; }
        .av-stack:hover .av:nth-child(1) { transform:translateX(-7px); }
        .av-stack:hover .av:nth-child(2) { transform:translateX(-2px); }
        .av-stack:hover .av:nth-child(3) { transform:translateX(3px); }

        /* ═══════════════════════════════
           NAV
           ═══════════════════════════════ */
        #main-nav { transition:padding .3s, background .3s, box-shadow .3s; }

        /* ═══════════════════════════════
           MORPH BLOB
           ═══════════════════════════════ */
        .morph-blob { animation:morph 8s ease-in-out infinite; }

        /* ═══════════════════════════════
           CHART BARS
           ═══════════════════════════════ */
        .chart-bar {
            transform-origin: bottom;
            transform: scaleY(0);
            transition: transform .75s cubic-bezier(.25,.46,.45,.94);
        }
        .chart-bar.grown { transform: scaleY(1); }

        /* ═══════════════════════════════
           FOOTER DECO FLOATS
           ═══════════════════════════════ */
        .ft-f1 { animation:float-y 5s ease-in-out infinite; }
        .ft-f2 { animation:float-y-sm 3.5s ease-in-out infinite; animation-delay:-1s; }
        .ft-f3 { animation:wiggle 4s ease-in-out infinite; }
        .ft-f4 { animation:float-x 2.8s ease-in-out infinite; animation-delay:-.5s; }

        html { scroll-behavior:smooth; }
    </style>
</head>
<body class="text-on-background relative min-h-screen overflow-x-hidden" style="font-family:'Space Grotesk',sans-serif;">

{{-- Custom cursor --}}
<div id="cursor-dot"></div>
<div id="cursor-ring"></div>


{{-- ══════════════════════════════════════════════
     NAV
══════════════════════════════════════════════ --}}
<nav id="main-nav" class="fixed top-0 left-1/2 -translate-x-1/2 z-50 flex items-center justify-between px-5 py-2.5 w-[92%] max-w-4xl bg-white/95 backdrop-blur-lg rounded-full border-2 border-black mt-5 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
    <div class="text-xl font-black text-black tracking-tighter select-none">PULSE</div>

    <div class="hidden md:flex items-center gap-1">
        <a href="#platform" class="px-3 py-1.5 text-violet-600 font-bold text-sm border-b-2 border-violet-600">Platform</a>
        <a href="#features"  class="px-3 py-1.5 text-black font-bold text-sm hover:text-violet-600 hover:bg-surface-container rounded-md transition-colors">Framework</a>
        <a href="#features"  class="px-3 py-1.5 text-black font-bold text-sm hover:text-violet-600 hover:bg-surface-container rounded-md transition-colors">Docs</a>
        <a href="#pricing"   class="px-3 py-1.5 text-black font-bold text-sm hover:text-violet-600 hover:bg-surface-container rounded-md transition-colors">Pricing</a>
    </div>

    @if (Route::has('register'))
        <a href="{{ route('register') }}"
           class="btn-shimmer bg-violet-600 text-white text-sm font-bold px-5 py-2 rounded-full border-2 border-black shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] active:translate-x-[3px] active:translate-y-[3px] active:shadow-none transition-all">
            Get Started
        </a>
    @else
        <button class="btn-shimmer bg-violet-600 text-white text-sm font-bold px-5 py-2 rounded-full border-2 border-black shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] active:translate-x-[3px] active:translate-y-[3px] active:shadow-none transition-all">
            Get Started
        </button>
    @endif
</nav>


{{-- ══════════════════════════════════════════════
     HERO
══════════════════════════════════════════════ --}}
<section id="platform" class="relative pt-44 pb-20 px-6 flex flex-col items-center text-center overflow-hidden">

    {{-- Background gradient orbs --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
        <div style="animation:orb-a 14s ease-in-out infinite"
             class="absolute top-16 left-1/4 w-80 h-80 bg-primary/8 rounded-full blur-3xl"></div>
        <div style="animation:orb-b 18s ease-in-out infinite; animation-delay:-6s"
             class="absolute top-28 right-1/4 w-96 h-96 bg-secondary-container/25 rounded-full blur-3xl"></div>
        <div class="absolute bottom-8 left-1/3 w-56 h-56 bg-tertiary/7 rounded-full blur-2xl"></div>
    </div>

    {{-- Floating sticky note --}}
    <div class="bf1 absolute top-28 left-6 xl:left-28 bg-secondary-container p-3.5 neobrutalism-border neobrutalism-shadow w-[158px] z-10 hidden lg:block card-lift" style="--r:-6deg;">
        <p class="text-xs font-bold">Note to self:</p>
        <p class="text-sm mt-0.5">Make it pop. 💥</p>
    </div>

    {{-- Sarah badge --}}
    <div class="bf2 absolute top-36 right-6 xl:right-28 bg-white p-2.5 rounded-xl neobrutalism-border neobrutalism-shadow z-10 hidden lg:flex items-center gap-2.5 card-lift">
        <div class="relative shrink-0">
            {{-- Default avatar — no photo --}}
            <div class="w-9 h-9 rounded-full border-2 border-black bg-violet-500 flex items-center justify-center text-white text-xs font-black select-none">SC</div>
            <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-400 rounded-full border-2 border-white pulse-dot"></span>
        </div>
        <div class="text-left">
            <p class="text-xs font-bold leading-tight">Sarah Chen</p>
            <p class="text-[10px] text-on-surface-variant">is editing right now…</p>
        </div>
    </div>

    {{-- Alex cursor badge --}}
    <div class="bf3 absolute bottom-24 left-10 xl:left-32 bg-white p-2 rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000] z-10 hidden md:flex items-center gap-1.5 rotate-2 card-lift" style="--r:2deg;">
        <span class="material-symbols-outlined text-primary" style="font-size:16px;">mouse</span>
        <span class="bg-primary text-white text-[10px] font-black px-2 py-0.5 rounded-full">Alex's cursor</span>
    </div>

    {{-- Social proof pill --}}
    <div class="h-pill inline-flex items-center gap-2 bg-white border-2 border-black px-3 py-1.5 rounded-full text-xs font-bold mb-8 shadow-[2px_2px_0px_0px_#000] z-20">
        <span class="w-2 h-2 bg-green-400 rounded-full pulse-dot"></span>
        2,400+ teams building together right now
    </div>

    {{-- Headline --}}
    <h1 class="font-black text-on-background max-w-5xl z-20 relative"
        style="font-size:clamp(2.8rem,8.5vw,6.2rem); line-height:1.0; letter-spacing:-0.045em;">
        <span class="hw hw1 hover:-translate-y-2 transition-transform duration-200 cursor-default">DESIGN.</span>
        <span class="hw hw2 text-primary ml-2 hover:-translate-y-2 transition-transform duration-200 cursor-default">BUILD.</span>
        <span class="hw hw3 ml-2 hover:-translate-y-2 transition-transform duration-200 cursor-default"
              style="color:#fed01b;-webkit-text-stroke:2.5px black;">SYNC.</span>
        <br>
        <span class="hw hw4 inline-block mt-3 bg-black text-white px-8 py-3 rounded-2xl rotate-1 neobrutalism-shadow-lg">TOGETHER.</span>
    </h1>

    {{-- Sub --}}
    <p class="h-sub text-lg text-on-surface-variant max-w-xl mt-8 mb-10 z-20 leading-relaxed">
        The workspace for creative professionals who need a blank canvas and a powerful engine.
        <strong class="text-on-background">Stop switching context.</strong> Start building momentum.
    </p>

    {{-- CTAs --}}
    <div class="h-ctas flex gap-3 z-20 flex-wrap justify-center mb-14">
        <button class="btn-shimmer bg-primary text-white font-bold text-lg px-9 py-4 rounded-xl neobrutalism-border neobrutalism-shadow hover:shadow-[8px_8px_0px_0px_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all flex items-center gap-2"
                style="animation:btn-glow 2.8s ease-in-out 1.6s infinite;">
            Start Playing
            <span class="material-symbols-outlined" style="font-size:20px;">arrow_forward</span>
        </button>
        <button class="btn-shimmer bg-white text-black font-bold text-lg px-9 py-4 rounded-xl neobrutalism-border neobrutalism-shadow hover:bg-surface-container hover:shadow-[8px_8px_0px_0px_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all flex items-center gap-2">
            <span class="material-symbols-outlined" style="font-size:20px;">play_circle</span>
            View Demo
        </button>
    </div>

    {{-- Trust row --}}
    <div class="h-trust flex flex-wrap justify-center gap-8 z-20 text-sm">
        <div class="flex items-center gap-2">
            <div class="av-stack flex -space-x-2">
                <div class="av w-7 h-7 rounded-full border-2 border-white shadow bg-orange-400   flex items-center justify-center text-white font-black text-[9px]">JM</div>
                <div class="av w-7 h-7 rounded-full border-2 border-white shadow bg-blue-500     flex items-center justify-center text-white font-black text-[9px]">AR</div>
                <div class="av w-7 h-7 rounded-full border-2 border-white shadow bg-emerald-500  flex items-center justify-center text-white font-black text-[9px]">TK</div>
            </div>
            <span class="text-on-surface-variant font-medium">Loved by <strong class="text-on-background">2,400+ teams</strong></span>
        </div>
        <div class="flex items-center gap-1.5">
            <span class="text-secondary-container text-lg leading-none">★★★★★</span>
            <span class="text-on-surface-variant font-medium"><strong class="text-on-background">4.9</strong> avg rating</span>
        </div>
        <div class="flex items-center gap-1.5">
            <span class="material-symbols-outlined text-tertiary" style="font-size:18px;">verified</span>
            <span class="text-on-surface-variant font-medium">SOC 2 <strong class="text-on-background">compliant</strong></span>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════
     KANBAN SECTION
══════════════════════════════════════════════ --}}
<section class="pt-24 pb-16 px-6 md:px-12 lg:px-16 relative z-20">
    <div class="max-w-7xl mx-auto">

        <div class="mb-10 reveal">
            <span class="s-badge mb-4 inline-flex">
                <span class="material-symbols-outlined" style="font-size:11px;">live_tv</span>
                Live Preview
            </span>
            <h2 class="font-black text-on-background mt-3"
                style="font-size:clamp(1.8rem,4vw,2.8rem); line-height:1.15; letter-spacing:-0.03em;">
                Your team, in<br><span class="text-primary">perfect sync.</span>
            </h2>
            <p class="text-on-surface-variant mt-2 max-w-sm text-base">
                One board. Every task, owner, and status — always up to date.
            </p>
        </div>

        <div class="bg-surface-container rounded-2xl neobrutalism-border neobrutalism-shadow-lg relative reveal reveal-d1">
            <div class="active-handle handle-tl"></div>
            <div class="active-handle handle-tr"></div>
            <div class="active-handle handle-bl"></div>
            <div class="active-handle handle-br"></div>

            {{-- Board toolbar --}}
            <div class="flex items-center justify-between px-6 pt-5 pb-4 border-b-2 border-black flex-wrap gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-black rounded-lg flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-white" style="font-size:18px;">view_kanban</span>
                    </div>
                    <div>
                        <p class="font-bold text-base leading-tight">Project Pulse</p>
                        <p class="text-[11px] text-on-surface-variant">Sprint 12 · Active</p>
                    </div>
                </div>
                <div class="flex items-center gap-2.5 flex-wrap">
                    <div class="av-stack flex -space-x-2.5">
                        <div class="av w-8 h-8 rounded-full border-2 border-white bg-orange-400   flex items-center justify-center text-white font-black text-[10px]">JM</div>
                        <div class="av w-8 h-8 rounded-full border-2 border-white bg-blue-500     flex items-center justify-center text-white font-black text-[10px]">AR</div>
                        <div class="av w-8 h-8 rounded-full border-2 border-white bg-secondary-container flex items-center justify-center text-[10px] font-black" style="color:#574500;">+3</div>
                    </div>
                    <button class="flex items-center gap-1.5 bg-white text-xs font-bold px-3 py-1.5 rounded-full border-2 border-black shadow-[2px_2px_0px_0px_#000] hover:shadow-[4px_4px_0px_0px_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-[2px] active:translate-y-[2px] active:shadow-none transition-all">
                        <span class="material-symbols-outlined" style="font-size:14px;">filter_list</span> Filter
                    </button>
                    <button class="flex items-center gap-1.5 bg-primary text-white text-xs font-bold px-3 py-1.5 rounded-full border-2 border-black shadow-[2px_2px_0px_0px_#000] hover:shadow-[4px_4px_0px_0px_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all">
                        <span class="material-symbols-outlined" style="font-size:14px;">add</span> Add Task
                    </button>
                </div>
            </div>

            {{-- KANBAN COLUMNS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 divide-y-2 md:divide-y-0 md:divide-x-2 divide-black">

                {{-- BACKLOG --}}
                <div class="p-5 flex flex-col gap-3">
                    <div class="flex items-center justify-between mb-1">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-gray-400 shrink-0"></span>
                            <span class="font-bold text-sm">Backlog</span>
                        </div>
                        <span class="bg-gray-100 border border-black text-xs font-bold px-2 py-0.5 rounded-md">3</span>
                    </div>

                    <div class="kb-card bg-white rounded-lg border-2 border-black p-3.5 shadow-[2px_2px_0px_0px_#000] hover:shadow-[4px_4px_0px_0px_#000]">
                        <div class="flex gap-1.5 mb-2">
                            <span class="bg-tertiary-fixed text-on-tertiary-fixed px-2 py-0.5 rounded text-[10px] font-bold border border-black">Design</span>
                        </div>
                        <p class="font-bold text-sm mb-3">Redesign Landing Page Hero</p>
                        <div class="flex justify-between items-center">
                            <div class="w-5 h-5 rounded-full border border-black bg-rose-400 flex items-center justify-center text-white font-black text-[8px]">S</div>
                            <span class="material-symbols-outlined text-outline" style="font-size:16px;">chat_bubble_outline</span>
                        </div>
                    </div>

                    <div class="kb-card bg-white rounded-lg border-2 border-black p-3.5 shadow-[2px_2px_0px_0px_#000] hover:shadow-[4px_4px_0px_0px_#000]">
                        <div class="flex gap-1.5 mb-2">
                            <span class="bg-primary-fixed text-on-primary-fixed px-2 py-0.5 rounded text-[10px] font-bold border border-black">Research</span>
                        </div>
                        <p class="font-bold text-sm mb-3">User Interview Synthesis</p>
                        <div class="flex justify-between items-center">
                            <div class="w-5 h-5 rounded-full border border-black bg-blue-500 flex items-center justify-center text-white font-black text-[8px]">A</div>
                            <span class="text-[10px] font-bold text-outline">Due Fri</span>
                        </div>
                    </div>

                    <div class="kb-card bg-white rounded-lg border-2 border-black p-3.5 shadow-[2px_2px_0px_0px_#000] opacity-55">
                        <div class="flex gap-1.5 mb-2">
                            <span class="bg-secondary-fixed px-2 py-0.5 rounded text-[10px] font-bold border border-black" style="color:#574500;">Marketing</span>
                        </div>
                        <p class="font-bold text-sm">Q4 Campaign Brief</p>
                    </div>

                    <button class="w-full border-2 border-dashed border-outline-variant rounded-lg py-2.5 text-xs font-bold text-on-surface-variant hover:border-primary hover:text-primary hover:bg-surface-container-low transition-colors flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined" style="font-size:14px;">add</span> Add card
                    </button>
                </div>

                {{-- IN PROGRESS --}}
                <div class="p-5 flex flex-col gap-3 bg-surface-container-low">
                    <div class="flex items-center justify-between mb-1">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-secondary-container shrink-0 pulse-dot"></span>
                            <span class="font-bold text-sm">In Progress</span>
                        </div>
                        <span class="bg-secondary-container border border-black text-[10px] font-black px-2 py-0.5 rounded-md" style="color:#231b00;">2</span>
                    </div>

                    <div class="kb-card bg-white rounded-lg border-2 border-primary p-3.5 shadow-[2px_2px_0px_0px_#630ed4] hover:shadow-[4px_4px_0px_0px_#630ed4] relative">
                        <div class="absolute -top-2.5 -right-2.5 w-6 h-6 bg-secondary-container rounded-full border-2 border-black flex items-center justify-center shadow-[1px_1px_0px_0px_#000]">
                            <span class="material-symbols-outlined" style="font-size:12px;">bolt</span>
                        </div>
                        <div class="flex gap-1.5 mb-2">
                            <span class="bg-primary-fixed text-on-primary-fixed px-2 py-0.5 rounded text-[10px] font-bold border border-black">Engineering</span>
                        </div>
                        <p class="font-bold text-sm mb-2.5">Implement Canvas Active Handles</p>
                        <div class="w-full bg-surface-dim h-1.5 rounded-full mb-1 border border-outline-variant overflow-hidden">
                            <div class="bg-primary h-full rounded-full" style="width:60%;"></div>
                        </div>
                        <p class="text-[10px] text-on-surface-variant mb-3">60% complete</p>
                        <div class="flex justify-between items-center">
                            <div class="w-5 h-5 rounded-full border border-black bg-emerald-500 flex items-center justify-center text-white font-black text-[8px]">K</div>
                            <span class="bg-surface-container px-1.5 py-0.5 rounded text-[10px] border border-black">👍 2</span>
                        </div>
                    </div>

                    <div class="kb-card bg-white rounded-lg border-2 border-primary p-3.5 shadow-[2px_2px_0px_0px_#630ed4] hover:shadow-[4px_4px_0px_0px_#630ed4]">
                        <div class="flex gap-1.5 mb-2">
                            <span class="bg-tertiary-fixed text-on-tertiary-fixed px-2 py-0.5 rounded text-[10px] font-bold border border-black">Design</span>
                        </div>
                        <p class="font-bold text-sm mb-2.5">Component Library v2</p>
                        <div class="w-full bg-surface-dim h-1.5 rounded-full mb-1 border border-outline-variant overflow-hidden">
                            <div class="bg-primary h-full rounded-full" style="width:35%;"></div>
                        </div>
                        <p class="text-[10px] text-on-surface-variant mb-3">35% complete</p>
                        <div class="flex justify-between items-center">
                            <div class="w-5 h-5 rounded-full border border-black bg-rose-400 flex items-center justify-center text-white font-black text-[8px]">S</div>
                            <span class="text-[10px] font-bold text-outline">Due Today</span>
                        </div>
                    </div>

                    <button class="w-full border-2 border-dashed border-primary/40 rounded-lg py-2.5 text-xs font-bold text-primary/60 hover:border-primary hover:text-primary transition-colors flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined" style="font-size:14px;">add</span> Add card
                    </button>
                </div>

                {{-- DONE --}}
                <div class="p-5 flex flex-col gap-3">
                    <div class="flex items-center justify-between mb-1">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-tertiary-fixed-dim shrink-0"></span>
                            <span class="font-bold text-sm">Done</span>
                        </div>
                        <span class="bg-tertiary-fixed border border-black text-[10px] font-black px-2 py-0.5 rounded-md" style="color:#002113;">3</span>
                    </div>

                    <div class="kb-card bg-surface-container-high rounded-lg border-2 border-black p-3.5 opacity-75">
                        <p class="font-bold text-sm mb-2 line-through text-outline">Setup CI/CD Pipeline</p>
                        <div class="flex justify-between items-center">
                            <span class="material-symbols-outlined text-tertiary" style="font-size:16px;">check_circle</span>
                            <span class="text-[10px] font-bold text-outline">Yesterday</span>
                        </div>
                    </div>

                    <div class="kb-card bg-surface-container-high rounded-lg border-2 border-black p-3.5 opacity-60">
                        <p class="font-bold text-sm mb-2 line-through text-outline">Write API Docs</p>
                        <div class="flex justify-between items-center">
                            <span class="material-symbols-outlined text-tertiary" style="font-size:16px;">check_circle</span>
                            <span class="text-[10px] font-bold text-outline">Mon</span>
                        </div>
                    </div>

                    <div class="kb-card bg-surface-container-high rounded-lg border-2 border-black p-3.5 opacity-45">
                        <p class="font-bold text-sm mb-2 line-through text-outline">QA Sprint 11</p>
                        <div class="flex justify-between items-center">
                            <span class="material-symbols-outlined text-tertiary" style="font-size:16px;">check_circle</span>
                            <span class="text-[10px] font-bold text-outline">Last week</span>
                        </div>
                    </div>
                </div>

            </div>{{-- end grid --}}
        </div>{{-- end board --}}
    </div>
</section>


{{-- ══════════════════════════════════════════════
     FEATURES TRIO
══════════════════════════════════════════════ --}}
<section id="features" class="pt-20 pb-16 px-6 md:px-12 lg:px-16 relative z-20">
    <div class="max-w-7xl mx-auto">

        <div class="mb-10 reveal">
            <span class="s-badge inline-flex mb-4">
                <span class="material-symbols-outlined" style="font-size:11px;">star</span>
                Features
            </span>
            <h2 class="font-black text-on-background mt-3"
                style="font-size:clamp(1.8rem,4vw,2.8rem); line-height:1.15; letter-spacing:-0.03em;">
                Built for how teams<br><span class="text-primary">actually work.</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white rounded-xl neobrutalism-border neobrutalism-shadow p-6 flex flex-col card-lift reveal group">
                <div class="w-12 h-12 bg-primary rounded-xl neobrutalism-border flex items-center justify-center mb-5 shrink-0 group-hover:rotate-12 transition-transform duration-300">
                    <span class="material-symbols-outlined text-white" style="font-size:22px;">bolt</span>
                </div>
                <h3 class="font-bold text-xl mb-2" style="letter-spacing:-0.02em;">Real-time Everything</h3>
                <p class="text-on-surface-variant text-sm leading-relaxed flex-1">
                    See cursors, edits, and status changes as they happen. No refresh. No lag. Ever.
                </p>
                <div class="mt-5 pt-4 border-t-2 border-black">
                    <span class="text-xs font-bold text-primary group-hover:underline underline-offset-2">Explore feature →</span>
                </div>
            </div>

            <div class="bg-secondary-container rounded-xl neobrutalism-border neobrutalism-shadow p-6 flex flex-col card-lift reveal reveal-d1 group">
                <div class="w-12 h-12 bg-black rounded-xl neobrutalism-border flex items-center justify-center mb-5 shrink-0 group-hover:rotate-12 transition-transform duration-300">
                    <span class="material-symbols-outlined text-secondary-container" style="font-size:22px;">view_kanban</span>
                </div>
                <h3 class="font-bold text-xl mb-2" style="letter-spacing:-0.02em;">Smart Kanban Boards</h3>
                <p class="text-sm leading-relaxed flex-1" style="color:#6f5900;">
                    Drag. Drop. Done. Boards that adapt to your workflow, not the other way around.
                </p>
                <div class="mt-5 pt-4 border-t-2 border-black">
                    <span class="text-xs font-bold group-hover:underline underline-offset-2" style="color:#574500;">Explore feature →</span>
                </div>
            </div>

            <div class="bg-surface-container rounded-xl neobrutalism-border neobrutalism-shadow p-6 flex flex-col card-lift reveal reveal-d2 group">
                <div class="w-12 h-12 bg-tertiary rounded-xl neobrutalism-border flex items-center justify-center mb-5 shrink-0 group-hover:rotate-12 transition-transform duration-300">
                    <span class="material-symbols-outlined text-white" style="font-size:22px;">trending_up</span>
                </div>
                <h3 class="font-bold text-xl mb-2" style="letter-spacing:-0.02em;">Velocity Analytics</h3>
                <p class="text-on-surface-variant text-sm leading-relaxed flex-1">
                    Track sprint velocity, surface blockers, and ship 3× faster with real insights.
                </p>
                <div class="mt-5 pt-4 border-t-2 border-black">
                    <span class="text-xs font-bold text-primary group-hover:underline underline-offset-2">Explore feature →</span>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════
     BENTO GRID
══════════════════════════════════════════════ --}}
<section class="pt-8 pb-16 px-6 md:px-12 lg:px-16 relative z-20">
    <div class="max-w-7xl mx-auto">

        <div class="mb-10 reveal">
            <span class="s-badge inline-flex mb-4">
                <span class="material-symbols-outlined" style="font-size:11px;">grid_view</span>
                What's inside
            </span>
            <h2 class="font-black text-on-background mt-3"
                style="font-size:clamp(1.8rem,4vw,2.8rem); line-height:1.15; letter-spacing:-0.03em;">
                More than just<br><span class="text-primary">sticky notes.</span>
            </h2>
        </div>

        {{-- Row 1 --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

            {{-- Velocity chart (2 cols) --}}
            <div id="velocity-card"
                 class="md:col-span-2 bg-white rounded-xl neobrutalism-border neobrutalism-shadow p-6 flex flex-col justify-between relative overflow-hidden group min-h-[260px] card-lift reveal">
                <div class="absolute top-0 right-0 w-44 h-44 bg-primary-fixed rounded-bl-[50%] -z-10 transition-transform duration-500 group-hover:scale-150"></div>
                <div>
                    <h3 class="font-bold text-xl flex items-center gap-2 mb-1" style="letter-spacing:-0.02em;">
                        Velocity <span class="material-symbols-outlined text-primary">trending_up</span>
                    </h3>
                    <p class="text-sm text-outline">Shipping faster than ever. <strong>+24% this sprint.</strong></p>
                </div>
                {{-- Animated chart bars --}}
                <div class="flex items-end gap-3 mt-6" style="height:112px;">
                    @php
                        $chartBars = [
                            ['pct'=>40,  'label'=>'S8',  'active'=>false],
                            ['pct'=>55,  'label'=>'S9',  'active'=>false],
                            ['pct'=>45,  'label'=>'S10', 'active'=>false],
                            ['pct'=>75,  'label'=>'S11', 'active'=>false],
                            ['pct'=>100, 'label'=>'S12', 'active'=>true],
                        ];
                    @endphp
                    @foreach($chartBars as $i => $b)
                    <div class="flex flex-col items-center flex-1 h-full justify-end gap-1 relative">
                        @if($b['active'])
                        <div class="absolute -top-9 left-1/2 -translate-x-1/2 bg-black text-white px-2 py-0.5 rounded border-2 border-black text-[10px] font-black whitespace-nowrap">+24%</div>
                        @endif
                        <div class="chart-bar w-full rounded-t hover:brightness-90 cursor-pointer {{ $b['active'] ? 'bg-primary border-2 border-black' : 'bg-surface-container border-2 border-black hover:bg-primary transition-colors duration-200' }}"
                             style="height:{{ $b['pct'] }}%; transition-delay:{{ $i * 0.08 }}s;"></div>
                        <span class="text-[9px] font-bold {{ $b['active'] ? 'text-primary font-black' : 'text-outline' }}">{{ $b['label'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Quick Hits --}}
            <div class="bg-secondary-container rounded-xl neobrutalism-border neobrutalism-shadow p-6 flex flex-col min-h-[260px] card-lift reveal reveal-d1">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="font-bold text-xl" style="letter-spacing:-0.02em;">Quick Hits</h3>
                    <span class="bg-black text-white text-[10px] font-black px-2 py-0.5 rounded-full">2 left</span>
                </div>
                <ul class="space-y-3 flex-1">
                    <li class="flex items-center gap-3 bg-white p-3 rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000] hover:shadow-[3px_3px_0px_0px_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 accent-violet-600 cursor-pointer shrink-0">
                        <span class="font-bold text-xs">Review PR #402</span>
                        <span class="ml-auto shrink-0 text-[9px] font-black px-1.5 py-0.5 rounded bg-red-100 text-red-600 border border-red-200">High</span>
                    </li>
                    <li class="flex items-center gap-3 bg-white p-3 rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000] hover:shadow-[3px_3px_0px_0px_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 accent-violet-600 cursor-pointer shrink-0">
                        <span class="font-bold text-xs">Sync with Design</span>
                        <span class="ml-auto shrink-0 text-[9px] font-black px-1.5 py-0.5 rounded bg-yellow-100 text-yellow-700 border border-yellow-200">Med</span>
                    </li>
                    <li class="flex items-center gap-3 bg-white/60 p-3 rounded-lg border-2 border-black/30 opacity-50 cursor-pointer line-through">
                        <input type="checkbox" checked class="w-4 h-4 accent-violet-600 cursor-pointer shrink-0">
                        <span class="font-bold text-xs">Merge feature branch</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Row 2 --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Launch Day --}}
            <div class="bg-surface-container-highest rounded-xl neobrutalism-border neobrutalism-shadow p-6 flex items-center justify-center relative overflow-hidden min-h-[220px] card-lift reveal">
                <div class="absolute top-4 right-4 opacity-10">
                    <span class="material-symbols-outlined" style="font-size:88px;">calendar_month</span>
                </div>
                <div class="relative z-10 text-center bg-white p-5 rounded-xl neobrutalism-border shadow-[4px_4px_0px_0px_#000] rotate-2 hover:-rotate-0 transition-transform duration-200">
                    <p class="text-primary uppercase tracking-widest text-[9px] font-black mb-1">Upcoming</p>
                    <h4 class="font-black text-2xl leading-tight" style="letter-spacing:-0.03em;">Launch Day</h4>
                    <div class="flex items-center justify-center gap-1 mt-1.5">
                        <span class="material-symbols-outlined text-outline" style="font-size:12px;">schedule</span>
                        <p class="text-xs text-outline font-medium">Oct 24th · 10:00 AM</p>
                    </div>
                </div>
                <svg class="absolute -top-3 -right-6 w-16 h-16 text-black hidden lg:block" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </div>

            {{-- Teams (2 cols) --}}
            <div class="md:col-span-2 bg-inverse-surface rounded-xl neobrutalism-border neobrutalism-shadow p-6 flex flex-col justify-between relative overflow-hidden min-h-[220px] card-lift reveal reveal-d1">
                <div class="absolute -right-10 -top-10 w-48 h-48 bg-white/5 rounded-full pointer-events-none"></div>
                <div class="absolute -left-6 -bottom-10 w-32 h-32 bg-primary/20 rounded-full pointer-events-none morph-blob"></div>
                <div class="relative z-10">
                    <h3 class="font-bold text-2xl text-white mb-1" style="letter-spacing:-0.02em;">Built for High-Performing Teams</h3>
                    <p class="text-white/60 text-sm">From scrappy startups to enterprise scale.</p>
                </div>
                <div class="flex items-center justify-between relative z-10">
                    <div class="av-stack flex -space-x-3">
                        <div class="av w-11 h-11 rounded-full border-2 border-white bg-orange-400   flex items-center justify-center text-white font-black text-sm">JM</div>
                        <div class="av w-11 h-11 rounded-full border-2 border-white bg-blue-500     flex items-center justify-center text-white font-black text-sm">AR</div>
                        <div class="av w-11 h-11 rounded-full border-2 border-white bg-emerald-500  flex items-center justify-center text-white font-black text-sm">TK</div>
                        <div class="av w-11 h-11 rounded-full border-2 border-white bg-primary       flex items-center justify-center text-white font-black text-xs">+12</div>
                    </div>
                    <a href="#" class="btn-shimmer flex items-center gap-1.5 bg-white text-black font-bold text-xs px-5 py-2.5 rounded-full border-2 border-white hover:bg-secondary-container transition-colors">
                        Join the team <span class="material-symbols-outlined" style="font-size:14px;">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════
     STATS BAND
══════════════════════════════════════════════ --}}
<section id="stats-section" class="w-full bg-inverse-surface border-y-2 border-black py-16 px-6 md:px-12 lg:px-16 reveal">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-0 md:divide-x md:divide-white/10">
        <div class="text-left md:pr-10">
            <p class="font-black text-white" style="font-size:clamp(2.5rem,5.5vw,4rem); line-height:1; letter-spacing:-0.04em;">
                <span class="stat-num" data-target="2400" data-suffix=",">0</span><span class="text-secondary-container">+</span>
            </p>
            <p class="text-white/60 text-sm font-medium mt-1">Teams onboarded worldwide</p>
        </div>
        <div class="text-left md:text-center md:px-10">
            <p class="font-black text-white" style="font-size:clamp(2.5rem,5.5vw,4rem); line-height:1; letter-spacing:-0.04em;">
                <span class="stat-num" data-target="3">0</span><span class="text-secondary-container">×</span>
            </p>
            <p class="text-white/60 text-sm font-medium mt-1">Faster shipping, on average</p>
        </div>
        <div class="text-left md:text-right md:pl-10">
            <p class="font-black text-white" style="font-size:clamp(2.5rem,5.5vw,4rem); line-height:1; letter-spacing:-0.04em;">
                <span class="stat-num" data-target="4.9" data-decimal="1">0</span><span class="text-secondary-container">★</span>
            </p>
            <p class="text-white/60 text-sm font-medium mt-1">Average product rating</p>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════
     FOOTER
══════════════════════════════════════════════ --}}
<footer class="w-full flex flex-col items-center justify-center pt-24 pb-12 px-8 overflow-hidden bg-violet-600 border-t-4 border-black relative">
    {{-- Decorative floating elements --}}
    <div class="ft-f1 absolute bottom-10 left-8  w-16 h-16 bg-secondary-container rounded-full neobrutalism-border opacity-60 pointer-events-none"></div>
    <div class="ft-f2 absolute top-20 right-1/4 w-3  h-3  bg-secondary-container rounded-full opacity-50 pointer-events-none"></div>
    <div class="ft-f3 absolute top-1/2  left-12  w-8  h-8  border-4 border-secondary-container opacity-30 pointer-events-none rotate-45"></div>
    <div class="ft-f4 absolute bottom-1/3 right-8 w-5  h-5  bg-white/20 rounded-full pointer-events-none"></div>
    <div class="absolute top-10 right-16 w-28 h-8 bg-white neobrutalism-border opacity-20 rotate-45 pointer-events-none"></div>

    <h2 class="font-black uppercase italic leading-none text-yellow-400 tracking-tighter select-none hover:-rotate-1 transition-transform z-10 text-center w-full"
        style="font-size:clamp(3rem,11vw,11rem);">
        READY TO PLAY?
    </h2>

    <div class="mt-10 z-10">
        <button class="btn-shimmer bg-black text-white font-black text-base px-10 py-4 rounded-full border-2 border-black shadow-[4px_4px_0px_0px_rgba(254,208,27,1)] hover:shadow-[7px_7px_0px_0px_rgba(254,208,27,1)] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all">
            Start for Free — No credit card needed
        </button>
    </div>

    <div class="flex flex-wrap gap-8 mt-12 z-10 justify-center">
        <a href="#" class="font-bold uppercase text-sm text-white underline decoration-2 underline-offset-4 hover:text-yellow-400 transition-colors">Twitter</a>
        <a href="#" class="font-bold uppercase text-sm text-white/80 hover:text-yellow-400 transition-colors">GitHub</a>
        <a href="#" class="font-bold uppercase text-sm text-white/80 hover:text-yellow-400 transition-colors">Discord</a>
        <a href="#" class="font-bold uppercase text-sm text-white/80 hover:text-yellow-400 transition-colors">Terms</a>
    </div>

    <p class="text-xs text-white/40 mt-8 z-10 tracking-widest uppercase">©2024 Pulse Systems. All rights reserved.</p>
</footer>


{{-- ══════════════════════════════════════════════
     JAVASCRIPT
══════════════════════════════════════════════ --}}
<script>
(function () {
    /* ── Custom cursor ── */
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
        document.querySelectorAll('a, button').forEach(el => {
            el.addEventListener('mouseenter', () => document.body.classList.add('cursor-on-btn'));
            el.addEventListener('mouseleave', () => document.body.classList.remove('cursor-on-btn'));
        });
    }

    /* ── Scroll reveal ── */
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('is-visible'); io.unobserve(e.target); } });
    }, { threshold: 0.08, rootMargin: '0px 0px -32px 0px' });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));

    /* ── Kanban card press feedback ── */
    document.querySelectorAll('.kb-card').forEach(card => {
        card.addEventListener('pointerdown',  function () { this.style.transform = 'translate(2px,2px)'; });
        card.addEventListener('pointerup',    function () { this.style.transform = ''; });
        card.addEventListener('pointerleave', function () { this.style.transform = ''; });
    });

    /* ── Chart bar grow animation ── */
    const vcCard = document.getElementById('velocity-card');
    if (vcCard) {
        const barObs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.querySelectorAll('.chart-bar').forEach((b, i) => {
                        setTimeout(() => b.classList.add('grown'), i * 85);
                    });
                    barObs.unobserve(e.target);
                }
            });
        }, { threshold: 0.35 });
        barObs.observe(vcCard);
    }

    /* ── Count-up ── */
    const statSection = document.getElementById('stats-section');
    if (statSection) {
        const countObs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (!e.isIntersecting) return;
                e.target.querySelectorAll('.stat-num').forEach(el => {
                    const target  = parseFloat(el.dataset.target);
                    const decimal = parseInt(el.dataset.decimal || '0');
                    const dur = 1800, t0 = performance.now();
                    (function tick(now) {
                        const p = Math.min((now - t0) / dur, 1);
                        const ease = 1 - Math.pow(1 - p, 3);
                        const v = target * ease;
                        el.textContent = decimal ? v.toFixed(decimal) : Math.floor(v).toLocaleString();
                        if (p < 1) requestAnimationFrame(tick);
                    })(t0);
                });
                countObs.unobserve(e.target);
            });
        }, { threshold: 0.5 });
        countObs.observe(statSection);
    }

    /* ── Nav shrink on scroll ── */
    const nav = document.getElementById('main-nav');
    if (nav) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 60) {
                nav.style.padding = '6px 16px';
                nav.style.background = 'rgba(255,255,255,0.98)';
            } else {
                nav.style.padding = '';
                nav.style.background = '';
            }
        }, { passive: true });
    }

    /* ── Subtle magnetic effect on CTA buttons only ── */
    document.querySelectorAll('button, a').forEach(el => {
        el.addEventListener('mousemove', function (e) {
            const r = this.getBoundingClientRect();
            const cx = r.left + r.width / 2, cy = r.top + r.height / 2;
            const dx = (e.clientX - cx) * 0.1, dy = (e.clientY - cy) * 0.1;
            /* only apply to elements that don't already have card-lift transform logic */
            if (!this.closest('.card-lift') && !this.closest('.kb-card')) {
                this.style.transform = `translate(${dx}px,${dy}px)`;
            }
        });
        el.addEventListener('mouseleave', function () {
            if (!this.closest('.card-lift') && !this.closest('.kb-card')) {
                this.style.transform = '';
            }
        });
    });

    /* ── Checkbox tick animation ── */
    document.querySelectorAll('ul input[type=checkbox]').forEach(cb => {
        cb.addEventListener('change', function () {
            const li = this.closest('li');
            if (!li) return;
            li.style.transition = 'opacity .25s, transform .25s';
            if (this.checked) {
                li.classList.add('opacity-50', 'line-through');
                li.style.transform = 'scale(.97)';
                setTimeout(() => { li.style.transform = ''; }, 250);
            } else {
                li.classList.remove('opacity-50', 'line-through');
            }
        });
    });

    /* ── Staggered card entrance for kanban cards ── */
    document.querySelectorAll('.kb-card').forEach((card, i) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(16px)';
        card.style.transition = `opacity .4s ease ${i * 0.06}s, transform .4s ease ${i * 0.06}s, box-shadow .12s ease`;
    });
    const kbObs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.querySelectorAll('.kb-card').forEach(card => {
                    card.style.opacity = '1';
                    card.style.transform = '';
                });
                kbObs.unobserve(e.target);
            }
        });
    }, { threshold: 0.15 });
    document.querySelectorAll('.grid').forEach(g => { if (g.querySelector('.kb-card')) kbObs.observe(g); });

})();
</script>

</body>
</html>
