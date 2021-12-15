<?php

namespace App\EventSubscriber;

use App\Entity\Photo;
use App\Entity\Product;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;

class DatabaseActivitySubscriber implements EventSubscriberInterface
{
    private $photoDir;
    
    public function __construct($photoDir) 
    {
        $this->photoDir = $photoDir;
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