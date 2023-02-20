<?php


namespace Actecnology\ModuloBasico\Block\Adminhtml;


class Subscription extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_subscription';
        $this->_blockGroup = 'Actecnology_ModuloBasico';
        $this->_headerText = __('Elemento Gnuxdar');
        $this->_addButtonLabel = __('Add News');
        parent::_construct();
    }
}