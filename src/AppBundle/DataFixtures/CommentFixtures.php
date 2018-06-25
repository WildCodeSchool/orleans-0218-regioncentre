<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 24/06/18
 * Time: 14:57
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $commentOneSheetOne = new Comment();
        $commentTwoSheetOne = new Comment();
        $commentOneSheetTwo = new Comment();
        $commentTwoSheetTwo = new Comment();

        $commentOneSheetOne->setContent("lorem ipsum short comment");
        $commentOneSheetOne->setSheet($this->getReference('sheet'));
        $commentOneSheetOne->setUser($this->getReference('admin'));
        $commentOneSheetOne->setDate(new \DateTime(2018-06-29));

        $commentTwoSheetOne->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit.
         Nulla eu dolor erat. Suspendisse quis lectus risus. Interdum et malesuada fames ac ante ipsum primis
          in faucibus. Integer mollis placerat aliquet. In hac habitasse platea dictumst. Etiam lacus metus,
           ullamcorper vitae tellus quis, volutpat accumsan neque. In hac habitasse platea dictumst. Suspendisse
            eget tellus in felis convallis posuere. Praesent a porttitor purus. Etiam sit amet egestas justo.
             Proin ut pharetra purus. Donec pellentesque elit vitae aliquet iaculis. Vestibulum augue libero,
              elementum ac pulvinar vel, tincidunt vitae augue. Ut a arcu volutpat, aliquet justo non, dignissim odio.
              Etiam eu ultrices risus. Vivamus fringilla, risus quis fermentum dapibus, leo arcu porttitor velit,
             quis imperdiet turpis erat quis nulla. Vestibulum iaculis et nunc vel semper. Curabitur fringilla viverra
              justo, sed lacinia sapien dignissim a. Ut feugiat tortor et enim rhoncus mollis. Proin tempus porta urna,
               at sagittis ligula pulvinar a. Fusce molestie, est ut eleifend accumsan, mi ex pretium ligula,
                vitae molestie mi est ac magna. Sed tempor euismod ultricies. Curabitur pellentesque venenatis mauris,
                 id semper tellus blandit ac. Pellentesque ornare sem ut justo feugiat pulvinar. Morbi lobortis
                  tristique sapien ut pharetra. Aenean eget lacinia justo. Proin dignissim risus eget
                   imperdiet bibendum. Phasellus tincidunt. long comment");
        $commentTwoSheetOne->setSheet($this->getReference('sheet'));
        $commentTwoSheetOne->setUser($this->getReference('lycee'));
        $commentTwoSheetOne->setDate(new \DateTime(2018-06-30));

        $commentOneSheetTwo->setContent("lorem ipsum short comment");
        $commentOneSheetTwo->setSheet($this->getReference('sheetTwo'));
        $commentOneSheetTwo->setUser($this->getReference('emop'));
        $commentOneSheetTwo->setDate(new \DateTime(2018-06-28));

        $commentTwoSheetTwo->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
        Nulla eu dolor erat. Suspendisse quis lectus risus. Interdum et malesuada fames ac ante ipsum primis 
        in faucibus. Integer mollis placerat aliquet. In hac habitasse platea dictumst. Etiam lacus metus, 
        ullamcorper vitae tellus quis, volutpat accumsan neque. In hac habitasse platea dictumst. Suspendisse 
        eget tellus in felis convallis posuere. Praesent a porttitor purus. Etiam sit amet egestas justo. Proin 
        ut pharetra purus. Donec pellentesque elit vitae aliquet iaculis. Vestibulum augue libero, elementum ac 
        pulvinar vel, tincidunt vitae augue. Ut a arcu volutpat, aliquet justo non, dignissim odio. medium comment");
        $commentTwoSheetTwo->setSheet($this->getReference('sheetTwo'));
        $commentTwoSheetTwo->setUser($this->getReference('lycee'));
        $commentTwoSheetTwo->setDate(new \DateTime(2018-07-01));
    }

    public function getDependencies()
    {
        return [
            SheetFixtures::class,
            UserFixtures::class,
        ];
    }
}