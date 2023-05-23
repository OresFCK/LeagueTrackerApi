<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;

class UserController extends AbstractController
{
   /**
     * @var EntityManager
     */
    private $entityManager;

   /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
    )
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
    }

   /**
     * @Route("/api/register", name="api_register", methods={"POST"})
     */
    public function register(Request $request)
    {
        
        $requestData = json_decode($request->getContent(), true);
        $user = new User();
        $user->setNickname($requestData['nickname']);
        $user->setEmail($requestData['email']);
        $user->setPassword($requestData['password']);


        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $this->json(['message' => 'User registered successfully']);
    }


    /**
     * @Route("/api/login", methods={"POST"})
     */
    public function login(Request $request): Response
    {

        $requestData = json_decode($request->getContent(), true);
        $user = $this->userRepository->findOneBy(['email' => $requestData['email']]);

        if (!$user) {
            throw new BadCredentialsException('Invalid username or password');
        }

        return $this->json(['message' => 'Login successful']);
    }
}
