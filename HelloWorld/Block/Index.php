<?php
namespace Actecnology\HelloWorld\Block;
class Index extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
    {
        parent::__construct($context);
    }
 
    public function sayHello()
    {
        return __('<h2>Bienvenidos al Actecnologies.com</h2>');
    }
}