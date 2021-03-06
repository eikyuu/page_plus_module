<?php
/**
* This class has been generated by TheliaStudio
* For more information, see https://github.com/thelia-modules/TheliaStudio
*/

namespace PagePlus\Action\Base;

use PagePlus\Model\Map\PagePlusTableMap;
use PagePlus\Event\PagePlusEvent;
use PagePlus\Event\PagePlusEvents;
use PagePlus\Model\PagePlusQuery;
use PagePlus\Model\PagePlus;
use Thelia\Action\BaseAction;
use Thelia\Core\Event\ToggleVisibilityEvent;
use Thelia\Core\Event\UpdatePositionEvent;
use Propel\Runtime\Propel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Core\Event\TheliaEvents;
use \Thelia\Core\Event\TheliaFormEvent;

/**
 * Class PagePlusAction
 * @package PagePlus\Action
 * @author TheliaStudio
 */
class PagePlusAction extends BaseAction implements EventSubscriberInterface
{
    public function create(PagePlusEvent $event)
    {
        $this->createOrUpdate($event, new PagePlus());
    }

    public function update(PagePlusEvent $event)
    {
        $model = $this->getPagePlus($event);

        $this->createOrUpdate($event, $model);
    }

    public function delete(PagePlusEvent $event)
    {
        $this->getPagePlus($event)->delete();
    }

    protected function createOrUpdate(PagePlusEvent $event, PagePlus $model)
    {
        $con = Propel::getConnection(PagePlusTableMap::DATABASE_NAME);
        $con->beginTransaction();

        try {
            $model->setLocale($event->getLocale());

            if (null !== $id = $event->getId()) {
                $model->setId($id);
            }

            if (null !== $title = $event->getTitle()) {
                $model->setTitle($title);
            }

            if (null !== $description = $event->getDescription()) {
                $model->setDescription($description);
            }

            if (null !== $image = $event->getImage()) {
                $model->setImage($image);
            }

            if (null !== $alt = $event->getAlt()) {
                $model->setAlt($alt);
            }

            $model->save($con);

            $con->commit();
        } catch (\Exception $e) {
            $con->rollback();

            throw $e;
        }

        $event->setPagePlus($model);
    }

    protected function getPagePlus(PagePlusEvent $event)
    {
        $model = PagePlusQuery::create()->findPk($event->getId());

        if (null === $model) {
            throw new \RuntimeException(sprintf(
                "The 'page_plus' id '%d' doesn't exist",
                $event->getId()
            ));
        }

        return $model;
    }

    public function beforeCreateFormBuild(TheliaFormEvent $event)
    {
    }

    public function beforeUpdateFormBuild(TheliaFormEvent $event)
    {
    }

    public function afterCreateFormBuild(TheliaFormEvent $event)
    {
    }

    public function afterUpdateFormBuild(TheliaFormEvent $event)
    {
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return array(
            PagePlusEvents::CREATE => array("create", 128),
            PagePlusEvents::UPDATE => array("update", 128),
            PagePlusEvents::DELETE => array("delete", 128),
            TheliaEvents::FORM_BEFORE_BUILD . ".page_plus_create" => array("beforeCreateFormBuild", 128),
            TheliaEvents::FORM_BEFORE_BUILD . ".page_plus_update" => array("beforeUpdateFormBuild", 128),
            TheliaEvents::FORM_AFTER_BUILD . ".page_plus_create" => array("afterCreateFormBuild", 128),
            TheliaEvents::FORM_AFTER_BUILD . ".page_plus_update" => array("afterUpdateFormBuild", 128),
        );
    }
}
