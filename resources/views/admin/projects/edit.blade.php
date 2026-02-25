@extends('layouts.admin')

@section('title', 'Edit Project')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">Edit Project</h1>
            <p class="mt-2 text-sm text-slate-500">Perbarui data sebelum dipublish ke halaman publik.</p>
        </div>
        <a href="{{ route('admin.posts.index') }}"
            class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
            Kembali ke Postingan
        </a>
    </div>

    @if ($errors->any())
        <div class="rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
            <p class="font-semibold">Data belum valid:</p>
            <ul class="mt-2 list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.update', $project) }}"
        method="POST"
        enctype="multipart/form-data"
        class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm space-y-6">
        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Judul Project</label>
                <input type="text" name="title"
                    value="{{ old('title', $project->title) }}"
                    class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500"
                    required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Slug</label>
                <input type="text" name="slug"
                    value="{{ old('slug', $project->slug) }}"
                    class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500"
                    required>
            </div>
        </div>

        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Ringkasan</label>
            <textarea name="excerpt" rows="3"
                class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500">{{ old('excerpt', $project->excerpt) }}</textarea>
        </div>

        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Deskripsi</label>
            <textarea name="description" rows="6"
                class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500">{{ old('description', $project->description) }}</textarea>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Teknologi</label>
                <input type="text" name="technology"
                    value="{{ old('technology', $project->technology) }}"
                    class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500">
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Tahun</label>
                <input type="number" name="year"
                    value="{{ old('year', $project->year) }}"
                    class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500"
                    min="2000" max="2099" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                <select name="status"
                    class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500">
                    <option value="draft" @selected(old('status', $project->status) === 'draft')>Draft</option>
                    <option value="publish" @selected(old('status', $project->status) === 'publish')>Publish</option>
                </select>
            </div>
        </div>

        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Thumbnail</label>
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                @if ($project->thumbnail)
                    <img src="{{ asset('storage/' . $project->thumbnail) }}"
                        alt="{{ $project->title }}"
                        class="h-24 w-36 rounded-xl border border-slate-300 object-cover">
                @endif
                <input type="file" name="thumbnail" accept="image/*"
                    class="block w-full text-sm text-slate-600 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-700">
            </div>
        </div>

        <div class="flex justify-end gap-3 border-t border-slate-200 pt-4">
            <a href="{{ route('admin.posts.index') }}"
                class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                Batal
            </a>
            <button type="submit"
                class="inline-flex items-center rounded-xl bg-cyan-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-cyan-700">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
