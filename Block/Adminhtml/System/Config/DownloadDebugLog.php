<?php

declare(strict_types=1);

namespace Worldline\Payment\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class DownloadDebugLog extends Field
{
    /**
     * Retrieve HTML markup for given form element
     *
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element): string
    {
        $element = clone $element;
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return $this->_decorateRowHtml($element, $this->_getElementHtml($element));
    }

    /**
     * @return DownloadDebugLog
     */
    protected function _prepareLayout(): DownloadDebugLog
    {
        parent::_prepareLayout();
        $this->setTemplate('Worldline_Payment::config/form/field/downloaddebuglog.phtml');
        return $this;
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element): string
    {
        $originalData = $element->getOriginalData();
        $this->addData(
            [
                'label' => __($originalData['label']),
                'html_id' => $element->getHtmlId(),
                'ajax_url' => $this->_urlBuilder->getUrl('worldline/system_config/downloaddebuglog')
            ]
        );

        return $this->_toHtml();
    }
}
