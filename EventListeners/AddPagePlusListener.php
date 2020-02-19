<?php

namespace PagePlus\EventListeners;

use PagePlus\PagePlus;
use PagePlus\Model\PagePlusQuery;
use PagePlus\Event\PagePlusEvent;
use PagePlus\Event\PagePlusEvents;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Core\HttpFoundation\Request;
use Thelia\Core\Event\Product\ProductEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Core\Event\ProductSaleElement\ProductSaleElementEvent;

class AddPagePlusListener implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {

        return array(
            TheliaEvents::PRODUCT_UPDATE => array("notif", 100)

        );
    }

    public function notif(ProductEvent $event)
    {
        $pagePlus = new PagePlus();
        echo $pagePlus->getTitle;exit;
    }
}
