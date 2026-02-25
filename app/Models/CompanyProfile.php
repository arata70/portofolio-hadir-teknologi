<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $fillable = [
        'company_name',
        'about',
        'vision',
        'mission',
        'contact_email',
        'contact_phone',
        'contact_instagram',
        'contact_address',
    ];

    public static function defaultAttributes(): array
    {
        return [
            'company_name' => 'Hadir Teknologi Nusantara',
            'about' => 'Hadir Teknologi Nusantara adalah perusahaan teknologi yang berfokus pada solusi digital modern dan berkelanjutan.',
            'vision' => 'Menjadi perusahaan teknologi terpercaya yang menghadirkan inovasi digital untuk mendorong pertumbuhan bisnis dan transformasi digital di Indonesia.',
            'mission' => "Mengembangkan solusi digital berkualitas tinggi\nMengutamakan kebutuhan dan kepuasan klien\nMenggunakan teknologi modern dan scalable\nMembangun sistem yang aman dan efisien",
            'contact_email' => 'info@hadirteknologi.id',
            'contact_phone' => '0812-3456-7890',
            'contact_instagram' => '@hadirteknologi',
            'contact_address' => 'Indonesia',
        ];
    }
}
