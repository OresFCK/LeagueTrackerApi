<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Api\ApiResponse;
use App\Api\ApiSerializer;
use App\Api\ResponseCode;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Validator\Exception\ValidatorException;

class RegisterController extends AbstractController
{
    /**
     * @var entityManager
     */
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
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
}
