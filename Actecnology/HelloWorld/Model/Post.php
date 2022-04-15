<?php
namespace Actecnology\HelloWorld\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'actecnology_helloworld_post';

	protected $_cacheTag = 'actecnology_helloworld_post';

	protected $_eventPrefix = 'actecnology_helloworld_post';

	protected function _construct()
	{
		$this->_init('Actecnology\HelloWorld\Model\ResourceModel\Post');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}