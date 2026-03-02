@extends('layouts.app')

@section('title', $companyProfile->company_name . ' - Company Portfolio')

@section('content')
@php
    $missionItems = collect(preg_split("/\r\n|\n|\r/", (string) $companyProfile->mission))
        ->map(fn ($item) => trim($item))
        ->filter()
        ->values();

    $latestProject = $projects
        ->sortByDesc(function ($project) {
            $year = (int) ($project->year ?? 0);
            $timestamp = $project->created_at?->timestamp ?? 0;

            return ($year * 10000000000) + $timestamp;
        })
        ->first();

    $instagramValue = trim((string) $companyProfile->contact_instagram);
    $instagramUrl = null;
    $instagramHandle = '-';
    if ($instagramValue !== '') {
        if (str_starts_with($instagramValue, 'http://') || str_starts_with($instagramValue, 'https://')) {
            $instagramUrl = $instagramValue;
            $path = trim((string) parse_url($instagramValue, PHP_URL_PATH), '/');
            $instagramHandle = $path !== '' ? '@' . $path : $instagramValue;
        } else {
            $instagramHandle = '@' . ltrim($instagramValue, '@');
            $instagramUrl = 'https://instagram.com/' . ltrim($instagramValue, '@');
        }
    }

    $phoneDigits = preg_replace('/[^0-9]/', '', (string) $companyProfile->contact_phone);
    if ($phoneDigits !== null && str_starts_with($phoneDigits, '0')) {
        $phoneDigits = '62' . substr($phoneDigits, 1);
    }
    $whatsAppUrl = $phoneDigits ? 'https://wa.me/' . $phoneDigits : null;
@endphp

<section class="py-14 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 grid lg:grid-cols-2 gap-10 lg:gap-14 items-center">
        <div class="grid grid-cols-2 gap-4 reveal delay-1">
            <div class="col-span-2 rounded-3xl border border-slate-200 bg-emerald-50 p-6 card-hover">
                <p class="text-sm font-semibold text-emerald-700">Active Projects</p>
                <div class="mt-2 flex items-center justify-between">
                    <p class="text-4xl font-extrabold text-slate-900">{{ $projects->count() }}</p>
                    <div class="flex -space-x-2">
                        <span class="h-9 w-9 rounded-full border-2 border-white bg-amber-500"></span>
                        <span class="h-9 w-9 rounded-full border-2 border-white bg-blue-500"></span>
                        <span class="h-9 w-9 rounded-full border-2 border-white bg-rose-500"></span>
                        <span class="h-9 w-9 rounded-full border-2 border-white bg-slate-700"></span>
                    </div>
                </div>
            </div>

            <div class="col-span-2 rounded-3xl border border-slate-200 bg-emerald-900 p-6 card-hover">
                <p class="text-sm font-semibold text-emerald-200">Latest Project</p>
                <div class="mt-3 flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <p class="text-4xl font-extrabold text-emerald-100">{{ $latestProject?->year ?: '-' }}</p>
                        <p class="mt-1 text-sm font-medium text-emerald-200">
                            {{ $latestProject?->title ?: 'Belum ada project yang dipublish' }}
                        </p>
                    </div>
                    @if ($latestProject)
                        <span class="inline-flex rounded-xl bg-emerald-100 px-4 py-2 text-xs font-bold uppercase tracking-wide text-emerald-900">
                            Dari Postingan Terbaru
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="reveal delay-2">
            <p class="inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-bold uppercase tracking-wide text-emerald-700">
                Digital Solution Partner
            </p>
            <h1 class="mt-4 text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 leading-tight">
                Transforming Ideas Into
                <span class="text-emerald-600">Digital Reality</span>
            </h1>
            <p class="mt-6 max-w-xl text-base sm:text-lg leading-relaxed text-slate-600">
                {{ $companyProfile->about }}
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="#projects"
                   class="inline-flex items-center rounded-xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white hover:bg-emerald-600 transition">
                    Lihat Project
                </a>
                <a href="#contact"
                   class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-bold text-slate-700 hover:border-emerald-300 hover:text-emerald-700 transition">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>

<section id="about" class="border-y border-slate-200 bg-white py-16 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 grid lg:grid-cols-2 gap-8 lg:gap-12">
        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 sm:p-8 reveal delay-1">
            <p class="text-xs font-bold uppercase tracking-widest text-emerald-700">Visi</p>
            <p class="mt-3 text-lg leading-relaxed text-slate-700">{{ $companyProfile->vision }}</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 sm:p-8 reveal delay-2">
            <p class="text-xs font-bold uppercase tracking-widest text-emerald-700">Misi</p>
            <ul class="mt-4 space-y-3">
                @forelse ($missionItems as $mission)
                    <li class="flex items-start gap-3 text-slate-700">
                        <span class="mt-1 inline-block h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                        <span>{{ $mission }}</span>
                    </li>
                @empty
                    <li class="text-slate-500">Belum ada data misi.</li>
                @endforelse
            </ul>
        </div>
    </div>
</section>

<section id="projects" class="py-16 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="mb-10 sm:mb-12 text-center">
            <p class="text-xs font-bold uppercase tracking-widest text-emerald-700">Portfolio</p>
            <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold text-slate-900">Project Kami</h2>
            <p class="mt-3 text-slate-500">Project yang sudah publish dan siap untuk ditinjau.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($projects as $project)
                <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white card-hover reveal delay-{{ $loop->iteration }}">
                    @if ($project->thumbnail)
                        <img src="{{ asset('storage/' . $project->thumbnail) }}"
                             alt="{{ $project->title }}"
                             class="h-52 w-full object-cover">
                    @else
                        <div class="flex h-52 w-full items-center justify-center bg-slate-100 text-sm font-semibold text-slate-500">
                            No Image
                        </div>
                    @endif

                    <div class="p-6">
                        <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-emerald-700">{{ $project->year ?: '-' }}</p>
                        <h3 class="text-xl font-bold text-slate-900">{{ $project->title }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ $project->excerpt }}</p>
                        <a href="{{ route('projects.show', $project) }}"
                           class="mt-5 inline-flex items-center text-sm font-bold text-emerald-600 hover:text-emerald-700">
                            Lihat Detail
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-3xl border border-dashed border-slate-300 bg-white p-10 text-center text-slate-500">
                    Belum ada project yang dipublish.
                </div>
            @endforelse
        </div>
    </div>
</section>

<section id="contact" class="pb-16 sm:pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="rounded-[2rem] border border-emerald-200 bg-gradient-to-br from-emerald-50 via-white to-emerald-100 p-6 sm:p-10">
            <div class="grid lg:grid-cols-5 gap-8">
                <div class="lg:col-span-2 reveal delay-1">
                    <p class="text-xs font-bold uppercase tracking-widest text-emerald-700">Contact</p>
                    <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold text-slate-900">Let's Build Something Great</h2>
                    <p class="mt-4 text-slate-600 leading-relaxed">
                        Tim kami siap berdiskusi soal website, aplikasi, atau sistem internal bisnis Anda.
                    </p>
                    <div class="mt-6 rounded-2xl border border-emerald-200 bg-white/80 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Company</p>
                        <p class="mt-1 text-lg font-bold text-slate-900">{{ $companyProfile->company_name }}</p>
                    </div>
                </div>

                <div class="lg:col-span-3 grid gap-4 sm:grid-cols-2 lg:grid-cols-3 reveal delay-2">
                    <div class="rounded-2xl border border-slate-200 bg-white p-5">
                        <div class="mb-4 inline-flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                            <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current" aria-hidden="true">
                                <path d="M20 4H4a2 2 0 0 0-2 2v.35l10 6.25L22 6.35V6a2 2 0 0 0-2-2zm2 4.74-9.47 5.92a1 1 0 0 1-1.06 0L2 8.74V18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8.74z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Email</p>
                        <p class="mt-2 text-sm font-bold text-slate-900 break-all">{{ $companyProfile->contact_email ?: '-' }}</p>
                        @if ($companyProfile->contact_email)
                            <a href="mailto:{{ $companyProfile->contact_email }}"
                               class="mt-4 inline-flex text-xs font-bold text-emerald-600 hover:text-emerald-700">
                                Kirim Email
                            </a>
                        @endif
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-5">
                        <div class="mb-4 inline-flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                            <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current" aria-hidden="true">
                                <path d="M6.62 10.79a15.54 15.54 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24 11.36 11.36 0 0 0 3.58.57 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.49a1 1 0 0 1 1 1 11.36 11.36 0 0 0 .57 3.58 1 1 0 0 1-.24 1.01l-2.2 2.2z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">No HP</p>
                        <p class="mt-2 text-sm font-bold text-slate-900">{{ $companyProfile->contact_phone ?: '-' }}</p>
                        @if ($whatsAppUrl)
                            <a href="{{ $whatsAppUrl }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="mt-4 inline-flex text-xs font-bold text-emerald-600 hover:text-emerald-700">
                                Chat WhatsApp
                            </a>
                        @endif
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-5 sm:col-span-2 lg:col-span-1">
                        <div class="mb-4 inline-flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                            <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current" aria-hidden="true">
                                <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm8.5 1.5h-8.5A4.25 4.25 0 0 0 3.5 7.75v8.5a4.25 4.25 0 0 0 4.25 4.25h8.5a4.25 4.25 0 0 0 4.25-4.25v-8.5A4.25 4.25 0 0 0 16.25 3.5zm-4.25 3.25a5.25 5.25 0 1 1 0 10.5 5.25 5.25 0 0 1 0-10.5zm0 1.5a3.75 3.75 0 1 0 0 7.5 3.75 3.75 0 0 0 0-7.5zm5.38-.94a1.12 1.12 0 1 1 0 2.24 1.12 1.12 0 0 1 0-2.24z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Instagram</p>
                        <p class="mt-2 text-sm font-bold text-slate-900 break-all">{{ $instagramHandle }}</p>
                        @if ($instagramUrl)
                            <a href="{{ $instagramUrl }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="mt-4 inline-flex text-xs font-bold text-emerald-600 hover:text-emerald-700">
                                Buka Instagram
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
