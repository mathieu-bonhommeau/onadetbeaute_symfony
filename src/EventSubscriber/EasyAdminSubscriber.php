<?php
# src/EventSubscriber/EasyAdminSubscriber.php
namespace App\EventSubscriber;

use App\Repository\PhotoRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $photoRepository;
    
    public function __construct($photoDir, PhotoRepository $photoRepository) 
    {
        $this->photoRepository = $photoRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setBlogPostSlug'],
            BeforeEntityUpdatedEvent::class => ['setBlog']
        ];
    }

    public function setBlogPostSlug(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        $this->checkPrincipalPhoto($entity);
    }
    
    public function setBlog(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();
        $this->checkPrincipalPhoto($entity);
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