<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class TestController extends AbstractController
{
    /**
     * @Route("/api/example", name="example_endpoint")
     */
    public function example()
    {
        $data = [
            'message' => 'Hello from Symfony!',
        ];

        return new JsonResponse($data);
    }
}
