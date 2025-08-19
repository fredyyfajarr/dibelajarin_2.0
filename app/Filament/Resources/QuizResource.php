<?php
namespace App\Filament\Resources;

use App\Filament\Resources\QuizResource\Pages;
use App\Models\Quiz;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;
    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationGroup = 'Content Management';
    // Sembunyikan dari navigasi utama
    // protected static bool $shouldRegisterNavigation = false;
    public static function shouldRegisterNavigation(): bool
    {
        // Hanya tampilkan item ini di navigasi jika user adalah admin
        return auth()->user()->role === 'admin';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('lesson_id')
                    ->relationship('lesson', 'title')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Repeater::make('questions')
                    ->relationship()
                    ->schema([
                        TextInput::make('question_text')->required()->columnSpanFull(),
                        Repeater::make('options')
                            ->schema([
                                TextInput::make('option')->required(),
                            ])
                            ->label('Pilihan Jawaban (A, B, C, ...)')
                            ->addActionLabel('Tambah Pilihan'),
                        TextInput::make('correct_answer')
                            ->label('Kunci Jawaban (contoh: A)')
                            ->required(),
                    ])
                    ->addActionLabel('Tambah Pertanyaan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizzes::route('/'),
            'create' => Pages\CreateQuiz::route('/create'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
        ];
    }
}
