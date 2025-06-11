<?php

namespace App\Filament\Pages;

use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Auth;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;

class AuthLogin extends BaseLogin
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('user_name')
                    ->label('Nome de Usuário')
                    ->required()
                    ->autocomplete('username'),

                TextInput::make('password')
                    ->label('Senha')
                    ->password()
                    ->required()
                    ->autocomplete('current-password'),
            ]);
    }

    public function authenticate(): ?LoginResponse
    {
        $credentials = $this->form->getState();

        if (Auth::attempt([
            'user_name' => $credentials['user_name'],
            'password' => $credentials['password'],
        ], $credentials['remember'] ?? false)) {
            session()->regenerate();

            return app(LoginResponse::class);
        }

        $this->addError('user_name', __('auth.failed'));

        return null;
    }
}
