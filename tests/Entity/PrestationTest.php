<?php

namespace App\Tests;

use App\Entity\Photo;
use App\Entity\Prestation;
use PHPUnit\Framework\TestCase;

class PrestationTest extends TestCase
{
    private $prestation; 

    public function setUp(): void
    {
        $photo = new Photo();

        $this->prestation = (new Prestation())
            ->setName('Ongle')
            ->setDescription('Ullamco dolor dolore id magna cupidatat esse id esse reprehenderit sint ullamco voluptate anim labore. Aliquip deserunt consectetur dolore dolor. Minim laboris esse id veniam ad cillum officia sint labore cupidatat minim. Aliqua voluptate culpa sit esse laborum amet eu enim. Ipsum consectetur irure laboris id aliqua commodo excepteur enim id consectetur.')
            ->setPrice(12.52)
            ->setPhotoInPromote($photo)
            ->addPhoto($photo)
        ;
    }

    public function testPrestationCreate(): void
    {
        $prestation = new Prestation();
        $this->assertSame('App\Entity\Prestation', get_class($prestation));
    }

    public function testHydratePrestation(): void
    {
        $this->assertSame('Ongle', $this->prestation->getName());
        $this->assertSame(
            'Ullamco dolor dolore id magna cupidatat esse id esse reprehenderit sint ullamco voluptate anim labore. Aliquip deserunt consectetur dolore dolor. Minim laboris esse id veniam ad cillum officia sint labore cupidatat minim. Aliqua voluptate culpa sit esse laborum amet eu enim. Ipsum consectetur irure laboris id aliqua commodo excepteur enim id consectetur.',
            $this->prestation->getDescription()
        );
        $this->assertSame(12.52, $this->prestation->getPrice());
        $this->assertSame(
            Photo::class, 
            $this->prestation->getPhotoInPromote()::class
        );
        $this->assertSame(Photo::class, $this->prestation->getPhotos()[0]::class);
    }

    public function testBadName(): void
    {
        try {
            $this->prestation->setName('');
        } catch (\Exception $e) {
            $this->assertSame('Cet élément ne peut être vide', $e->getMessage());
        }
    }

    public function testBadPrice(): void
    {
        $this->prestation->setPrice(-20);
        $this->assertSame(20.0, $this->prestation->getPrice());
    }
}
