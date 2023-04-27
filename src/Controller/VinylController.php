<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Psr\Cache\CacheItemInterface;
use function Symfony\Component\String\u;

class VinylController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function homeAction(): Response
    {
        $tracks = [
            ['title' => 'Don\'t stop me now!', 'artist' => 'Queen'],
            ['title' => 'Schism', 'artist' => 'Tool'],
        ];

        return $this->render(
            'vinyl/home.html.twig',
            [
                'title' => 'Hello world!',
                'tracks' => $tracks,
            ]
        );
    }

    #[Route('/browse/{genre}', name: 'app_browse')]
    public function browseAction(HttpClientInterface $httpClient, CacheInterface $cache, ?string $genre = null): Response
    {
        if ($genre !== null) {
            $genre = u(str_replace('-', ' ', $genre))->title(true);
        }

        $mixes = $cache->get('mixes_data', function(CacheItemInterface $item) use ($httpClient) {
            $item->expiresAfter(5);
            $response = $httpClient->request('GET', 'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json');
            return $response->toArray();
        });

        return $this->render(
            'vinyl/browse.html.twig',
            [
                'genre' => $genre,
                'mixes' => $mixes,
            ]
        );
    }
}
