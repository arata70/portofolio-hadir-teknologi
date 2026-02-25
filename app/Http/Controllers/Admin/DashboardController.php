<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $companyProfile = CompanyProfile::query()->firstOrCreate(
            [],
            CompanyProfile::defaultAttributes()
        );

        return view('admin.dashboard', [
            'totalProjects' => Project::count(),
            'draftCount'    => Project::where('status', 'draft')->count(),
            'publishCount'  => Project::where('status', 'publish')->count(),
            'companyProfile' => $companyProfile,
        ]);
    }

    public function updateCompanyProfile(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'about' => ['nullable', 'string'],
            'vision' => ['required', 'string'],
            'mission' => ['required', 'string'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'contact_instagram' => ['nullable', 'string', 'max:255'],
            'contact_address' => ['nullable', 'string', 'max:500'],
        ]);

        $companyProfile = CompanyProfile::query()->firstOrCreate(
            [],
            CompanyProfile::defaultAttributes()
        );

        $companyProfile->update($validated);

        return back()->with('success', 'Profil perusahaan berhasil diperbarui.');
    }
}
