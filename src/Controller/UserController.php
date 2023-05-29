<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use App\Api\ApiResponse;
use App\Api\ApiSerializer;
use App\Api\ResponseCode;
use Exception;
use Psr\Log\LoggerInterface;

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

    /**
     * @var LoggerInterface
     */
    private $logger;

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
        $apiResponse = new ApiResponse();
        $responseCode = 200;

        try {
            $requestData = json_decode($request->getContent(), true);
            $user = new User();
            $user->setNickname($requestData['nickname']);
            $user->setEmail($requestData['email']);
            $user->setPassword($requestData['password']);

            $apiResponse->setSuccess(true);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            
        } catch (Exception $ex) {

            $this->logger->error($ex->getMessage(), ['api_code' => Response::HTTP_INTERNAL_SERVER_ERROR]);
            $apiResponse->setMessage(ResponseCode::GENERAL_ERROR);
            $responseCode = 500;

        }
        
        return $this->json($apiResponse, $responseCode);
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
