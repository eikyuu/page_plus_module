<?php

namespace PagePlus\EventListener;

use PagePlus\PagePlus;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Core\Event\Cart\CartEvent as TheliaCartEvent;
use Thelia\Core\Event\TheliaEvents;


class AddProductListener implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {

        return array(
            TheliaEvents::AFTER_CARTADDITEM => array("notif", 300)

        );
    }

    public function notif()
    {
            echo "toto";
    }
}
