<?php

namespace App\Controller;

use Github\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrganizationController extends AbstractController
{
    private Client $githubClient;

    public function __construct(Client $githubClient)
    {
        $this->githubClient = $githubClient;
    }
    #[Route('/organization', name: 'organization')]
    public function index(): Response
    {
        dump($this->githubClient->api('organizations')->show('KnpLabs'));
        return $this->render('organization/index.html.twig', [
            'controller_name' => 'OrganizationController',
        ]);
    }
}
