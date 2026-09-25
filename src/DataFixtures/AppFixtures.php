<?php

namespace App\DataFixtures;

use App\Entity\Product;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        $product->setName('Product One');
        $product->setSize(100);
        $product->setPublishedOn(new DateTime("2026-09-25"));

        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Product Two');
        $product->setSize(200);
        $product->setPublishedOn(new DateTime("2026-08-15"));

        $manager->persist($product);

        $manager->flush();
    }
}
