<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PULSE — Design. Build. Sync. Together.</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ── Ticker infinite scroll ── */
        @keyframes ticker-scroll {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }
        .ticker-track {
            display: flex;
            width: max-content;
            animation: ticker-scroll 28s linear infinite;
        }
        .ticker-track:hover { animation-play-state: paused; }

        /* ── Scroll-reveal ── */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.55s ease, transform 0.55s ease;
        }
        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-d1 { transition-delay: 0.1s; }
        .reveal-d2 { transition-delay: 0.2s; }
        .reveal-d3 { transition-delay: 0.3s; }

        /* ── Card interactive lift ── */
        .card-lift {
            transition: transform 0.12s ease, box-shadow 0.12s ease;
        }
        .card-lift:hover {
            transform: translate(-3px, -3px);
            box-shadow: 7px 7px 0px 0px #000;
        }
        .card-lift:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #000;
        }

        /* ── Kanban card grab ── */
        .kb-card { cursor: grab; transition: transform 0.12s ease, box-shadow 0.12s ease; }
        .kb-card:hover  { transform: translate(-2px, -2px); }
        .kb-card:active { cursor: grabbing; transform: translate(2px, 2px); }

        /* ── Pulse dot ── */
        @keyframes pulse-ring {
            0%,100% { opacity: 1; transform: scale(1); }
            50%      { opacity: 0.5; transform: scale(1.4); }
        }
        .pulse-dot { animation: pulse-ring 2s ease-in-out infinite; }

        /* ── Section badge ── */
        .s-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #000;
            color: #fff;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 999px;
        }

        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="text-on-background relative min-h-screen overflow-x-hidden" style="font-family:'Space Grotesk',sans-serif;">

{{-- ══════════════════════════════════════════════
     NAV
══════════════════════════════════════════════ --}}
<nav class="fixed top-0 left-1/2 -translate-x-1/2 z-50 flex items-center justify-between px-5 py-2.5 w-[92%] max-w-4xl bg-white/95 backdrop-blur-lg rounded-full border-2 border-black mt-5 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
    <div class="text-xl font-black text-black tracking-tighter select-none">PULSE</div>

    <div class="hidden md:flex items-center gap-1">
        <a href="#platform" class="px-3 py-1.5 text-violet-600 font-bold text-sm border-b-2 border-violet-600">Platform</a>
        <a href="#features"  class="px-3 py-1.5 text-black font-bold text-sm hover:text-violet-600 hover:bg-surface-container rounded-md transition-colors">Framework</a>
        <a href="#features"  class="px-3 py-1.5 text-black font-bold text-sm hover:text-violet-600 hover:bg-surface-container rounded-md transition-colors">Docs</a>
        <a href="#pricing"   class="px-3 py-1.5 text-black font-bold text-sm hover:text-violet-600 hover:bg-surface-container rounded-md transition-colors">Pricing</a>
    </div>

    @if (Route::has('register'))
        <a href="{{ route('register') }}"
           class="bg-violet-600 text-white text-sm font-bold px-5 py-2 rounded-full border-2 border-black shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] active:translate-x-[3px] active:translate-y-[3px] active:shadow-none transition-all">
            Get Started
        </a>
    @else
        <button class="bg-violet-600 text-white text-sm font-bold px-5 py-2 rounded-full border-2 border-black shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] active:translate-x-[3px] active:translate-y-[3px] active:shadow-none transition-all">
            Get Started
        </button>
    @endif
</nav>


{{-- ══════════════════════════════════════════════
     HERO  (center-aligned — only this section)
══════════════════════════════════════════════ --}}
<section id="platform" class="relative pt-44 pb-20 px-6 flex flex-col items-center text-center overflow-hidden">

    {{-- Floating sticky note --}}
    <div class="absolute top-28 left-6 xl:left-28 -rotate-6 bg-secondary-container p-3.5 neobrutalism-border neobrutalism-shadow w-[158px] z-10 hidden lg:block card-lift">
        <p class="text-xs font-bold">Note to self:</p>
        <p class="text-sm mt-0.5">Make it pop. 💥</p>
    </div>

    {{-- Sarah badge --}}
    <div class="absolute top-36 right-6 xl:right-28 bg-white p-2.5 rounded-xl neobrutalism-border neobrutalism-shadow z-10 hidden lg:flex items-center gap-2.5 card-lift">
        <div class="relative shrink-0">
            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCEZ8NTv-uNAyNmJCMpFvEmVsXuvhuWNN2Ws83TEVm-QIQLUCMU0Y_7FpLN1AxM8s6e8j-xZWqs43gr142guC0vCeGydUbWzk0Ch9hmlchJEBW2KYVNB-IjSnctWwxGQnWGy7IsSCzHRiDSY8Fd14kletjSHLq-F4Pg-QS91vr6p9tPOOufiHBct1MfUQhYdDjy8MQbbSZjAC8ynPEPkI5A_XEO8kXVWTUIHMhZgClKjPKYfeuDqB9ikpiL2XqpvXZluzukk0yQBfI"
                 alt="Sarah" class="w-9 h-9 rounded-full border-2 border-black">
            <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-400 rounded-full border-2 border-white pulse-dot"></span>
        </div>
        <div class="text-left">
            <p class="text-xs font-bold leading-tight">Sarah Chen</p>
            <p class="text-[10px] text-on-surface-variant">is editing right now…</p>
        </div>
    </div>

    {{-- Alex cursor badge --}}
    <div class="absolute bottom-24 left-10 xl:left-32 bg-white p-2 rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000] z-10 hidden md:flex items-center gap-1.5 rotate-2 card-lift">
        <span class="material-symbols-outlined text-primary" style="font-size:16px;">mouse</span>
        <span class="bg-primary text-white text-[10px] font-black px-2 py-0.5 rounded-full">Alex's cursor</span>
    </div>

    {{-- Social proof pill --}}
    <div class="inline-flex items-center gap-2 bg-white border-2 border-black px-3 py-1.5 rounded-full text-xs font-bold mb-8 shadow-[2px_2px_0px_0px_#000] z-20">
        <span class="w-2 h-2 bg-green-400 rounded-full pulse-dot"></span>
        2,400+ teams building together right now
    </div>

    {{-- Headline --}}
    <h1 class="font-black text-on-background max-w-5xl z-20 relative"
        style="font-size:clamp(2.8rem,8.5vw,6.2rem); line-height:1.0; letter-spacing:-0.045em;">
        <span class="inline-block hover:-translate-y-2 transition-transform duration-200 cursor-default">DESIGN.</span>
        <span class="inline-block hover:-translate-y-2 transition-transform duration-200 cursor-default text-primary ml-2">BUILD.</span>
        <span class="inline-block hover:-translate-y-2 transition-transform duration-200 cursor-default ml-2"
              style="color:#fed01b; -webkit-text-stroke:2.5px black;">SYNC.</span>
        <br>
        <span class="inline-block mt-3 bg-black text-white px-8 py-3 rounded-2xl rotate-1 neobrutalism-shadow-lg">TOGETHER.</span>
    </h1>

    {{-- Sub --}}
    <p class="text-lg text-on-surface-variant max-w-xl mt-8 mb-10 z-20 leading-relaxed">
        The workspace for creative professionals who need a blank canvas and a powerful engine.
        <strong class="text-on-background">Stop switching context.</strong> Start building momentum.
    </p>

    {{-- CTAs --}}
    <div class="flex gap-3 z-20 flex-wrap justify-center mb-14">
        <button class="bg-primary text-white font-bold text-lg px-9 py-4 rounded-xl neobrutalism-border neobrutalism-shadow hover:shadow-[8px_8px_0px_0px_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all flex items-center gap-2">
            Start Playing
            <span class="material-symbols-outlined" style="font-size:20px;">arrow_forward</span>
        </button>
        <button class="bg-white text-black font-bold text-lg px-9 py-4 rounded-xl neobrutalism-border neobrutalism-shadow hover:bg-surface-container hover:shadow-[8px_8px_0px_0px_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all flex items-center gap-2">
            <span class="material-symbols-outlined" style="font-size:20px;">play_circle</span>
            View Demo
        </button>
    </div>

    {{-- Trust row --}}
    <div class="flex flex-wrap justify-center gap-8 z-20 text-sm">
        <div class="flex items-center gap-2">
            <div class="flex -space-x-2">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCJMoaMZprSoORsUDYpR_msjatjrm_0MsCNyBiUmVfiXcwd35CxG2oSj0X2ASvT6qviuJX-XSzOXPOLYSTv8rYzsWf7I-FmkbBxNz2ld2VqqQTLuh4UlbERjILx9lzNgfVBnQ77_Ppim453GO0cDMwo2pWv_MouEv3NibKohFLZ1vLKh41dDJnjVA6boHt0dKLL3jh4l4FJ9ruC5licraPK8DHxM-Sei4REceUHNQeS8XO2XxYDkhQmmSFNQcRcckDZLkTwhas20OU" alt="" class="w-7 h-7 rounded-full border-2 border-white shadow">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCcAz1JXxrJI1jvnyPNp-jAD_TD-NV0CvXHbBFj8fzltPrIOucsinviY_Vo9JbuXvbhXVwO_giTrxxM2jl0Z3J1jN2lYlJ0FsviRtMnIFzDhPG2cxXhgLw6g9AeuFh7d6yjfJg-2QHnP69DoikKzDsj9b3UbbFGPmWeBZa328NR-lWQR-wZYFji4lqFYpydowFTA__5JqAzW3b0YW5zQkib_Def4ikrn67GNeBKaTkk3n35X73pjez9wLyG0Yyuhw7d29WLmAXKNMA" alt="" class="w-7 h-7 rounded-full border-2 border-white shadow">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuA4Gt1TC1RHyEkGtu99_o1rPlSmRPlzakALujnPzd5W7WT3hFNMgA-DkDBZfbbarQz9J7LqkjXYsc6LOAC4bmtjQfaJ9jDrr1GLrjWyUMULxla0jQzFVx6xUvsz0zDfVQPQnyAfiIpfdBP6o1xP8Wt9B356vHUeKK5_VbHkfMJu-Vrs6gh2qUF1mxMANuuZv2g_cN-RcMOIveW26dMzUdqusM_fkS7qIIofjaalvO74E7MEbomaChTBTiRuxlfiiNWabXX1rt2bzp0" alt="" class="w-7 h-7 rounded-full border-2 border-white shadow">
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
     KANBAN SECTION  (left-aligned heading, grid columns)
══════════════════════════════════════════════ --}}
<section class="pt-24 pb-16 px-6 md:px-12 lg:px-16 relative z-20">
    <div class="max-w-7xl mx-auto">

        {{-- Left-aligned header --}}
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

        {{-- Board wrapper --}}
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
                    <div class="flex -space-x-2.5">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCJMoaMZprSoORsUDYpR_msjatjrm_0MsCNyBiUmVfiXcwd35CxG2oSj0X2ASvT6qviuJX-XSzOXPOLYSTv8rYzsWf7I-FmkbBxNz2ld2VqqQTLuh4UlbERjILx9lzNgfVBnQ77_Ppim453GO0cDMwo2pWv_MouEv3NibKohFLZ1vLKh41dDJnjVA6boHt0dKLL3jh4l4FJ9ruC5licraPK8DHxM-Sei4REceUHNQeS8XO2XxYDkhQmmSFNQcRcckDZLkTwhas20OU" alt="" class="w-8 h-8 rounded-full border-2 border-white">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCcAz1JXxrJI1jvnyPNp-jAD_TD-NV0CvXHbBFj8fzltPrIOucsinviY_Vo9JbuXvbhXVwO_giTrxxM2jl0Z3J1jN2lYlJ0FsviRtMnIFzDhPG2cxXhgLw6g9AeuFh7d6yjfJg-2QHnP69DoikKzDsj9b3UbbFGPmWeBZa328NR-lWQR-wZYFji4lqFYpydowFTA__5JqAzW3b0YW5zQkib_Def4ikrn67GNeBKaTkk3n35X73pjez9wLyG0Yyuhw7d29WLmAXKNMA" alt="" class="w-8 h-8 rounded-full border-2 border-white">
                        <div class="w-8 h-8 rounded-full border-2 border-white bg-secondary-container flex items-center justify-center text-[10px] font-black">+3</div>
                    </div>
                    <button class="flex items-center gap-1.5 bg-white text-xs font-bold px-3 py-1.5 rounded-full border-2 border-black shadow-[2px_2px_0px_0px_#000] hover:shadow-[4px_4px_0px_0px_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-[2px] active:translate-y-[2px] active:shadow-none transition-all">
                        <span class="material-symbols-outlined" style="font-size:14px;">filter_list</span> Filter
                    </button>
                    <button class="flex items-center gap-1.5 bg-primary text-white text-xs font-bold px-3 py-1.5 rounded-full border-2 border-black shadow-[2px_2px_0px_0px_#000] hover:shadow-[4px_4px_0px_0px_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all">
                        <span class="material-symbols-outlined" style="font-size:14px;">add</span> Add Task
                    </button>
                </div>
            </div>

            {{-- ── KANBAN COLUMNS: CSS GRID — 3 equal columns, no max-w constraint ── --}}
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
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBGEbyrhlApufBMG5GDiTSIVxMApnpM1N9WqEk_7hsXI22Uo5WYRme1oRy6DUq_wWMrThtjQdGBSlEKOXiJKnh2kS1_sJITTxVgrduw4pJpJUgYVVxoM8f-fA16B27ZqVdHbmQ7djtT9fcDEaC24m00gNE11EPRAiAfmPaQ2id9yY9G54JAFECV0BE9u-uoYqojiMzrbdzPrkqHb0AECJtuAkbr_bqq5HS4Zlodgq6NHHO2WZlgs4gaNYnUuPRVJkks6wtYOx2pTVg" alt="" class="w-5 h-5 rounded-full border border-black">
                            <span class="material-symbols-outlined text-outline" style="font-size:16px;">chat_bubble_outline</span>
                        </div>
                    </div>

                    <div class="kb-card bg-white rounded-lg border-2 border-black p-3.5 shadow-[2px_2px_0px_0px_#000] hover:shadow-[4px_4px_0px_0px_#000]">
                        <div class="flex gap-1.5 mb-2">
                            <span class="bg-primary-fixed text-on-primary-fixed px-2 py-0.5 rounded text-[10px] font-bold border border-black">Research</span>
                        </div>
                        <p class="font-bold text-sm mb-3">User Interview Synthesis</p>
                        <div class="flex justify-between items-center">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCcAz1JXxrJI1jvnyPNp-jAD_TD-NV0CvXHbBFj8fzltPrIOucsinviY_Vo9JbuXvbhXVwO_giTrxxM2jl0Z3J1jN2lYlJ0FsviRtMnIFzDhPG2cxXhgLw6g9AeuFh7d6yjfJg-2QHnP69DoikKzDsj9b3UbbFGPmWeBZa328NR-lWQR-wZYFji4lqFYpydowFTA__5JqAzW3b0YW5zQkib_Def4ikrn67GNeBKaTkk3n35X73pjez9wLyG0Yyuhw7d29WLmAXKNMA" alt="" class="w-5 h-5 rounded-full border border-black">
                            <span class="text-[10px] font-bold text-outline">Due Fri</span>
                        </div>
                    </div>

                    <div class="kb-card bg-white rounded-lg border-2 border-black p-3.5 shadow-[2px_2px_0px_0px_#000] opacity-60">
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

                    {{-- Active card --}}
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
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBOuawwSpAPukhV0hpJhTMnbxC1jYFKcev9hPy0Gel8K1DrBNVxi-6aGjJFPgBuMRkfL4FRVbADmDAJbnLQ9hh1HpwtJiK60L2Ts5FihBmrveeZMcBlzJnltinLHvaU1BWogbca9lDH9jgoqnJmA6wEj5pbYZps2TFY5qcT-dWY1e0F2k3aEPrnqIeNfmZoYlaj4sJ9atwYaz880L4Y1HIl91st31rj2UdBIa1KwVwoDmu4J4-68GGXkQD6FhBCx3vNo6hoAJQ--_c" alt="" class="w-5 h-5 rounded-full border border-black">
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
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBGEbyrhlApufBMG5GDiTSIVxMApnpM1N9WqEk_7hsXI22Uo5WYRme1oRy6DUq_wWMrThtjQdGBSlEKOXiJKnh2kS1_sJITTxVgrduw4pJpJUgYVVxoM8f-fA16B27ZqVdHbmQ7djtT9fcDEaC24m00gNE11EPRAiAfmPaQ2id9yY9G54JAFECV0BE9u-uoYqojiMzrbdzPrkqHb0AECJtuAkbr_bqq5HS4Zlodgq6NHHO2WZlgs4gaNYnUuPRVJkks6wtYOx2pTVg" alt="" class="w-5 h-5 rounded-full border border-black">
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
     FEATURES TRIO  (left-aligned)
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

            <div class="bg-white rounded-xl neobrutalism-border neobrutalism-shadow p-6 flex flex-col card-lift reveal">
                <div class="w-12 h-12 bg-primary rounded-xl neobrutalism-border flex items-center justify-center mb-5 shrink-0">
                    <span class="material-symbols-outlined text-white" style="font-size:22px;">bolt</span>
                </div>
                <h3 class="font-bold text-xl mb-2" style="letter-spacing:-0.02em;">Real-time Everything</h3>
                <p class="text-on-surface-variant text-sm leading-relaxed flex-1">
                    See cursors, edits, and status changes as they happen. No refresh. No lag. Ever.
                </p>
                <div class="mt-5 pt-4 border-t-2 border-black">
                    <span class="text-xs font-bold text-primary">Explore feature →</span>
                </div>
            </div>

            <div class="bg-secondary-container rounded-xl neobrutalism-border neobrutalism-shadow p-6 flex flex-col card-lift reveal reveal-d1">
                <div class="w-12 h-12 bg-black rounded-xl neobrutalism-border flex items-center justify-center mb-5 shrink-0">
                    <span class="material-symbols-outlined text-secondary-container" style="font-size:22px;">view_kanban</span>
                </div>
                <h3 class="font-bold text-xl mb-2" style="letter-spacing:-0.02em;">Smart Kanban Boards</h3>
                <p class="text-sm leading-relaxed flex-1" style="color:#6f5900;">
                    Drag. Drop. Done. Boards that adapt to your workflow, not the other way around.
                </p>
                <div class="mt-5 pt-4 border-t-2 border-black">
                    <span class="text-xs font-bold" style="color:#574500;">Explore feature →</span>
                </div>
            </div>

            <div class="bg-surface-container rounded-xl neobrutalism-border neobrutalism-shadow p-6 flex flex-col card-lift reveal reveal-d2">
                <div class="w-12 h-12 bg-tertiary rounded-xl neobrutalism-border flex items-center justify-center mb-5 shrink-0">
                    <span class="material-symbols-outlined text-white" style="font-size:22px;">trending_up</span>
                </div>
                <h3 class="font-bold text-xl mb-2" style="letter-spacing:-0.02em;">Velocity Analytics</h3>
                <p class="text-on-surface-variant text-sm leading-relaxed flex-1">
                    Track sprint velocity, surface blockers, and ship 3× faster with real insights.
                </p>
                <div class="mt-5 pt-4 border-t-2 border-black">
                    <span class="text-xs font-bold text-primary">Explore feature →</span>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════
     BENTO GRID  (left-aligned)
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

            {{-- Velocity (2 cols) --}}
            <div class="md:col-span-2 bg-white rounded-xl neobrutalism-border neobrutalism-shadow p-6 flex flex-col justify-between relative overflow-hidden group min-h-[260px] card-lift reveal">
                <div class="absolute top-0 right-0 w-44 h-44 bg-primary-fixed rounded-bl-[50%] -z-10 transition-transform duration-300 group-hover:scale-125"></div>
                <div>
                    <h3 class="font-bold text-xl flex items-center gap-2 mb-1" style="letter-spacing:-0.02em;">
                        Velocity <span class="material-symbols-outlined text-primary">trending_up</span>
                    </h3>
                    <p class="text-sm text-outline">Shipping faster than ever. <strong>+24% this sprint.</strong></p>
                </div>
                <div class="flex items-end gap-3 mt-6" style="height:112px;">
                    @php
                        $bars = [
                            ['h'=>'40%','label'=>'S8'],
                            ['h'=>'55%','label'=>'S9'],
                            ['h'=>'45%','label'=>'S10'],
                            ['h'=>'75%','label'=>'S11'],
                        ];
                    @endphp
                    @foreach($bars as $bar)
                    <div class="flex flex-col items-center flex-1 h-full justify-end gap-1">
                        <div class="w-full bg-surface-container border-2 border-black rounded-t hover:bg-primary transition-colors duration-200 cursor-pointer"
                             style="height:{{ $bar['h'] }};"></div>
                        <span class="text-[9px] text-outline font-bold">{{ $bar['label'] }}</span>
                    </div>
                    @endforeach
                    <div class="flex flex-col items-center flex-1 h-full justify-end gap-1 relative">
                        <div class="absolute -top-9 left-1/2 -translate-x-1/2 bg-black text-white px-2 py-0.5 rounded border-2 border-black text-[10px] font-black whitespace-nowrap">+24%</div>
                        <div class="w-full bg-primary border-2 border-black rounded-t" style="height:100%;"></div>
                        <span class="text-[9px] font-black text-primary">S12</span>
                    </div>
                </div>
            </div>

            {{-- Quick Hits (1 col) --}}
            <div class="bg-secondary-container rounded-xl neobrutalism-border neobrutalism-shadow p-6 flex flex-col min-h-[260px] card-lift reveal reveal-d1">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="font-bold text-xl" style="letter-spacing:-0.02em;">Quick Hits</h3>
                    <span class="bg-black text-white text-[10px] font-black px-2 py-0.5 rounded-full">2 left</span>
                </div>
                <ul class="space-y-3 flex-1">
                    <li class="flex items-center gap-3 bg-white p-3 rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000] hover:shadow-[3px_3px_0px_0px_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 accent-violet-600 cursor-pointer shrink-0">
                        <span class="font-bold text-xs">Review PR #402</span>
                        <span class="ml-auto text-[10px] text-outline font-medium shrink-0">High</span>
                    </li>
                    <li class="flex items-center gap-3 bg-white p-3 rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000] hover:shadow-[3px_3px_0px_0px_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 accent-violet-600 cursor-pointer shrink-0">
                        <span class="font-bold text-xs">Sync with Design</span>
                        <span class="ml-auto text-[10px] text-outline font-medium shrink-0">Med</span>
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

            {{-- Launch Day (1 col) --}}
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
                <div class="absolute -left-6 -bottom-10 w-32 h-32 bg-primary/20 rounded-full pointer-events-none"></div>
                <div class="relative z-10">
                    <h3 class="font-bold text-2xl text-white mb-1" style="letter-spacing:-0.02em;">Built for High-Performing Teams</h3>
                    <p class="text-white/60 text-sm">From scrappy startups to enterprise scale.</p>
                </div>
                <div class="flex items-center justify-between relative z-10">
                    <div class="flex -space-x-3">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuA4Gt1TC1RHyEkGtu99_o1rPlSmRPlzakALujnPzd5W7WT3hFNMgA-DkDBZfbbarQz9J7LqkjXYsc6LOAC4bmtjQfaJ9jDrr1GLrjWyUMULxla0jQzFVx6xUvsz0zDfVQPQnyAfiIpfdBP6o1xP8Wt9B356vHUeKK5_VbHkfMJu-Vrs6gh2qUF1mxMANuuZv2g_cN-RcMOIveW26dMzUdqusM_fkS7qIIofjaalvO74E7MEbomaChTBTiRuxlfiiNWabXX1rt2bzp0" alt="" class="w-11 h-11 rounded-full border-2 border-white">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuATvNx0AP2AXz98wimpb5E6IYj7hu1esDPKSStzObZlhEQeZBy3rbPkXOQrWBRbUDHR5OHb7YDhtntHtRIY00kawItf0--CyL2o7mzl-rKJcK7cTW2T53tpqaARCc_JHXbDnCTa7dwGKZR5yYizhKEbBNgzjxJBTE0YGULCdXZ24f5HjH_Tleook4bVKTOU4evcy8hOI-3tSj90YDY1iyOcOjmSpZeoReNnHaRVvWJ7lR1K8GbIUt8XASgFbVnWLwRILrLZzv5Biq4" alt="" class="w-11 h-11 rounded-full border-2 border-white">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBqOZ99XMDIocj8ptRLwjQONhCxe04WLd_bQNE8mD96deXRRZKirj12D4Y7fdH_J0MYK1ZTFS2deyJiY4ugDlSjKSPs1R-66fbqkiwiayXJSBBYKVEAu5hjDriNOwiJ9R6afVFrCUVwCDuavHvAtieKVf8F_wp3XgUAezhywJ6i3sP1phrI2nv3PT45ViXsNH3BYP3G2uLQiiiPN-xlmhoLPf74qEGRCKvdkokoyltAcHmU_jlNBbSB_jqXYJOj5SgLLjbYCl_JDqI" alt="" class="w-11 h-11 rounded-full border-2 border-white">
                        <div class="w-11 h-11 rounded-full border-2 border-white bg-primary flex items-center justify-center text-xs font-black text-white">+12</div>
                    </div>
                    <a href="#" class="flex items-center gap-1.5 bg-white text-black font-bold text-xs px-5 py-2.5 rounded-full border-2 border-white hover:bg-secondary-container transition-colors">
                        Join the team <span class="material-symbols-outlined" style="font-size:14px;">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════
     STATS BAND  (full-width dark)
══════════════════════════════════════════════ --}}
<section class="w-full bg-inverse-surface border-y-2 border-black py-16 px-6 md:px-12 lg:px-16 reveal">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-0 md:divide-x md:divide-white/10">
        <div class="text-left md:pr-10">
            <p class="font-black text-white" style="font-size:clamp(2.5rem,5.5vw,4rem); line-height:1; letter-spacing:-0.04em;">
                2,400<span class="text-secondary-container">+</span>
            </p>
            <p class="text-white/60 text-sm font-medium mt-1">Teams onboarded worldwide</p>
        </div>
        <div class="text-left md:text-center md:px-10">
            <p class="font-black text-white" style="font-size:clamp(2.5rem,5.5vw,4rem); line-height:1; letter-spacing:-0.04em;">
                3<span class="text-secondary-container">×</span>
            </p>
            <p class="text-white/60 text-sm font-medium mt-1">Faster shipping, on average</p>
        </div>
        <div class="text-left md:text-right md:pl-10">
            <p class="font-black text-white" style="font-size:clamp(2.5rem,5.5vw,4rem); line-height:1; letter-spacing:-0.04em;">
                4.9<span class="text-secondary-container">★</span>
            </p>
            <p class="text-white/60 text-sm font-medium mt-1">Average product rating</p>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════
     FOOTER
══════════════════════════════════════════════ --}}
<footer class="w-full flex flex-col items-center justify-center pt-24 pb-12 px-8 overflow-hidden bg-violet-600 border-t-4 border-black relative">
    {{-- Decorations --}}
    <div class="absolute bottom-10 left-8 w-16 h-16 bg-secondary-container rounded-full neobrutalism-border opacity-60 pointer-events-none"></div>
    <div class="absolute top-10 right-16 w-28 h-8 bg-white neobrutalism-border opacity-20 rotate-45 pointer-events-none"></div>
    <div class="absolute top-20 right-1/4 w-3 h-3 bg-secondary-container rounded-full opacity-50 pointer-events-none"></div>

    <h2 class="font-black uppercase italic leading-none text-yellow-400 tracking-tighter select-none hover:-rotate-1 transition-transform z-10 text-center w-full"
        style="font-size:clamp(3rem,11vw,11rem);">
        READY TO PLAY?
    </h2>

    <div class="mt-10 z-10">
        <button class="bg-black text-white font-black text-base px-10 py-4 rounded-full border-2 border-black shadow-[4px_4px_0px_0px_rgba(254,208,27,1)] hover:shadow-[7px_7px_0px_0px_rgba(254,208,27,1)] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all">
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
    // Scroll-reveal via IntersectionObserver
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('is-visible');
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -32px 0px' });

    document.querySelectorAll('.reveal').forEach(el => io.observe(el));

    // Kanban card press-down feedback
    document.querySelectorAll('.kb-card').forEach(card => {
        card.addEventListener('pointerdown', function () {
            this.style.transform = 'translate(2px,2px)';
        });
        card.addEventListener('pointerup', function () {
            this.style.transform = '';
        });
        card.addEventListener('pointerleave', function () {
            this.style.transform = '';
        });
    });
</script>

</body>
</html>
