<?php
/**
* This class has been generated by TheliaStudio
* For more information, see https://github.com/thelia-modules/TheliaStudio
*/

namespace PagePlus\Controller\Base;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Thelia\Controller\Admin\AbstractCrudController;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Tools\URL;
use PagePlus\Event\PagePlusProductEvent;
use PagePlus\Event\PagePlusProductEvents;
use PagePlus\Model\PagePlusProductQuery;

/**
 * Class PagePlusProductController
 * @package PagePlus\Controller\Base
 * @author TheliaStudio
 */
class PagePlusProductController extends AbstractCrudController
{
    public function __construct()
    {
        parent::__construct(
            "page_plus_product",
            "id",
            "order",
            AdminResources::MODULE,
            PagePlusProductEvents::CREATE,
            PagePlusProductEvents::UPDATE,
            PagePlusProductEvents::DELETE,
            null,
            null,
            "PagePlus"
        );
    }

    /**
     * Return the creation form for this object
     */
    protected function getCreationForm()
    {
        return $this->createForm("page_plus_product.create");
    }

    /**
     * Return the update form for this object
     */
    protected function getUpdateForm($data = array())
    {
        if (!is_array($data)) {
            $data = array();
        }

        return $this->createForm("page_plus_product.update", "form", $data);
    }

    /**
     * Hydrate the update form for this object, before passing it to the update template
     *
     * @param mixed $object
     */
    protected function hydrateObjectForm($object)
    {
        $data = array(
            "id" => $object->getId(),
            "product_id" => $object->getProductId(),
            "page_plus_id" => $object->getPagePlusId(),
        );

        return $this->getUpdateForm($data);
    }

    /**
     * Creates the creation event with the provided form data
     *
     * @param mixed $formData
     * @return \Thelia\Core\Event\ActionEvent
     */
    protected function getCreationEvent($formData)
    {
        $event = new PagePlusProductEvent();

        $event->setProductId($formData["product_id"]);
        $event->setPagePlusId($formData["page_plus_id"]);

        return $event;
    }

    /**
     * Creates the update event with the provided form data
     *
     * @param mixed $formData
     * @return \Thelia\Core\Event\ActionEvent
     */
    protected function getUpdateEvent($formData)
    {
        $event = new PagePlusProductEvent();

        $event->setId($formData["id"]);
        $event->setProductId($formData["product_id"]);
        $event->setPagePlusId($formData["page_plus_id"]);

        return $event;
    }

    /**
     * Creates the delete event with the provided form data
     */
    protected function getDeleteEvent()
    {
        $event = new PagePlusProductEvent();

        $event->setId($this->getRequest()->request->get("page_plus_product_id"));

        return $event;
    }

    /**
     * Return true if the event contains the object, e.g. the action has updated the object in the event.
     *
     * @param mixed $event
     */
    protected function eventContainsObject($event)
    {
        return null !== $this->getObjectFromEvent($event);
    }

    /**
     * Get the created object from an event.
     *
     * @param mixed $event
     */
    protected function getObjectFromEvent($event)
    {
        return $event->getPagePlusProduct();
    }

    /**
     * Load an existing object from the database
     */
    protected function getExistingObject()
    {
        return PagePlusProductQuery::create()
            ->findPk($this->getRequest()->query->get("page_plus_product_id"))
        ;
    }

    /**
     * Returns the object label form the object event (name, title, etc.)
     *
     * @param mixed $object
     */
    protected function getObjectLabel($object)
    {
        return '';
    }

    /**
     * Returns the object ID from the object
     *
     * @param mixed $object
     */
    protected function getObjectId($object)
    {
        return $object->getId();
    }

    /**
     * Render the main list template
     *
     * @param mixed $currentOrder , if any, null otherwise.
     */
    protected function renderListTemplate($currentOrder)
    {
        $this->getParser()
            ->assign("order", $currentOrder)
        ;

        return $this->render("page-plus-products");
    }

    /**
     * Render the edition template
     */
    protected function renderEditionTemplate()
    {
        $this->getParserContext()
            ->set(
                "page_plus_product_id",
                $this->getRequest()->query->get("page_plus_product_id")
            )
        ;

        return $this->render("page-plus-product-edit");
    }

    /**
     * Must return a RedirectResponse instance
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function redirectToEditionTemplate()
    {
        $id = $this->getRequest()->query->get("page_plus_product_id");

        return new RedirectResponse(
            URL::getInstance()->absoluteUrl(
                "/admin/module/PagePlus/page_plus_product/edit",
                [
                    "page_plus_product_id" => $id,
                ]
            )
        );
    }

    /**
     * Must return a RedirectResponse instance
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function redirectToListTemplate()
    {
        return new RedirectResponse(
            URL::getInstance()->absoluteUrl("/admin/module/PagePlus/page_plus_product")
        );
    }
}
