<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeviceResource\Pages;
use App\Models\Device;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Constants\DeviceConstants;
use Filament\Tables\Actions\Action;

class DeviceResource extends Resource
{
    protected static ?string $model = Device::class;

    protected static ?string $label = 'Equipamento';
    protected static ?string $pluralLabel = 'Equipamentos';

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações do Dispositivo')
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->label('Código do Equipamento')
                            ->maxLength(255)
                            ->disabled(),
                        Forms\Components\Select::make('device_type')
                            ->label('Tipo de Equipamento')
                            ->options(DeviceConstants::DEVICE_TYPES)
                            ->required(),
                        Forms\Components\TextInput::make('manufacturer')
                            ->label('Fabricante')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('model')
                            ->label('Modelo')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('serial_number')
                            ->label('Número de Série')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('cpu')
                            ->label('Processador')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('ram')
                            ->label('Memória RAM')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('storage')
                            ->label('Armazenamento')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('gpu')
                            ->label('Placa Gráfica')
                            ->maxLength(255),
                        Forms\Components\Select::make('operating_system')
                            ->label('Sistema Operacional')
                            ->options(DeviceConstants::OPERATING_SYSTEMS),
                        Forms\Components\TextInput::make('ip_address')
                            ->label('Endereço IP')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('mac_address')
                            ->label('Endereço MAC')
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('purchase_date')
                            ->label('Data de Compra')
                            ->date('d/m/Y') 
                            ->required(),
                        Forms\Components\DatePicker::make('warranty_expiration')
                            ->label('Vencimento da Garantia')
                            ->date('d/m/Y'), 
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options(DeviceConstants::STATUS),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Atribuição')
                    ->schema([
                        Forms\Components\Select::make('assigned_user_id')
                            ->label('Usuário Designado')
                            ->relationship('assignedUser', 'name')
                            ->searchable()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $user = \App\Models\User::find($state);
                                if ($user) {
                                    $set('department_id', $user->department_id);
                                }
                            }),

                        Forms\Components\Select::make('department_id')
                            ->label('Setor')
                            ->relationship('department', 'name')
                            ->disabled()
                            ->dehydrated(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\BadgeColumn::make('code')
                    ->label('Código')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('device_type')
                    ->label('Tipo')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('assignedUser.name')
                    ->label('Usuário')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department.name')
                    ->label('Setor')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->color(fn (string $state): string => DeviceConstants::STATUS_COLORS[$state] ?? 'gray')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('purchase_date')
                    ->label('Data da Compra')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('warranty_expiration')
                    ->label('Venc. da Garantia')
                    ->date('d/m/Y')
                    ->sortable()
                    ->color(function ($record) {
                        $diasRestantes = \Carbon\Carbon::now()->diffInDays($record->warranty_expiration, false);
                    
                        if ($diasRestantes <= 30) {
                            return 'danger'; 
                        } elseif ($diasRestantes <= 60) {
                            return 'warning';  
                        } else {
                            return 'default'; 
                        }
                    })
            ])

            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Editar Equipamento')
                    ->modalWidth('5xl')
                    ->extraModalFooterActions([
                        Tables\Actions\DeleteAction::make(),
                    ]),
            
                
                Tables\Actions\Action::make('gerar_etiqueta_pdf')
                    ->label('Etiq')
                    ->icon('heroicon-o-printer')
                    ->url(fn (Device $record) => route('devices.etiqueta.pdf', $record))
                    ->openUrlInNewTab(),
            ])
            
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDevices::route('/')
        ];
    }
}
