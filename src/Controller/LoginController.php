<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;


class LoginController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var UserRepository
     */
    private $userRepoistory;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserRepository $userRepoistory,
    )
    {
        $this->entityManager = $entityManager;
        $this->userRepoistory = $userRepoistory;
    }

    /**
     * @Route("/api/login", methods={"POST"})
     */
    public function login(Request $request): Response
    {

        $requestData = json_decode($request->getContent(), true);
        $user = $this->userRepoistory->findOneBy(['email' => $requestData['email']]);

        if (!$user) {
            throw new BadCredentialsException('Invalid username or password');
        }

        return $this->json(['message' => 'Login successful']);
    }
}