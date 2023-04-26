<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function browseAction(?string $genre = null): Response
    {
        if ($genre !== null) {
            $genre = u(str_replace('-', ' ', $genre))->title(true);
        }
        return $this->render(
            'vinyl/browse.html.twig',
            [
                'genre' => $genre
            ]
        );
    }
}
