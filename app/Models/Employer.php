<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employer extends Model
{
    /** @use HasFactory<\Database\Factories\EmployerFactory> */
    use HasFactory;

    public const DEFAULT_LOGO = 'employers.png';

    protected static function booted(): void
    {
        static::saving(function (Employer $employer): void {
            if (trim((string) $employer->logo) === '') {
                $employer->logo = self::DEFAULT_LOGO;
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function logoUrl(int $size = 56): string
    {
        $logo = trim((string) $this->logo);

        if ($logo !== '') {
            if (str_starts_with($logo, 'http://') || str_starts_with($logo, 'https://') || str_starts_with($logo, 'data:')) {
                return $logo;
            }

            if (str_starts_with($logo, '/')) {
                return asset(ltrim($logo, '/'));
            }

            if (file_exists(public_path($logo))) {
                return asset($logo);
            }

            if (file_exists(public_path('images/employers/' . $logo))) {
                return asset('images/employers/' . $logo);
            }
        }

        return asset('images/employers/' . self::DEFAULT_LOGO);
    }
}
