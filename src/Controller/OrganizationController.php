<?php

namespace App\Controller;

    use App\Entity\Organizations;
    use Doctrine\Persistence\ManagerRegistry;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

class OrganizationController extends AbstractController
{
    /**
     * Affiche les détails d'une organisation
     *
     * @param ManagerRegistry $doctrine
     * @param Organizations $organization
     * @return Response
     * @Route("/organization/{id}", name="organization_show")
     */
    public function details(ManagerRegistry $doctrine, Organizations $organization): Response
    {
        $organization = $doctrine->getRepository(Organizations::class)->find($organization);
        return $this->render('organization/show.html.twig', ['detailsOrganization' => $organization]);
    }

    /**
     * Affiche la liste des organisations
     *
     * @param ManagerRegistry $doctrine
     * @return Response
     * @Route("/organizations", name="organization_list")
     */
    public function list(ManagerRegistry $doctrine): Response
    {
        $organization = $doctrine->getRepository(Organizations::class)->findAll();
        return $this->render('organization/list.html.twig', ['listOrganization' => $organization]);
    }
}