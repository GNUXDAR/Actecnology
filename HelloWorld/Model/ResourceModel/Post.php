<?php
/**
 * Actecnology
 * Como sabe, el archivo modelo contiene la lógica general de la base de datos, no ejecuta consultas sql. El modelo de recursos hará eso.

*/

namespace Actecnology\HelloWorld\Model\ResourceModel;


class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
        /*
        Al igual que la clase de modelo, esta clase de modelo de recurso tendrá el método requerido _construct(). 
        Este método llamará a la función _init() para definir el nombre de la tabla y la clave principal para esa tabla. 
        En este ejemplo, tenemos la tabla actecnology_helloworld_post y la clave principal post_id.
        */
		$this->_init('actecnology_helloworld_post', 'post_id');
	}
	
}