<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ItemRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Item;

class BuildController extends AbstractController
{
    /**
     * @var EntityManager
     */
    private $entityManager;

   /**
     * @var UserRepository
     */
    private $itemRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        ItemRepository $itemRepository,
    )
    {
        $this->entityManager = $entityManager;
        $this->itemRepository = $itemRepository;
    }
     /**
     * @Route("/api/addItem", methods={"POST"})
     */
    public function addItem(Request $request)
    {
        
        $requestData = json_decode($request->getContent(), true);
        $item = $this->itemRepository->findOneBy(['name' => $requestData['name']]);

        if (!$item) {
            $item = new Item();
            $item->setName($requestData['name']);
            $item->setPrice($requestData['price']);
        } else {
            return $this->json(['message' => 'Item is already in database']);
        }
        
        $this->entityManager->persist($item);
        $this->entityManager->flush();
        return $this->json(['message' => 'Item added successfully']);
    }
}
