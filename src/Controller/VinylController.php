<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use function Symfony\Component\String\u;

class VinylController
{
    #[Route('/')]
    public function homeAction(): Response
    {
        return new Response('Hello world!');
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
