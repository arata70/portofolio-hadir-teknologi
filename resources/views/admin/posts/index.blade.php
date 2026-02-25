@extends('layouts.admin')

@section('title', 'Postingan')

@section('content')
@php
    $draftCount = $posts->where('status', 'draft')->count();
    $publishCount = $posts->where('status', 'publish')->count();
@endphp

<div class="space-y-6">
    <div class="flex flex-wrap items-start justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">Manajemen Postingan Project</h1>
            <p class="mt-2 text-sm text-slate-500">Review draft terlebih dahulu, lalu publish agar tampil di halaman publik.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}"
            class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
            + Tambah Project
        </a>
    </div>

    @if (session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    @if (session('info'))
        <div class="rounded-xl border border-sky-200 bg-sky-50 px-4 py-3 text-sm text-sky-700">
            {{ session('info') }}
        </div>
    @endif

    <div class="grid gap-4 sm:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Total</p>
            <p class="mt-2 text-2xl font-bold text-slate-900">{{ $posts->count() }}</p>
        </div>
        <div class="rounded-2xl border border-amber-200 bg-amber-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-amber-600">Draft</p>
            <p class="mt-2 text-2xl font-bold text-amber-700">{{ $draftCount }}</p>
        </div>
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-emerald-600">Publish</p>
            <p class="mt-2 text-2xl font-bold text-emerald-700">{{ $publishCount }}</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-900 text-slate-200">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Foto</th>
                        <th class="px-4 py-3 text-left font-semibold">Judul</th>
                        <th class="px-4 py-3 text-left font-semibold">Slug</th>
                        <th class="px-4 py-3 text-left font-semibold">Ringkasan</th>
                        <th class="px-4 py-3 text-left font-semibold">Deskripsi</th>
                        <th class="px-4 py-3 text-left font-semibold">Status</th>
                        <th class="px-4 py-3 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr class="border-b border-slate-100 align-top hover:bg-slate-50/70">
                            <td class="px-4 py-4">
                                @if ($post->thumbnail)
                                    <img src="{{ asset('storage/' . $post->thumbnail) }}"
                                        alt="{{ $post->title }}"
                                        class="h-14 w-20 rounded-lg object-cover border border-slate-200">
                                @else
                                    <div class="flex h-14 w-20 items-center justify-center rounded-lg border border-slate-200 bg-slate-100 text-xs font-semibold text-slate-500">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                <p class="font-semibold text-slate-900">{{ $post->title }}</p>
                                <p class="text-xs text-slate-500">Tahun {{ $post->year ?? '-' }}</p>
                            </td>
                            <td class="px-4 py-4">
                                <code class="rounded bg-slate-100 px-2 py-1 text-xs text-slate-700">{{ $post->slug }}</code>
                            </td>
                            <td class="px-4 py-4 text-slate-700">{{ \Illuminate\Support\Str::limit($post->excerpt, 90) }}</td>
                            <td class="px-4 py-4 text-slate-700">{{ \Illuminate\Support\Str::limit($post->description, 120) }}</td>
                            <td class="px-4 py-4">
                                @if ($post->status === 'publish')
                                    <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">Publish</span>
                                @else
                                    <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">Draft</span>
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex justify-end gap-2">
                                    @if ($post->status === 'draft')
                                        <form method="POST" action="{{ route('admin.posts.publish', $post) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="rounded-lg bg-emerald-600 px-3 py-2 text-xs font-semibold text-white hover:bg-emerald-700">
                                                Publish
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('admin.projects.edit', $post) }}"
                                        class="rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-100">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('admin.projects.destroy', $post) }}"
                                        onsubmit="return confirm('Hapus project ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="rounded-lg bg-rose-600 px-3 py-2 text-xs font-semibold text-white hover:bg-rose-700">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center text-slate-500">
                                Belum ada postingan project.
                                <a href="{{ route('admin.projects.create') }}" class="font-semibold text-cyan-600 hover:text-cyan-700">Buat draft pertama</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
