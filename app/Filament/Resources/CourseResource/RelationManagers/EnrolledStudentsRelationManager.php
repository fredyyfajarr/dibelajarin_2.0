<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EnrolledStudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'enrolledStudents';

    // Ganti nama label agar lebih ramah
    protected static ?string $title = 'Siswa Terdaftar';

    public function form(Form $form): Form
    {
        // Kita tidak butuh form di sini, biarkan kosong
        return $form->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('email'),
                TextColumn::make('pivot.created_at')->dateTime()->label('Tanggal Mendaftar'),
            ])
            ->filters([
                //
            ])
            // Kita nonaktifkan aksi membuat pendaftaran baru dari sini
            ->headerActions([])
            // Kita nonaktifkan aksi mengedit atau menghapus pendaftaran
            ->actions([])
            ->bulkActions([]);
    }
}
