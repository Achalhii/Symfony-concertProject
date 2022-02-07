<?php

namespace App\Controller;

use App\Entity\Concerts;
use App\Form\ConcertsType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ConcertController extends AbstractController
{
    /**
     * Affiche les détails d'un concert
     *
     * @param ManagerRegistry $doctrine
     * @param Concerts $concert
     * @return Response
     * @Route("/concert/{id}", name="concert_show")
     */
    public function details(ManagerRegistry $doctrine, Concerts $concert): Response
    {
        $concert = $doctrine->getRepository(Concerts::class)->find($concert);
        return $this->render('concert/show.html.twig', ['detailsConcert' => $concert]);
    }

    /**
     * Affiche la liste des concerts
     *
     * @param ManagerRegistry $doctrine
     * @return Response
     * @Route("/concerts", name="concert_list")
     */
    public function list(ManagerRegistry $doctrine): Response
    {
        $concerts = $doctrine->getRepository(Concerts::class)->findAll();
        $concertNotPassed = [];
        foreach ($concerts as $concert) {
            if ($concert->getDate() > new \DateTime()) {
                $concertNotPassed[count($concertNotPassed)] = $concert;
            }
        }
        return $this->render('concert/list.html.twig', ['listConcerts' => $concertNotPassed, 'passed' => false]);
    }

    /**
     * Affiche la liste des concerts
     *
     * @param ManagerRegistry $doctrine
     * @return Response
     * @Route("/concertsPast", name="concertPast_list")
     */
    public function listPast(ManagerRegistry $doctrine): Response
    {
        $concerts = $doctrine->getRepository(Concerts::class)->findAll();
        $concertPassed = [];
        foreach ($concerts as $concert) {
            if ($concert->getDate() < new \DateTime()) {
                $concertPassed[count($concertPassed)] = $concert;
            }
        }
        return $this->render('concert/list.html.twig', ['listConcerts' => $concertPassed, 'passed' => true]);
    }

    /**
     * Créer un nouveau concert
     * @param Request $request
     * @return Response
     * @Route("/concerts/admin", name="concert_create",methods={"GET","POST"}))
     * @isGranted("ROLE_ADMIN"))
     *
     */
    public function createConcert(Request $request): Response
    {
        $concert = new Concerts();
        $form = $this->createForm(ConcertsType::class, $concert);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $concert = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concert);
            $entityManager->flush();
            $this->addFlash('success', 'Votre concert est crée!');
            return $this->redirectToRoute('concert_list');
        }
        return $this->render('concert/new.html.twig', [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * Met à jour un concert
     *
     * @Route("/concert/edit/{id}", name="concert_edit",methods={"GET","POST"}))
     * @isGranted("ROLE_ADMIN")
     */
    public function editConcert(Request $request, Concerts $concert): Response
    {
        $form = $this->createForm(ConcertsType::class, $concert);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $show = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concert);
            $entityManager->flush();
            $this->addFlash('success', 'Votre concert a été modifié');
            return $this->redirectToRoute('concert_list');
        }
        return $this->render('concert/new.html.twig', [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * Supprime un concert
     * @param Request $request
     * @param Concerts $concert
     *
     * @return Response
     * @Route("/concerts/delete/{id}", name="concert_delete",methods={"GET","POST"}))
     * @isGranted("ROLE_ADMIN"))
     */
    public function delete(Request $request, Concerts $concert): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($concert);
        $entityManager->flush();
        return $this->redirectToRoute('concert_list');
    }
}
