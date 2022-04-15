<?php
/*
El modelo de recopilación se considera un modelo de recursos que nos permite filtrar y obtener
 datos de una tabla de recopilación. El modelo de colección se colocará en:
 app/code/Actecnology/HelloWorld/Model/ResourceModel/Post/Collection.php

*/

namespace Actecnology\HelloWorld\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'post_id';
	protected $_eventPrefix = 'actecnology_helloworld_post_collection';
	protected $_eventObject = 'post_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Actecnology\HelloWorld\Model\Post', 'Actecnology\HelloWorld\Model\ResourceModel\Post');
	}

}