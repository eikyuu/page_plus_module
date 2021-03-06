<?php

namespace PagePlus\EventListeners;

use PagePlus\Event\PagePlusEvent;
use PagePlus\Model\PagePlusQuery;
use PagePlus\Event\PagePlusEvents;
use PagePlus\Model\PagePlusProduct;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Core\HttpFoundation\Request;
use PagePlus\Model\PagePlusProductQuery;
use PagePlus\Model\PagePlus;
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
        
        $count = count($request->get('page_plus_create')['title']);
        // si ca existe mise a jours
        
         
               $pagePlus = PagePlusProductQuery::create()->findByProductId($request->get('product_id'));
               if(count($pagePlus) == 0) {

                    for ($i=0; $i <= $count -1; $i++ ) 
                    {

                        $newPagePlus = new PagePlus();
                        $newPagePlus->setLocale('fr_FR');
                        $newPagePlus->setTitle($request->get('page_plus_create')['title'][$i]);
                        $newPagePlus->setDescription($request->get('page_plus_create')['description'][$i]);
                        $newPagePlus->setImage($_FILES['page_plus_create']['name']['image'][$i]);
                        $newPagePlus->setAlt($request->get('page_plus_create')['alt'][$i]);
                        $newPagePlus->save();

                        $filePath = "./media/pageplus/".$_FILES['page_plus_create']['name']['image'][$i];
                        move_uploaded_file($_FILES['page_plus_create']['tmp_name']['image'][$i], $filePath);


                        $pagePlusProduct = new PagePlusProduct();
                        $pagePlusProduct->setPagePlusId($newPagePlus->getId());
                        $pagePlusProduct->setProductId($request->get('product_id'));
                        $pagePlusProduct->save();
                    } 

                }
                else 
                {
                    $pagePlus = PagePlusProductQuery::create()->findByProductId($request->get('product_id'));

                    foreach($pagePlus as $pp)
                    {
                        $deletePagePlus = PagePlusQuery::create()->findOneById($pp->getPagePlusId());
                        $deletePagePlus->delete();

                        $pp->delete();
                    }

                    for ($i=0; $i <= $count -1; $i++ ) 
                    {
                       
                        $newPagePlus = new PagePlus();
                        $newPagePlus->setLocale('fr_FR');
                        $newPagePlus->setTitle($request->get('page_plus_create')['title'][$i]);
                        $newPagePlus->setDescription($request->get('page_plus_create')['description'][$i]);
                        $newPagePlus->setImage($request->get('page_plus_create')['name_image'][$i]);
                        $newPagePlus->setAlt($request->get('page_plus_create')['alt'][$i]);
                        $newPagePlus->save();
                        
                        $pagePlusProduct = new PagePlusProduct();
                        $pagePlusProduct->setPagePlusId($newPagePlus->getId());
                        $pagePlusProduct->setProductId($request->get('product_id'));
                        $pagePlusProduct->save();
                    }
                }  
    }
}
