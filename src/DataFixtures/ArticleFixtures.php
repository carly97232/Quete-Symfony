<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 04/12/18
 * Time: 21:03
 */

namespace App\DataFixtures;

use Faker;
use App\Entity\Category;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $categories = $manager->getRepository(Category::class)->findBy([], [], 5);

        foreach ($categories as $category) {
            for ($i = 1; $i <= 10; $i++) {
                $article = new Article();
                $article->setTitle(mb_strtolower($faker->sentence()));
                $article->setContent($faker->paragraph);
                $manager->persist($article);
                $article->setCategory($category);
                $manager->flush();
            }
        }
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}
