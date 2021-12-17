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
        $this->checkFrontPhoto($entity);
        $this->checkisMyWorksPhotoPhoto($entity);
    }
    
    public function setBlog(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();
        $this->checkPrincipalPhoto($entity);
        dump($entity);
        $this->checkFrontPhoto($entity);
        dump($entity);
        $this->checkisMyWorksPhotoPhoto($entity);
        dump($entity);
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

    private function checkFrontPhoto($entity) {
        $frontPhotos = $this->photoRepository->findBy(['frontPhoto' => true]);
        
        foreach ($frontPhotos as $photo) {
            if ($entity->getId() != $photo->getId()) {
                if ($entity->getFrontPhoto() === true && count($frontPhotos) > 4) {
                    $entity->setFrontPhoto(false);
                }
            }
        }
    }

    private function checkisMyWorksPhotoPhoto($entity) {
        $isMyWorksPhotos = $this->photoRepository->findBy(['isMyWorksPhoto' => true]);
        dump($isMyWorksPhotos);
        foreach ($isMyWorksPhotos as $photo) {
            if ($entity->getId() != $photo->getId()) {
                if ($entity->getIsMyWorksPhoto() === true && count($isMyWorksPhotos) > 2) {
                    dump($entity);
                    $entity->setIsMyWorksPhoto(false);
                }
            }
        }
    }
}