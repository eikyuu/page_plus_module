<?php
/**
* This class has been generated by TheliaStudio
* For more information, see https://github.com/thelia-modules/TheliaStudio
*/

namespace PagePlus\Form\Base;

use PagePlus\Form\PagePlusCreateForm as ChildPagePlusCreateForm;
use PagePlus\Form\Type\PagePlusIdType;

/**
 * Class PagePlusForm
 * @package PagePlus\Form
 * @author TheliaStudio
 */
class PagePlusUpdateForm extends ChildPagePlusCreateForm
{
    const FORM_NAME = "page_plus_update";

    public function buildForm()
    {
        parent::buildForm();

        $this->formBuilder
            ->add("id", PagePlusIdType::TYPE_NAME)
        ;
    }
}
