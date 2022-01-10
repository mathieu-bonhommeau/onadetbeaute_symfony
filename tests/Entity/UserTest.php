<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;

    private $methods;

    protected function setUp(): void
    {
        $this->user = (new User())
            ->setEmail('email@test.com')
            ->setRoles([])
            ->setPassword('password')
            ->setFirstname('prenom')
            ->setLastname('nom')
            ->setAddress('mon adresse à Paris')
            ->setPhone('01.23.45.56.78')
            ->setSiret('0123456789')
            ->setAboutMe('A propos de moi')
            ->setAboutMyActivity('A propos de mon activité')
            ->setPhotosWhoIam(['photo1', 'photo2', 'photo3'])
        ;

        $this->methods = [
            'Password',
            'Firstname',
            'Lastname',
            'Address',
            'Phone',
            'AboutMe',
            'AboutMyActivity'
        ];
    }

    public function testCreateUser(): void
    {
        $user = new User();
        $this->assertSame('App\Entity\User', get_class($user));
    }

    public function testHydrateUser(): void
    {
        $this->assertSame('email@test.com', $this->user->getEmail());
        $this->assertSame(['ROLE_USER'], $this->user->getRoles());
        $this->assertSame('password', $this->user->getPassword());
        $this->assertSame('prenom', $this->user->getFirstname());
        $this->assertSame('nom', $this->user->getLastname());
        $this->assertSame('mon adresse à Paris', $this->user->getAddress());
        $this->assertSame('01.23.45.56.78', $this->user->getPhone());
        $this->assertSame('0123456789', $this->user->getSiret());
        $this->assertSame('A propos de moi', $this->user->getAboutMe());
        $this->assertSame('A propos de mon activité', $this->user->getAboutMyActivity());
        $this->assertSame(['photo1', 'photo2', 'photo3'], $this->user->getPhotosWhoIam());
    }

    public function testBadEmail()
    {
        try {
            $this->user->setEmail('badEmail');
        } catch (\Exception $e) {
            $this->assertSame("Cet email n'est pas valide", $e->getMessage());
        }
        try {
            $this->user->setEmail('http:/test@test.com');
        } catch (\Exception $e) {
            $this->assertSame("Cet email n'est pas valide", $e->getMessage());
        }
        try {
            $this->user->setEmail('http://test@test.c');
        } catch (\Exception $e) {
            $this->assertSame("Cet email n'est pas valide", $e->getMessage());
        } 
    }

    public function testBadMethod(): void
    {
        foreach ($this->methods as $method) {
            $method = 'set' . $method;
            try {
                $this->user->$method('');
            } catch (\Exception $e) {
                $this->assertSame('Cet élément ne peut être vide', $e->getMessage());
            }
        }
    }

    public function testBadPhotosWhoIam()
    {
        try {
            $this->user->setPhotosWhoIam([]);
        } catch (\Exception $e) {
            $this->assertSame('Cet élément ne peut être vide', $e->getMessage());
        }
        
    }
    
}
