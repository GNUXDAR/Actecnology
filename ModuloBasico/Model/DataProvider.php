<?php


namespace Actecnology\ModuloBasico\Model;

use Actecnology\ModuloBasico\Model\ResourceModel\Subscription\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;
    // @codingStandardsIgnoreStart
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $subscriptionCollectionFactory,
        array $meta = [],
        array $data = []
    ){
        $this->collection = $subscriptionCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    // @codingStandardsIgnoreEnd
    public function getData()
    {
        if(isset($this->loadedData)){
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach($items as $_subscription){
            $this->loadedData[$_subscription->getId()] = $_subscription->getData();
        }
        return $this->loadedData;
    }

}