<?php

namespace App\Tests;

use App\Entity\Photo;
use App\Entity\Prestation;
use App\Entity\PrestationType;
use PHPUnit\Framework\TestCase;

class PhotoTest extends TestCase
{
    private $photo; 

    public function setUp(): void
    {
        $prestationType = new PrestationType();
        $prestation = new Prestation();

        $this->photo = (new Photo())
            ->setPath('myPhoto.jpg')
            ->setFrontPhoto(true)
            ->setIsMyWorksPhoto(false)
            ->setPrestationType($prestationType)
            ->setPrestation($prestation)
        ;
    }

    public function testPhotoCreate(): void
    {
        $photo = new Photo();
        $this->assertSame('App\Entity\Photo', get_class($photo));
    }

    public function testHydratePhoto(): void
    {
        $this->assertSame('myPhoto.jpg', $this->photo->getPath());
        $this->assertSame(true, $this->photo->getFrontPhoto());
        $this->assertFalse(false, $this->photo->getIsMyWorksPhoto());
        $this->assertSame(PrestationType::class, $this->photo->getPrestationType()::class);
        $this->assertSame(Prestation::class, $this->photo->getPrestation()::class);
    }

    public function testBadPathPhoto(): void
    {
        try {
            $this->photo->setPath('');
        } catch (\Exception $e) {
            $this->assertSame('Cet élément ne peut être vide', $e->getMessage());
        }
    }
}
