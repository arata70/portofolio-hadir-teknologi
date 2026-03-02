@extends('layouts.admin')

@section('title', 'Tambah Project')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">Buat Project Baru</h1>
            <p class="mt-2 text-sm text-slate-500">Saat disimpan, project otomatis masuk ke daftar postingan dengan status draft.</p>
        </div>
        <a href="{{ route('admin.posts.index') }}"
            class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
            Lihat Postingan
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

    <form action="{{ route('admin.projects.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm space-y-7">
        @csrf

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label for="title" class="mb-2 block text-base font-semibold text-slate-800">Judul Project</label>
                <input id="title" type="text" name="title" value="{{ old('title') }}"
                    class="w-full rounded-lg border-slate-300 px-4 py-3 text-base focus:border-cyan-500 focus:ring-cyan-500"
                    placeholder="Contoh: Aplikasi ERP Internal" required>
            </div>

            <div>
                <label for="slug" class="mb-2 block text-base font-semibold text-slate-800">Slug</label>
                <input id="slug" type="text" name="slug" value="{{ old('slug') }}"
                    class="w-full rounded-lg border-slate-300 px-4 py-3 text-base focus:border-cyan-500 focus:ring-cyan-500"
                    placeholder="aplikasi-erp-internal" required>
            </div>
        </div>

        <div>
            <label for="excerpt" class="mb-2 block text-base font-semibold text-slate-800">Ringkasan</label>
            <textarea id="excerpt" name="excerpt" rows="3"
                class="w-full rounded-lg border-slate-300 px-4 py-3 text-base leading-relaxed focus:border-cyan-500 focus:ring-cyan-500"
                placeholder="Ringkasan singkat project untuk preview kartu">{{ old('excerpt') }}</textarea>
        </div>

        <div>
            <label for="description" class="mb-2 block text-base font-semibold text-slate-800">Deskripsi Lengkap</label>
            <textarea id="description" name="description" rows="6"
                class="w-full rounded-lg border-slate-300 px-4 py-3 text-base leading-relaxed focus:border-cyan-500 focus:ring-cyan-500"
                placeholder="Ceritakan detail hasil, proses, dan dampak project">{{ old('description') }}</textarea>
        </div>

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label for="technology" class="mb-2 block text-base font-semibold text-slate-800">Teknologi</label>
                <input id="technology" type="text" name="technology" value="{{ old('technology') }}"
                    class="w-full rounded-lg border-slate-300 px-4 py-3 text-base focus:border-cyan-500 focus:ring-cyan-500"
                    placeholder="Laravel, Tailwind, MySQL">
            </div>

            <div>
                <label for="year" class="mb-2 block text-base font-semibold text-slate-800">Tahun</label>
                <input id="year" type="number" name="year" value="{{ old('year', date('Y')) }}"
                    class="w-full rounded-lg border-slate-300 px-4 py-3 text-base focus:border-cyan-500 focus:ring-cyan-500"
                    min="2000" max="2099" required>
            </div>
        </div>

        <div>
            <label for="thumbnail" class="mb-2 block text-base font-semibold text-slate-800">Thumbnail</label>
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                <img id="preview" src="#" alt="Preview thumbnail"
                    class="hidden h-24 w-36 rounded-lg border border-slate-300 object-cover">
                <input id="thumbnail" type="file" name="thumbnail" accept="image/*"
                    class="block w-full text-sm text-slate-600 file:mr-3 file:rounded-md file:border-0 file:bg-slate-900 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-700"
                    onchange="previewImage(event)">
            </div>
            <p class="mt-2 text-xs text-slate-500">Format JPG/PNG, maksimal 2MB.</p>
        </div>

        <div class="flex justify-end gap-3 border-t border-slate-200 pt-5">
            <a href="{{ route('admin.posts.index') }}"
                class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                Batal
            </a>
            <button type="submit"
                class="inline-flex items-center rounded-lg bg-cyan-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-cyan-700">
                Simpan Sebagai Draft
            </button>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (!file) return;

    const img = document.getElementById('preview');
    img.src = URL.createObjectURL(file);
    img.classList.remove('hidden');
}

const titleInput = document.getElementById('title');
const slugInput = document.getElementById('slug');
let slugEditedManually = slugInput.value.trim() !== '';

slugInput.addEventListener('input', () => {
    slugEditedManually = true;
});

titleInput.addEventListener('input', () => {
    if (slugEditedManually) return;
    slugInput.value = titleInput.value
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
});
</script>
@endsection
