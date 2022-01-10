<?php

namespace App\Tests;

use App\Entity\Photo;
use App\Entity\PrestationType;
use PHPUnit\Framework\TestCase;

class PrestationTypeTest extends TestCase
{
    private $prestationType; 

    public function setUp(): void
    {
        $photo = new Photo();

        $this->prestationType = (new PrestationType())
            ->setName('Chablon en couleur')
            ->setDescription('Ullamco dolor dolore id magna cupidatat esse id esse reprehenderit sint ullamco voluptate anim labore. Aliquip deserunt consectetur dolore dolor. Minim laboris esse id veniam ad cillum officia sint labore cupidatat minim. Aliqua voluptate culpa sit esse laborum amet eu enim. Ipsum consectetur irure laboris id aliqua commodo excepteur enim id consectetur.')
            ->setPhotoInPromote($photo)
        ;
    }

    public function testPrestationTypeCreate(): void
    {
        $prestationType = new PrestationType();
        $this->assertSame('App\Entity\PrestationType', get_class($prestationType));
    }

    public function testHydratePrestationType(): void
    {
        $this->assertSame('Chablon en couleur', $this->prestationType->getName());
        $this->assertSame(
            'Ullamco dolor dolore id magna cupidatat esse id esse reprehenderit sint ullamco voluptate anim labore. Aliquip deserunt consectetur dolore dolor. Minim laboris esse id veniam ad cillum officia sint labore cupidatat minim. Aliqua voluptate culpa sit esse laborum amet eu enim. Ipsum consectetur irure laboris id aliqua commodo excepteur enim id consectetur.',
            $this->prestationType->getDescription()
        );
        $this->assertSame(
            Photo::class, 
            $this->prestationType->getPhotoInPromote()::class
        );
    }

    public function testBadName(): void
    {
        try {
            $this->prestationType->setName('');
        } catch (\Exception $e) {
            $this->assertSame('Cet élément ne peut être vide', $e->getMessage());
        }
    }
}
