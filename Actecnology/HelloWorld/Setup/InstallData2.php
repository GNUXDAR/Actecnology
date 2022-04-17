<?php
namespace Actecnology\HellorWorld\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /**
           * Install messages
           */
          $data = [
			'name'         => "Bienvenidos al mundo del desarrollo de modulos de Magento2",
            'url_key'      => '/magento-2-module-development/wellcome.html',
			'post_content' => "En este articulo de prueba, le damos la bienvenida al desarrollo de modulos e integracion de magento, como sabemos magento2 es un sistema modular, en el cual desarrollaremos modulos necesarios para nuestro modelo de negocio.",
			'tags'         => 'magento 2,development',
            'featured_image'=> 'https://arturocabrera.com/img/slides/1.webp',
            'author'        =>  "@gnuxdar",
			'status'       => 1
		];
        foreach ($data as $bind) {
            $setup->getConnection()
              ->insertForce($setup->getTable('actecnology_helloworld_post'), $bind);
        }
    }
}