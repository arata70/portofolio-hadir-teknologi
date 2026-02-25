<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Project::query()
            ->orderByRaw("CASE WHEN status = 'draft' THEN 0 ELSE 1 END")
            ->latest()
            ->get();

        return view('admin.posts.index', compact('posts'));
    }

    public function publish(Project $project): RedirectResponse
    {
        if ($project->status === 'publish') {
            return back()->with('info', 'Project ini sudah berstatus publish.');
        }

        $project->update(['status' => 'publish']);

        return back()->with('success', 'Project berhasil dipublish ke halaman publik.');
    }
}
