<?php

namespace App\Controller;

use App\Entity\Artists;
use App\Entity\Bands;
use App\Entity\Concerts;
use App\Form\BandsType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class BandController extends AbstractController
{
    /**
     * Affiche les détails d'un groupe
     *
     * @param ManagerRegistry $doctrine
     * @param Bands $band
     * @return Response
     * @Route("/band/{id}", name="band_show")
     */
    public function details(ManagerRegistry $doctrine, Bands $band): Response
    {
        $b = $doctrine->getRepository(Bands::class)->find($band);
        $nextConcert =  $doctrine->getRepository(Concerts::class)->getNextGroupConcert($band->getId());
        $AllArtist = [];
        foreach ( $band->getArtist() as $artist ){
            $AllArtist[count($AllArtist)] = $doctrine->getRepository(Artists::class)->find($artist);
        }
        return $this->render('band/show.html.twig', ['detailsBand' => $b,'ArtistArray' => $AllArtist,'nextConcert' => $nextConcert]);
    }

    /**
    * Affiche la liste des groupes
    *
    * @param ManagerRegistry $doctrine
    * @return Response
    * @Route("/bands", name="bands_list")
    */
    public function list(ManagerRegistry $doctrine): Response
    {
        $band = $doctrine->getRepository(Bands::class)->findAll();
        return $this->render('band/list.html.twig', ['listBand' => $band]);
    }

    /**
     * Créer un nouveau groupe
     * @param Request $request
     * @return Response
     * @Route("/bands/admin", name="band_create",methods={"GET","POST"}))
     * @isGranted("ROLE_ADMIN"))
     *
     */
    public function createConcert(Request $request): Response
    {
        $band = new Bands();
        $form = $this->createForm(BandsType::class, $band);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $band = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($band);
            $entityManager->flush();
            $this->addFlash('success', 'Votre groupe est crée!');
            return $this->redirectToRoute('bands_list');
        }
        return $this->render('band/new.html.twig', [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * Met à jour un groupe
     *
     * @Route("/band/edit/{id}", name="band_edit",methods={"GET","POST"}))
     * @isGranted("ROLE_ADMIN")
     */
    public function editConcert(Request $request, Bands $band): Response
    {
        $form = $this->createForm(BandsType::class, $band);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $show = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($band);
            $entityManager->flush();
            $this->addFlash('success', 'Votre groupe est à jour!');
            return $this->redirectToRoute('bands_list');
        }
        return $this->render('band/new.html.twig', [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * Supprime un groupe
     * @param Request $request
     * @param Bands $band
     *
     * @return Response
     * @Route("/bands/delete/{id}", name="band_delete",methods={"GET","POST"}))
     * @isGranted("ROLE_ADMIN"))
     */
    public function delete(Request $request, Bands $band): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($band);
        $entityManager->flush();
        return $this->redirectToRoute('bands_list');
    }
}