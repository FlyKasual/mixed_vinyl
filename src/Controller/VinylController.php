<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use function Symfony\Component\String\u;

class VinylController extends AbstractController
{
    #[Route('/')]
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

    #[Route('/browse/{genre}')]
    public function browseAction(?string $genre = null): Response
    {
        $title = '';
        if ($genre !== null) {
            $title = u(str_replace('-', ' ', $genre))->title(true);
        }
        return new Response('Browse' . ($title ? ' ' . $title : ''));
    }
}
