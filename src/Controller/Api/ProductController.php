<?php

namespace App\Controller\Api;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

final class ProductController extends AbstractController
{
    #[Route('/api/products', methods: ["GET"])]
    public function index(
        EntityManagerInterface $em,
        SerializerInterface $serializer,
    ): JsonResponse
    {
        $products = $em->getRepository(Product::class)->findAll();

        $json_content = $serializer->serialize($products, 'json', [
            ObjectNormalizer::IGNORED_ATTRIBUTES => ['id'],
        ]);

        return JsonResponse::fromJsonString($json_content);
    }
}
