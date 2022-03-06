<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Entity\OnadEtBeaute;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class EasyAdminUserSubscriber implements EventSubscriberInterface
{
    private $userHash;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher) 
    {
        $this->userHash = $userPasswordHasher;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['beforePersist'],
            BeforeEntityUpdatedEvent::class => ['beforeUpdate']
        ];
    }

    public function beforePersist(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof User) {
            $entity = $this->hashUserPassword($entity); 
        }
    }
    
    public function beforeUpdate(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof User) {
            $entity = $this->hashUserPassword($entity); 
        }
    }

    private function hashUserPassword(User $user): User
    {
        return $user->setPassword(
            $this->userHash->hashPassword(
                $user,
                $user->getPassword()
            )
        );
    }
}