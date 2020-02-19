<?php
/**
* This class has been generated by TheliaStudio
* For more information, see https://github.com/thelia-modules/TheliaStudio
*/

namespace PagePlus\Loop\Base;

use Propel\Runtime\ActiveQuery\Criteria;
use Thelia\Core\Template\Element\BaseI18nLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
use Thelia\Type\BooleanOrBothType;
use PagePlus\Model\PagePlusQuery;

/**
 * Class PagePlus
 * @package PagePlus\Loop\Base
 * @author TheliaStudio
 */
class PagePlus extends BaseI18nLoop implements PropelSearchLoopInterface
{

    /**
     * @param LoopResult $loopResult
     *
     * @return LoopResult
     */
    public function parseResults(LoopResult $loopResult)
    {
        /** @var \PagePlus\Model\PagePlus $entry */
        foreach ($loopResult->getResultDataCollection() as $entry) {
            $row = new LoopResultRow($entry);

            $row
                ->set("ID", $entry->getId())
                ->set("TITLE", $entry->getVirtualColumn("i18n_TITLE"))
                ->set("DESCRIPTION", $entry->getVirtualColumn("i18n_DESCRIPTION"))
                ->set("IMAGE", $entry->getVirtualColumn("i18n_IMAGE"))
                ->set("ALT", $entry->getVirtualColumn("i18n_ALT"))
            ;

            $this->addMoreResults($row, $entry);

            $loopResult->addRow($row);
        }

        return $loopResult;
    }

    /**
     * Definition of loop arguments
     *
     * example :
     *
     * public function getArgDefinitions()
     * {
     *  return new ArgumentCollection(
     *
     *       Argument::createIntListTypeArgument('id'),
     *           new Argument(
     *           'ref',
     *           new TypeCollection(
     *               new Type\AlphaNumStringListType()
     *           )
     *       ),
     *       Argument::createIntListTypeArgument('category'),
     *       Argument::createBooleanTypeArgument('new'),
     *       ...
     *   );
     * }
     *
     * @return \Thelia\Core\Template\Loop\Argument\ArgumentCollection
     */
    protected function getArgDefinitions()
    {
        return new ArgumentCollection(
            Argument::createIntListTypeArgument("id"),
            Argument::createAnyTypeArgument("title"),
            Argument::createAnyTypeArgument("image"),
            Argument::createAnyTypeArgument("alt"),
            Argument::createEnumListTypeArgument(
                "order",
                [
                    "id",
                    "id-reverse",
                    "title",
                    "title-reverse",
                    "description",
                    "description-reverse",
                    "image",
                    "image-reverse",
                    "alt",
                    "alt-reverse",
                ],
                "id"
            )
        );
    }

    /**
     * this method returns a Propel ModelCriteria
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function buildModelCriteria()
    {
        $query = new PagePlusQuery();
        $this->configureI18nProcessing($query, ["TITLE", "DESCRIPTION", "IMAGE", "ALT", ]);

        if (null !== $id = $this->getId()) {
            $query->filterById($id);
        }

        if (null !== $title = $this->getTitle()) {
            $title = array_map("trim", explode(",", $title));
            $query->filterByTitle($title);
        }

        if (null !== $image = $this->getImage()) {
            $image = array_map("trim", explode(",", $image));
            $query->filterByImage($image);
        }

        if (null !== $alt = $this->getAlt()) {
            $alt = array_map("trim", explode(",", $alt));
            $query->filterByAlt($alt);
        }

        foreach ($this->getOrder() as $order) {
            switch ($order) {
                case "id":
                    $query->orderById();
                    break;
                case "id-reverse":
                    $query->orderById(Criteria::DESC);
                    break;
                case "title":
                    $query->addAscendingOrderByColumn("i18n_TITLE");
                    break;
                case "title-reverse":
                    $query->addDescendingOrderByColumn("i18n_TITLE");
                    break;
                case "description":
                    $query->addAscendingOrderByColumn("i18n_DESCRIPTION");
                    break;
                case "description-reverse":
                    $query->addDescendingOrderByColumn("i18n_DESCRIPTION");
                    break;
                case "image":
                    $query->addAscendingOrderByColumn("i18n_IMAGE");
                    break;
                case "image-reverse":
                    $query->addDescendingOrderByColumn("i18n_IMAGE");
                    break;
                case "alt":
                    $query->addAscendingOrderByColumn("i18n_ALT");
                    break;
                case "alt-reverse":
                    $query->addDescendingOrderByColumn("i18n_ALT");
                    break;
            }
        }

        return $query;
    }

    protected function addMoreResults(LoopResultRow $row, $entryObject)
    {
    }
}
