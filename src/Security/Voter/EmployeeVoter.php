<?php

namespace App\Security\Voter;

use App\Entity\Employee;
use Symfony\Component\Security\Core\User\UserInterface;

class EmployeeVoter extends AbstractEntityVoter
{
    protected function supports($attribute, $subject): bool
    {
        // Se asegura de que solo actúe sobre la entidad Employee y atributos correctos
        return $subject instanceof Employee && in_array($attribute, ['VIEW', 'EDIT', 'DELETE']);
    }

    protected function isAllowedEntity(UserInterface $user, object $subject): bool
    {
        // Para depuración: debería aparecer al hacer click en cualquier acción
        dump('🟢 Entró en EmployeeVoter::isAllowedEntity');

        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            return true; // los admins pueden todo
        }

        // Usuarios normales no pueden editar ni borrar
        return false;
    }
}
