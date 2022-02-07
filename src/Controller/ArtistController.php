<?php

namespace App\Controller;

use App\Entity\Artists;
use App\Form\ArtistsType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ArtistController extends AbstractController
{
    /**
     * Affiche les détails d'un artist
     *
     * @param ManagerRegistry $doctrine
     * @param Artists $artist
     * @return Response
     * @Route("/artist/{id}", name="artist_show")
     */
    public function details(ManagerRegistry $doctrine, Artists $artist): Response
    {
        $a = $doctrine->getRepository(Artists::class)->find($artist);
        return $this->render('artist/show.html.twig', ['detailsArtist' => $a]);
    }

    /**
     * Affiche la liste des artistes
     *
     * @param ManagerRegistry $doctrine
     * @return Response
     * @Route("/artists", name="artists_list")
     */
    public function list(ManagerRegistry $doctrine): Response
    {
        $artiste = $doctrine->getRepository(Artists::class)->findAll();
        return $this->render('artist/list.html.twig', ['listArtist' => $artiste]);
    }

    /**
     * Créer un nouvel artiste
     * @param Request $request
     * @return Response
     * @Route("/artists/admin", name="artist_create",methods={"GET","POST"}))
     * @isGranted("ROLE_ADMIN"))
     *
     */
    public function createConcert(Request $request): Response
    {
        $artist = new Artists();
        $form = $this->createForm(ArtistsType::class, $artist);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $artist = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($artist);
            $entityManager->flush();
            $this->addFlash('success', 'Votre artiste est crée!');
            return $this->redirectToRoute('artists_list');
        }
        return $this->render('artist/new.html.twig', [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * Met à jour un groupe
     *
     * @Route("/artist/edit/{id}", name="artist_edit",methods={"GET","POST"}))
     * @isGranted("ROLE_ADMIN")
     */
    public function editConcert(Request $request, Artists $band): Response
    {
        $form = $this->createForm(ArtistsType::class, $band);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $show = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($band);
            $entityManager->flush();
            $this->addFlash('success', 'Votre artist est à jour!');
            return $this->redirectToRoute('artists_list');
        }
        return $this->render('artist/new.html.twig', [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * Supprime un artiste
     * @param Request $request
     * @param Artists $artist
     *
     * @return Response
     * @Route("/artists/delete/{id}", name="artist_delete",methods={"GET","POST"}))
     * @isGranted("ROLE_ADMIN"))
     */
    public function delete(Request $request, Artists $artist): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($artist);
        $entityManager->flush();
        return $this->redirectToRoute('artists_list');
    }

}