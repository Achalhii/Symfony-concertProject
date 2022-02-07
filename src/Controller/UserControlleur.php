<?php

namespace App\Controller;

use App\Entity\Rooms;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserControlleur extends AbstractController
{
    /**
     * Affiche les détails d'une salle
     *
     * @return Response
     * @Route("/profil/", name="my_account")
     */
    public function details(): Response
    {
        return $this->render('user/show.html.twig');
    }
    /**
     * Transforme un user en admin
     *
     * @return Response
     * @Route("/admin/{id}", name="admin")
     */
    public function admin(EntityManagerInterface $doctrine, User $user): Response
    {
        $user->setRoles(['ROLE_ADMIN']);
        $doctrine->persist($user);
        $doctrine->flush();
        return $this->render('user/show.html.twig');
    }

}