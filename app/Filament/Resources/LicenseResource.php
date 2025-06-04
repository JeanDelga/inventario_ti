<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LicenseResource\Pages;
use App\Filament\Resources\LicenseResource\RelationManagers;
use App\Models\License;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LicenseResource extends Resource
{
    protected static ?string $model = License::class;

    protected static ?string $label = 'Licenças';
    protected static ?string $pluralLabel = 'Licenças';

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Cadastros';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações da Licença')
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->label('Chave de Licença')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('product_name')
                            ->label('Nome do Produto')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('version')
                            ->label('Versão')
                            ->required()
                            ->maxLength(50),
                        Forms\Components\Select::make('device_id')
                            ->label('Equipamento Associado')
                            ->relationship('device', 'code'),
                    ]),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Chave de Licença')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_name')
                    ->label('Nome do Produto')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('version')
                    ->label('Versão')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('device.code')
                    ->label('Código do Equipamento')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Editar Licença')
                    ->modalWidth('5xl')
                    ->extraModalFooterActions([
                        Tables\Actions\DeleteAction::make(),
                    ]),
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
            'index' => Pages\ListLicenses::route('/'),
        ];
    }
}
