<?php
/**
* This class has been generated by TheliaStudio
* For more information, see https://github.com/thelia-modules/TheliaStudio
*/

namespace PagePlus\Controller;

use PagePlus\Controller\Base\PagePlusController as BasePagePlusController;
use PagePlus\Model\PagePlusQuery;
use PagePlus\Model\PagePlusProductQuery;

/**
 * Class PagePlusController
 * @package PagePlus\Controller
 */
class PagePlusController extends BasePagePlusController
{
    public function deleteAjaxAction()
    {        
        $pagePlusProduct = PagePlusProductQuery::create()->findOneByPagePlusId($this->getRequest()->get('pagePlus'));
        $pagePlusProduct->delete();

        $pagePlus = PagePlusQuery::create()->findOneById($this->getRequest()->get('pagePlus'));
        $pagePlus->delete();

        echo "ok";exit;

    }
}
