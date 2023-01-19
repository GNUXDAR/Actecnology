<?php
 
 namespace Actecnology\HellorWorld\Setup;
 
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
 
class InstallData implements InstallDataInterface
{
	protected $_dataFactory;
 
	public function __construct(\Actecnology\HellorWorld\Model\postFactory $postFactory)
	{
		$this->_dataFactory = $postFactory;
	}
 
	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
        $data = [
			'name'         => "Bienvenidos al mundo del desarrollo de modulos de Magento2",
            'url_key'      => '/magento-2-module-development/wellcome.html',
			'post_content' => "En este articulo de prueba, le damos la bienvenida al desarrollo de modulos e integracion de magento, como sabemos magento2 es un sistema modular, en el cual desarrollaremos modulos necesarios para nuestro modelo de negocio.",
			'tags'         => 'magento 2,development',
            'featured_image'=> 'https://arturocabrera.com/img/slides/1.webp',
            'author'        =>  "@gnuxdar",
			'status'       => 1
		];
		$contact = $this->_dataFactory->create();
		$contact->addData($data)->save();
	}
}
