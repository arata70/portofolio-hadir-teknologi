<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->merge([
            'slug' => Str::slug((string) $request->input('slug')),
        ]);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:projects,slug'],
            'excerpt' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'technology' => ['nullable', 'string', 'max:255'],
            'year' => ['required', 'integer', 'digits:4', 'min:2000', 'max:2099'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
        ]);

        $thumbnail = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('projects', 'public');
        }

        Project::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'excerpt' => $validated['excerpt'],
            'description' => $validated['description'],
            'technology' => $validated['technology'] ?? null,
            'year' => $validated['year'],
            'status' => 'draft',
            'thumbnail' => $thumbnail,
        ]);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Project berhasil disimpan sebagai draft. Silakan review sebelum publish.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->merge([
            'slug' => Str::slug((string) $request->input('slug')),
        ]);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('projects', 'slug')->ignore($project->id),
            ],
            'excerpt' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'technology' => ['nullable', 'string', 'max:255'],
            'year' => ['required', 'integer', 'digits:4', 'min:2000', 'max:2099'],
            'status' => ['required', Rule::in(['draft', 'publish'])],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
        ]);

        $thumbnail = $project->thumbnail;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('projects', 'public');
        }

        $project->update([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'excerpt' => $validated['excerpt'],
            'description' => $validated['description'],
            'technology' => $validated['technology'] ?? null,
            'year' => $validated['year'],
            'status' => $validated['status'],
            'thumbnail' => $thumbnail,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Project berhasil diupdate.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return back()->with('success', 'Project berhasil dihapus.');
    }
}
