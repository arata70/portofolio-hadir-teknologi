@extends('layouts.admin')

@section('title', 'Project')

@section('content')
<div class="bg-white rounded-xl shadow p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Project</h1>
        <a href="{{ route('admin.projects.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Tambah Project
        </a>
    </div>

    <table class="w-full text-sm">
        <thead>
            <tr class="border-b text-left text-gray-500">
                <th class="py-3">Judul</th>
                <th>Status</th>
                <th>Tahun</th>
                <th class="text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr class="border-b">
                <td class="py-3 font-medium">{{ $project->title }}</td>
                <td>
                    <span class="px-2 py-1 rounded text-xs
                        {{ $project->status === 'publish'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-yellow-100 text-yellow-700' }}">
                        {{ ucfirst($project->status) }}
                    </span>
                </td>
                <td>{{ $project->year }}</td>
                <td class="text-right space-x-2">
                    <a href="{{ route('admin.projects.edit', $project) }}"
                       class="text-blue-600 hover:underline">Edit</a>
                    <form method="POST"
                          action="{{ route('admin.projects.destroy', $project) }}"
                          class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
