<?php
namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class EntityVoter extends Voter
{
    protected function supports(string $attribute, mixed $subject): bool
    {
        return is_object($subject) && in_array($attribute, ['VIEW', 'EDIT', 'DELETE']);
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        dump($attribute, $subject, $user); // 🔥 Esto nos permitirá ver si llega aquí
        if (!$user instanceof UserInterface) {
            return false; // no logueado no puede
        }

        return match ($attribute) {
            'VIEW' => true,
            'EDIT', 'DELETE' => in_array('ROLE_ADMIN', $user->getRoles()),
            default => false,
        };
    }

}
