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
            Events::preUpdate,
            Events::prePersist,
            Events::postPersist,
            Events::postRemove,
            Events::postUpdate,
        ];
    }

    // callback methods must be called exactly like the events they listen to;
    // they receive an argument of type LifecycleEventArgs, which gives you access
    // to both the entity object of the event and the entity manager itself
    public function prePersist(LifecycleEventArgs $args): void
    {
        $this->logActivity('prePersist', $args);
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $this->logActivity('preUpdate', $args);
    }

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
        
        if ($action === "prePersist" || $action === "preUpdate") {
            if ($entity instanceof Photo && $entity->getPrincipalPhoto() === true) {
                $this->checkPhoto($entity);
            }
        }

        if ($action === "remove" && $entity instanceof Photo) {
            // Add a try catch AND TEST
            unlink($this->photoDir . $entity->getPath());
        }
    }

    private function checkPhoto($entity) {
        
        $nbPrincipalPhotos = count($this->photoRepository->findBy(['principalPhoto' => true]));
        if ($nbPrincipalPhotos > 1) {
            throw new \Exception('Une photo principale est déjà définie');
        }

        $nbFrontPhotos = count($this->photoRepository->findBy(['frontPhoto' => true]));
        if ($nbFrontPhotos > 5) {
            throw new \Exception('Maximum 5 photos pour ce carroussel.');
        }

        $nbisMyWorksPhoto = count($this->photoRepository->findBy(['isMyWorksPhoto' => true]));
        if ($nbisMyWorksPhoto > 3) {
            throw new \Exception('Maximum 3 photos pour ce carroussel.');
        }
    }
}