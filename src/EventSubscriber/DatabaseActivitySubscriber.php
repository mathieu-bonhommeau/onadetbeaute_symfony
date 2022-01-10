<?php

namespace App\EventSubscriber;

use App\Entity\Photo;
use App\Entity\Product;
use Doctrine\ORM\Events;
use App\Repository\PhotoRepository;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Filesystem\Filesystem;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;

class DatabaseActivitySubscriber implements EventSubscriberInterface
{
    private $photoDir;
    private $photoRepository;
    
    public function __construct($photoDir, PhotoRepository $photoRepository) 
    {
        $this->photoDir = $photoDir;
        $this->photoRepository = $photoRepository;
    }

    // this method can only return the event names; you cannot define a
    // custom method name to execute when each event triggers
    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postRemove,
            Events::postUpdate,
        ];
    }

    // callback methods must be called exactly like the events they listen to;
    // they receive an argument of type LifecycleEventArgs, which gives you access
    // to both the entity object of the event and the entity manager itself
    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->logActivity('persist', $args);
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $this->logActivity('remove', $args);
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $this->logActivity('update', $args);
    }

    private function logActivity(string $action, LifecycleEventArgs $args): void
    { 
        $entity = $args->getObject();

        if ($action === "remove" && $entity instanceof Photo) {
            // Add a try catch AND TEST
            unlink($this->photoDir . $entity->getPath());
        }
    }
}