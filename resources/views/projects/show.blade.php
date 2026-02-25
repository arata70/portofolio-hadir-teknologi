@extends('layouts.app')

@section('title', $project->title)

@section('content')
<section class="py-14 sm:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-white via-emerald-50/30 to-white p-6 sm:p-10">
            <p class="inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-bold uppercase tracking-wide text-emerald-700">
                {{ $project->year ?: '-' }}
            </p>
            <h1 class="mt-4 text-3xl sm:text-5xl font-extrabold tracking-tight text-slate-900">{{ $project->title }}</h1>
            <p class="mt-4 max-w-3xl text-slate-600 text-base sm:text-lg leading-relaxed">
                {{ $project->excerpt }}
            </p>
        </div>
    </div>
</section>

<section class="pb-16 sm:pb-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 rounded-3xl border border-slate-200 bg-white p-5 sm:p-6">
            @if ($project->thumbnail)
                <img src="{{ asset('storage/' . $project->thumbnail) }}"
                     alt="{{ $project->title }}"
                     class="mb-6 w-full rounded-2xl object-cover">
            @else
                <div class="mb-6 flex h-64 w-full items-center justify-center rounded-2xl bg-slate-100 text-sm font-semibold text-slate-500">
                    No Image
                </div>
            @endif

            <h2 class="text-2xl font-bold text-slate-900">Deskripsi Project</h2>
            <p class="mt-3 text-slate-600 leading-relaxed whitespace-pre-line">{{ $project->description }}</p>
        </div>

        <aside class="rounded-3xl border border-slate-200 bg-white p-6 h-fit">
            <h3 class="text-lg font-bold text-slate-900">Informasi Project</h3>
            <ul class="mt-4 space-y-3 text-sm text-slate-600">
                <li class="flex items-center justify-between gap-3">
                    <span>Teknologi</span>
                    <span class="font-semibold text-slate-900">{{ $project->technology ?: '-' }}</span>
                </li>
                <li class="flex items-center justify-between gap-3">
                    <span>Tahun</span>
                    <span class="font-semibold text-slate-900">{{ $project->year ?: '-' }}</span>
                </li>
                <li class="flex items-center justify-between gap-3">
                    <span>Status</span>
                    <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold capitalize text-emerald-700">
                        {{ $project->status }}
                    </span>
                </li>
            </ul>

            <a href="{{ route('home') }}"
               class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-emerald-500 px-4 py-3 text-sm font-bold text-white hover:bg-emerald-600 transition">
                Kembali ke Home
            </a>
        </aside>
    </div>
</section>
@endsection
