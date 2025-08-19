<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Kursus', Course::count())
                ->description('Jumlah semua kursus yang tersedia')
                ->icon('heroicon-o-academic-cap')
                ->color('success'),

            Stat::make('Total Siswa', User::where('role', 'student')->count())
                ->description('Jumlah semua pengguna dengan peran siswa')
                ->icon('heroicon-o-user-group')
                ->color('info'),

            Stat::make('Total Instruktur', User::where('role', 'instructor')->count())
                ->description('Jumlah semua pengguna dengan peran instruktur')
                ->icon('heroicon-o-user-circle')
                ->color('warning'),
        ];
    }
}
