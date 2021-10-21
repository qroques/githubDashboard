<?php

namespace App\Controller;

use App\Domain\Model\Contributor;
use Github\Api\Repo;
use Github\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContributorController extends AbstractController
{
    private Client $githubClient;

    public function __construct(Client $githubClient)
    {
        $this->githubClient = $githubClient;
    }

    #[Route('/contributors/{organization}', name: 'contributor')]
    public function index(string $organization): Response
    {
        /** @var Repo $repoClient */
        $repoClient = $this->githubClient->api('repo');
        $repositories = $repoClient->org($organization);
        /** @var array<string, Contributor> */
        $contributors = [];

        foreach ($repositories as $repository) {
            if ($repository['fork']) {
                continue;
            }
            $statistics = $repoClient->contributors($organization, $repository['name']);
            foreach ($statistics as $apiContributor) {
                dump($apiContributor);
                $login = $apiContributor['login'];
                $contributor = array_key_exists($login, $contributors) ? $contributors[$login] : new Contributor($login, $apiContributor['avatar_url'], $apiContributor['html_url']);
                $contributor->addContributions($apiContributor['contributions']);

                $contributors[$login] = $contributor;
            }
        }
        arsort($contributors);
        return $this->render('contributors/index.html.twig', [
            'organization' => $organization,
            'repositories' => $repositories,
            'contributors' => $contributors
        ]);
    }
}
