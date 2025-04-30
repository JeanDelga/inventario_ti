<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeviceUserHistoryResource\Pages;
use App\Models\DeviceUserHistory;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DeviceUserHistoryResource extends Resource
{
    protected static ?string $model = DeviceUserHistory::class;

    protected static ?string $label = 'Histórico Dispositivo X Usuário';
    protected static ?string $pluralLabel = 'Histórico Dispositivo X Usuário';

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Consultas';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                // Não precisa formulário
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('device.code')
                    ->label('Código do Dispositivo')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuário Designado')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('assigned_at')
                    ->label('Data de Atribuição')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('origin_user')
                    ->label('Criado por (ID)')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Se quiser filtros depois
            ])
            ->actions([
                // Sem ações de editar
            ])
            ->bulkActions([
                // Sem bulk actions
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDeviceUserHistories::route('/'),
            // Sem create, edit, view
        ];
    }
}
