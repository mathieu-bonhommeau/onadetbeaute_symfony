<?php

namespace App\EventSubscriber;

use App\Repository\OnadEtBeauteRepository;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Twig\Environment;

class BaseTwigEventSubscriber implements EventSubscriberInterface
{
    private $onadetbeauteRepository;
    private $twig;

    public function __construct(OnadEtBeauteRepository $onadetBeauteRepository, Environment $twig) {
        $this->onadetbeauteRepository = $onadetBeauteRepository;
        $this->twig = $twig;
    }

    public static function getSubscribedEvents()
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }

    public function onControllerEvent($event)
    {
        $this->twig->addGlobal('onadetbeauteDatas', $this->onadetbeauteRepository->findAll()[0]);
    }
}
