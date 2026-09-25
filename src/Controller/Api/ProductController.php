<?php

namespace App\Controller\Api;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use function count;

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

    #[Route('/api/products/{id}', methods: ["GET"])]
    public function show(Product $product): JsonResponse
    {
         return $this->json($product);
    }

    #[Route('/api/products', methods: ["POST"])]
    public function create(
        Request $request,
        EntityManagerInterface $em,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
    ): JsonResponse
    {
        $content = $request->getContent();

        $product = $serializer->deserialize($content, Product::class, 'json');

        $errors = $validator->validate($product);

        if (0 < count($errors)) {
            $error_messages = [];
            foreach ($errors as $error) {
                $error_messages[$error->getPropertyPath()] = $error->getMessage();
            }

            return $this->json(['errors' => $error_messages], Response::HTTP_BAD_REQUEST);
        }

        $em->persist($product);
        $em->flush();

        return $this->json($product, Response::HTTP_CREATED);
    }
}
