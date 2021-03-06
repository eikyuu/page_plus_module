<?php
/**
* This class has been generated by TheliaStudio
* For more information, see https://github.com/thelia-modules/TheliaStudio
*/

namespace PagePlus\Event\Base;

use PagePlus\Event\Module\PagePlusEvents as ChildPagePlusEvents;

/*
 * Class PagePlusEvents
 * @package PagePlus\Event\Base
 * @author TheliaStudio
 */
class PagePlusEvents
{
    const CREATE = ChildPagePlusEvents::PAGE_PLUS_CREATE;
    const UPDATE = ChildPagePlusEvents::PAGE_PLUS_UPDATE;
    const DELETE = ChildPagePlusEvents::PAGE_PLUS_DELETE;
}
