<?php


namespace Actecnology\ModuloBasico\Controller\Index;


class Subscription extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        // el objectManager no se recomeinda utilizar directamente, se prefiere utilizar una injeccion de dependencia
        // para ejecutar: URL: /frontname_de_router/controlador_folder/class_file = {url}/actecnology/index/subscription/
        $subscription = $this->_objectManager->create('Actecnology\ModuloBasico\Model\Subscription');

        $subscription->setFirstname('Arturo');
        $subscription->setLastname('Cabrera');
        $subscription->setEmail('gnuxdar@gmail.com');
        $subscription->setMessage('Mensaje de registro desde el controller');

        $subscription->save();
        $this->getResponse()->setBody('Success');
    }
}