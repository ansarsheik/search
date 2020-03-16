<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->loadBasicData() as [$firstname, $lastname]) {
            $users = (new Users())->setFirstname($firstname)->setLastname($lastname);
            $manager->persist($users);
        }

        $manager->flush();
    }

    private function loadBasicData()
    {
        return [
            [ 'Simon','Wright' ],
            ['Brian','Camerons'],
            ['Carl','McGrath'],
            ['Evan','McLean'],
            ['Karen','Piper'],
            ['Joanne','Rees'],
            ['Richard','Glover'],
            ['Emily','Hunter'],
            ['Stewart','Vance'],
            ['James','Wright'],
            ['Paul','Stewart'],
            ['Molly','Randall'],
            ['Andrew','Slater'],
            ['Theresa','Allan'],
            ['Cameron','Abraham'],
            ['Rebecca','Davidson'],
        ];
    }

}
