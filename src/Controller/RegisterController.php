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

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

   /**
     * @Route("/api/register", name="api_register", methods={"POST"})
     */
    public function register(Request $request, ApiSerializer $serializer): JsonResponse
    {
        $apiResponse = new ApiResponse();
        $responseCode = 200;
        $requestData = json_decode($request->getContent(), true);

        /** co jesli uzytkownik o danym mailu/nickname jest zarejestrowany  */

        try {

            $user = new User();
            $user->setNickname($requestData['nickname']);
            $user->setEmail($requestData['email']);
            $user->setPassword($requestData['password']);
            
        } catch (\TypeError $ex) {
            $this->logger->error($ex->getMessage(), ['api_code' => 400]);
            $apiResponse->setMessage($ex->getMessage());
            $responseCode = 400;
        } catch (NotEncodableValueException $ex) {
            $this->logger->error($ex->getMessage(), ['api_code' => 400]);
            $apiResponse->setMessage($ex->getMessage());
            $responseCode = 400;
        } catch (ValidatorException $ex) {
            $this->logger->error($ex->getMessage(), ['api_code' => 400]);
            $apiResponse->setMessage($ex->getMessage());
            $responseCode = 400;
        } catch (\Exception $ex) {
            $this->logger->error($ex->getMessage(), ['api_code' => 500]);
            $apiResponse->setMessage(ResponseCode::GENERAL_ERROR);
            $responseCode = 500;
        }
        

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->json($apiResponse, $responseCode);
       
    }
}
