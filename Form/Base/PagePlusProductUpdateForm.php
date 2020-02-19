<?php
/**
* This class has been generated by TheliaStudio
* For more information, see https://github.com/thelia-modules/TheliaStudio
*/

namespace PagePlus\Form\Base;

use PagePlus\Form\PagePlusProductCreateForm as ChildPagePlusProductCreateForm;
use PagePlus\Form\Type\PagePlusProductIdType;

/**
 * Class PagePlusProductForm
 * @package PagePlus\Form
 * @author TheliaStudio
 */
class PagePlusProductUpdateForm extends ChildPagePlusProductCreateForm
{
    const FORM_NAME = "page_plus_product_update";

    public function buildForm()
    {
        parent::buildForm();

        $this->formBuilder
            ->add("id", PagePlusProductIdType::TYPE_NAME)
        ;
    }
}
