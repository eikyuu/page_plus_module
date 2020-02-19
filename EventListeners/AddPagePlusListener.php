<?php

namespace PagePlus\EventListeners;

use PagePlus\PagePlus;
use PagePlus\Model\PagePlusQuery;
use PagePlus\Event\PagePlusEvent;
use PagePlus\Event\PagePlusEvents;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Core\HttpFoundation\Request;
use Thelia\Core\Event\Product\ProductEvent;
use Symfony\Component\HttpFoundation\RequestStack;
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
    protected $request;
    public function __construct(Request $request)
    {
      $this->request = $request;
    }
    
    public function notif(ProductEvent $event)
    {
        $request = $this->request;
        print_r($_POST);exit;
        $pagePlusProductId = $request->get('product_id');
        $pagePlus = PagePlusQuery::create()->findByProductId($pagePlusProductId);
        // si ca existe mise a jours
        
        for ($i=0; $i <= $count - 1; $i++ ) 
        {
            if(count($pagePlus) > 0) {
            
            }
            else {
                $newPagePlus = new PagePlus();
    
            }
        }   


    }
}
