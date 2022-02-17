<?php

namespace App\EventSubscriber;

use App\Entity\Photo;
use App\Repository\PhotoRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeCrudActionEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class EasyAdminPhotoSubscriber implements EventSubscriberInterface
{
    private $photoRepository;
    
    public function __construct($photoDir, PhotoRepository $photoRepository) 
    {
        $this->photoRepository = $photoRepository;
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
        if ($entity instanceof Photo) {
            $entity->setDate(new \DateTime('now'));
            $this->checkPrincipalPhoto($entity);
        }
    }
    
    public function beforeUpdate(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof Photo) {
            $this->checkPrincipalPhoto($entity);
        }
    }

    private function checkPrincipalPhoto($entity) {
        $principalPhotos = $this->photoRepository->findBy(['principalPhoto' => true]);
        
        foreach ($principalPhotos as $photo) {
            if ($entity->getId() != $photo->getId()) {
                if ($entity->getPrincipalPhoto() === true && count($principalPhotos) > 0) {
                    $entity->setPrincipalPhoto(false);
                }
            }
        }
    }
}