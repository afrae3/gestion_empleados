<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
     #[Route('/', name: 'home')]
     public function index(Security $security)
     {
          //si el usuario no está logueado, redirige a login
          if (!$security->getUser()) {
               return $this->redirectToRoute('app_login');
          }

          //si YA está logueado, redirige al dashboard de admin
          return $this->redirectToRoute('easyadmin');
     }
}