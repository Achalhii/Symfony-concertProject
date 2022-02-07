<?php

namespace App\Controller;

    use App\Entity\Rooms;
    use Doctrine\Persistence\ManagerRegistry;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

class RoomsController extends AbstractController
{
    /**
     * Affiche les détails d'une salle
     *
     * @param ManagerRegistry $doctrine
     * @param Rooms $room
     * @return Response
     * @Route("/room/{id}", name="room_show")
     */
    public function details(ManagerRegistry $doctrine, Rooms $room): Response
    {
        $room = $doctrine->getRepository(Rooms::class)->find($room);
        return $this->render('room/show.html.twig', ['detailsRoom' => $room]);
    }

    /**
     * Affiche la liste des salles
     *
     * @param ManagerRegistry $doctrine
     * @return Response
     * @Route("/rooms", name="room_list")
     */
    public function list(ManagerRegistry $doctrine): Response
    {
        $room = $doctrine->getRepository(Rooms::class)->findAll();
        return $this->render('room/list.html.twig', ['listRoom' => $room]);
    }
}