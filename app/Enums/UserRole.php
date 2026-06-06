<?php

namespace App\Enums;

/**
 * Enum responsável por representar os tipos de usuários do sistema.
 */
enum UserRole: string
{
    /** Administrador do sistema. */
    case ADMIN = 'admin';

    /** Usuário comum. */
    case USER = 'user';
}
