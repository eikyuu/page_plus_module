<?php
/**
* This class has been generated by TheliaStudio
* For more information, see https://github.com/thelia-modules/TheliaStudio
*/

namespace PagePlus\Form\Type\Base;

use Thelia\Core\Form\Type\Field\AbstractIdType;
use PagePlus\Model\PagePlusProductQuery;

/**
 * Class PagePlusProduct
 * @package PagePlus\Form\Base
 * @author TheliaStudio
 */
class PagePlusProductIdType extends AbstractIdType
{
    const TYPE_NAME = "page_plus_product_id";

    protected function getQuery()
    {
        return new PagePlusProductQuery();
    }

    public function getName()
    {
        return static::TYPE_NAME;
    }
}
