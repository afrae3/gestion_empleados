<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AdminController extends EasyAdminController
{
    private $auth; // sin tipo

    public function __construct(AuthorizationCheckerInterface $auth)
    {
        $this->auth = $auth;
    }

    protected function editEntity($entity)
    {
        if (!$this->auth->isGranted('EDIT', $entity)) {
            throw new AccessDeniedException('No tienes permiso para editar este elemento.');
        }

        parent::editEntity($entity);
    }

    protected function deleteEntity($entity)
    {
        if (!$this->auth->isGranted('DELETE', $entity)) {
            throw new AccessDeniedException('No tienes permiso para eliminar este elemento.');
        }

        parent::deleteEntity($entity);
    }

    protected function showEntity($entity)
    {
        if (!$this->auth->isGranted('VIEW', $entity)) {
            throw new AccessDeniedException('No tienes permiso para ver este elemento.');
        }

        parent::showEntity($entity);
    }
}
