<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Company Portfolio')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --brand-50: #ecfdf5;
            --brand-100: #d1fae5;
            --brand-500: #10b981;
            --brand-600: #059669;
            --brand-800: #065f46;
            --ink-900: #0f172a;
            --ink-700: #334155;
            --ink-500: #64748b;
            --surface: #f4f6f8;
            --line: #e2e8f0;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(180deg, #f8fafc 0%, var(--surface) 60%);
            color: var(--ink-900);
        }

        .glass-header {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--line);
        }

        .nav-link {
            color: var(--ink-700);
            transition: color .2s ease;
        }

        .nav-link:hover {
            color: var(--brand-600);
        }

        .nav-cta {
            background: var(--brand-500);
            color: #fff;
            transition: all .2s ease;
        }

        .nav-cta:hover {
            background: var(--brand-600);
            transform: translateY(-1px);
        }

        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.7s ease-out;
        }

        .reveal-active {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-1 { transition-delay: .08s; }
        .delay-2 { transition-delay: .16s; }
        .delay-3 { transition-delay: .24s; }

        .card-hover {
            transition: transform .28s ease, box-shadow .28s ease;
        }

        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 35px rgba(15, 23, 42, .08);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <header class="sticky top-0 z-40 glass-header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                    <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current" aria-hidden="true">
                        <path d="M12 3L2 8v2h2v9h5v-6h6v6h5v-9h2V8L12 3z"/>
                    </svg>
                </span>
                <span class="text-lg font-extrabold tracking-tight text-slate-900">
                    Hadir <span class="text-emerald-600">Teknologi</span>
                </span>
            </a>

            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="{{ route('home') }}#about" class="nav-link">About</a>
                <a href="{{ route('home') }}#projects" class="nav-link">Projects</a>
                <a href="{{ route('home') }}#contact" class="nav-link">Contact</a>
            </nav>

            <a href="{{ route('home') }}#contact"
               class="hidden sm:inline-flex items-center rounded-xl px-4 py-2 text-sm font-bold nav-cta">
                Contact
            </a>

            <button id="mobile-menu-btn"
                    class="sm:hidden inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-700"
                    type="button"
                    aria-label="Open menu">
                <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current" aria-hidden="true">
                    <path d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z"/>
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden border-t border-slate-200 bg-white sm:hidden">
            <div class="max-w-7xl mx-auto px-4 py-3 grid gap-2 text-sm font-semibold">
                <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 hover:bg-emerald-50">Home</a>
                <a href="{{ route('home') }}#about" class="rounded-lg px-3 py-2 hover:bg-emerald-50">About</a>
                <a href="{{ route('home') }}#projects" class="rounded-lg px-3 py-2 hover:bg-emerald-50">Projects</a>
                <a href="{{ route('home') }}#contact" class="rounded-lg px-3 py-2 hover:bg-emerald-50">Contact</a>
            </div>
        </div>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-bold text-slate-900">Hadir Teknologi Nusantara</p>
                    <p class="text-sm text-slate-500">Membangun solusi digital modern untuk bisnis yang bertumbuh.</p>
                </div>
                <div class="text-xs text-slate-400">
                    &copy; {{ date('Y') }} Hadir Teknologi Nusantara
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const reveals = document.querySelectorAll('.reveal');
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('reveal-active');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15 });

            reveals.forEach(el => observer.observe(el));

            const slider = document.getElementById('project-slider');
            if (slider && slider.children.length > 1) {
                let index = 0;
                setInterval(() => {
                    index = (index + 1) % slider.children.length;
                    slider.style.transform = `translateX(-${index * 100}%)`;
                }, 4200);
            }

            const menuButton = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            if (menuButton && mobileMenu) {
                menuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>
