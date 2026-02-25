@extends('layouts.admin')

@section('title', 'Beranda')

@section('content')
<h1 class="text-2xl font-bold mb-8">Beranda</h1>

@if (session('success'))
    <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white rounded-xl p-6 shadow">
        <h3 class="text-sm text-gray-500">Total Project</h3>
        <p class="text-3xl font-bold mt-2">{{ $totalProjects }}</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow">
        <h3 class="text-sm text-gray-500">Draft</h3>
        <p class="text-3xl font-bold mt-2">{{ $draftCount }}</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow">
        <h3 class="text-sm text-gray-500">Publish</h3>
        <p class="text-3xl font-bold mt-2">{{ $publishCount }}</p>
    </div>

</div>

<div class="mt-10 rounded-2xl bg-white p-6 shadow">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-slate-900">Profil Perusahaan (Public)</h2>
        <p class="mt-1 text-sm text-slate-500">Data ini ditampilkan di halaman publik untuk bagian Tentang, Visi, Misi, dan Kontak.</p>
    </div>

    <form method="POST" action="{{ route('admin.dashboard.company-profile.update') }}" class="space-y-5">
        @csrf
        @method('PATCH')

        <div>
            <label for="company_name" class="mb-1 block text-sm font-semibold text-slate-700">Nama Perusahaan</label>
            <input id="company_name" name="company_name" type="text"
                   value="{{ old('company_name', $companyProfile->company_name) }}"
                   class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
            @error('company_name')
                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="about" class="mb-1 block text-sm font-semibold text-slate-700">Tentang Perusahaan</label>
            <textarea id="about" name="about" rows="4"
                      class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">{{ old('about', $companyProfile->about) }}</textarea>
            @error('about')
                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label for="vision" class="mb-1 block text-sm font-semibold text-slate-700">Visi</label>
                <textarea id="vision" name="vision" rows="6"
                          class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">{{ old('vision', $companyProfile->vision) }}</textarea>
                @error('vision')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="mission" class="mb-1 block text-sm font-semibold text-slate-700">Misi (1 baris = 1 poin)</label>
                <textarea id="mission" name="mission" rows="6"
                          class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">{{ old('mission', $companyProfile->mission) }}</textarea>
                @error('mission')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid gap-5 md:grid-cols-3">
            <div>
                <label for="contact_email" class="mb-1 block text-sm font-semibold text-slate-700">Email Kontak</label>
                <input id="contact_email" name="contact_email" type="email"
                       value="{{ old('contact_email', $companyProfile->contact_email) }}"
                       class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
                @error('contact_email')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="contact_phone" class="mb-1 block text-sm font-semibold text-slate-700">Nomor Telepon</label>
                <input id="contact_phone" name="contact_phone" type="text"
                       value="{{ old('contact_phone', $companyProfile->contact_phone) }}"
                       class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
                @error('contact_phone')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="contact_instagram" class="mb-1 block text-sm font-semibold text-slate-700">Instagram</label>
                <input id="contact_instagram" name="contact_instagram" type="text"
                       value="{{ old('contact_instagram', $companyProfile->contact_instagram) }}"
                       placeholder="@hadirteknologi atau https://instagram.com/hadirteknologi"
                       class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
                @error('contact_instagram')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="pt-2">
            <button type="submit"
                    class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
