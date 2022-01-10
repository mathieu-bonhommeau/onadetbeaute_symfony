<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Repository\PhotoRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeCrudActionEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EasyAdminUserSubscriber implements EventSubscriberInterface
{
    private $hash;

    public function __construct(UserPasswordHasherInterface $passwordHasher) {
        $this->hash = $passwordHasher;
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
           $entity = $this->hashPassword($entity); 
        }
    }
    
    public function beforeUpdate(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof User) {
           $entity = $this->hashPassword($entity); 
        }
    }

    private function hashPassword(User $user): User
    {
        return $user->setPassword(
                $this->hash->hashPassword(
                    $user,
                    $user->getPassword()
                )
            );
    }
}