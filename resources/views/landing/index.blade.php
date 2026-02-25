@extends('layouts.public')

@section('title', 'Portfolio Project')

@section('title', 'Company Portfolio')

@section('content')

<!-- HERO SECTION -->
<section class="bg-primary text-white">
    <div class="max-w-7xl mx-auto px-6 py-28 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">
            Portfolio Project Perusahaan
        </h1>
        <p class="max-w-2xl mx-auto text-lg text-gray-200">
            Menampilkan berbagai project yang telah kami kerjakan menggunakan
            teknologi modern dan solusi digital terbaik.
        </p>
    </div>
</section>


<!-- ABOUT -->
<section class="bg-muted py-20">
    <div class="max-w-5xl mx-auto px-6">
        <h2 class="text-2xl font-semibold mb-4">
            Tentang Perusahaan
        </h2>
        <p class="text-gray-600 leading-relaxed">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Website ini digunakan sebagai dokumentasi dan portofolio
            project perusahaan.
        </p>
    </div>
</section>


<!-- PROJECT GRID -->
<section id="projects" class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl font-bold mb-10">Project Kami</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- CARD -->
            @for ($i = 1; $i <= 6; $i++)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                    <div class="h-48 bg-gray-200 rounded-t-lg"></div>
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition p-6">
    <h3 class="font-semibold text-lg mb-2">
        Project Dummy
    </h3>

    <p class="text-sm text-gray-600 mb-4">
        Deskripsi project masih dummy.
    </p>

    <a href="/projects/1"
class="inline-block text-secondary font-medium text-sm">
        Lihat Detail →
    </a>
        </div>

                </div>
            @endfor
        </div>
    </div>
</section>

@endsection
