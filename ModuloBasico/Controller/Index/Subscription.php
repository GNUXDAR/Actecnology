<?php


namespace Actecnology\ModuloBasico\Controller\Index;


class Subscription extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $subscription = $this->_objectManager->create('Actecnology\ModuloBasico\Model\Subscription');

        $subscription->setFirstname('Arturo');
        $subscription->setLastname('Cabrtera');
        $subscription->setEmail('gnuxdar@gmail.com');
        $subscription->setMessage('Mensaje registro');

        $subscription->save();
        $this->getResponse()->setBody('Success');
    }
}