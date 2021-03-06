<?php
/**
* This class has been generated by TheliaStudio
* For more information, see https://github.com/thelia-modules/TheliaStudio
*/

namespace PagePlus\Form\Type\Base;

use Thelia\Core\Form\Type\Field\AbstractIdType;
use PagePlus\Model\PagePlusQuery;

/**
 * Class PagePlus
 * @package PagePlus\Form\Base
 * @author TheliaStudio
 */
class PagePlusIdType extends AbstractIdType
{
    const TYPE_NAME = "page_plus_id";

    protected function getQuery()
    {
        return new PagePlusQuery();
    }

    public function getName()
    {
        return static::TYPE_NAME;
    }
}
