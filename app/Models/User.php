<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Modelo que representa um usuário do sistema.
 *
 * Responsável pela autenticação, notificações e
 * gerenciamento dos dados do usuário.
 */
#[Fillable(['name', 'email', 'role', 'password'])]
// Define os atributos que podem ser preenchidos em massa (mass assignment).

#[Hidden(['password', 'remember_token'])]
// Oculta esses atributos quando o modelo é convertido para array ou JSON.
class User extends Authenticatable
{
    /**
     * Adiciona suporte a factories para geração de dados de teste
     * e permite o envio de notificações ao usuário.
     *
     * @use HasFactory<UserFactory>
     */
    use HasFactory, Notifiable;

    /**
     * Define as conversões automáticas (casts) dos atributos.
     *
     * - email_verified_at: converte para objeto DateTime.
     * - password: aplica hash automaticamente ao salvar.
     * - role: converte para o enum UserRole.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }
}
