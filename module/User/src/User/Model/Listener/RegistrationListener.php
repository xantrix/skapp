<?php
namespace User\Model\Listener;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Matryoshka\Model\ModelEvent;
use User\Model\Entity\UserEntity;
use User\Model\Entity\UserInterface;
use Application\Model\UniqueToken;

class RegistrationListener extends AbstractListenerAggregate
{
    /**
     * {@inheritdoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(ModelEvent::EVENT_SAVE_PRE, [$this, 'onSavePre']);
        $this->listeners[] = $events->attach(ModelEvent::EVENT_SAVE_POST, [$this, 'onSavePost']);
    }

    public function onSavePre(ModelEvent $e)
    {
        $user = $e->getData();

        if ($user instanceof UserEntity) {
            if($user->getStatus() === UserInterface::STATUS_INACTIVE){
	        	$registrationToken = UniqueToken::getToken();
	            $user->setRegistrationToken($registrationToken);
	            $user->setStatus(UserInterface::STATUS_ACTIVE);
            }
        }

    }

    public function onSavePost(ModelEvent $e)
    {
        $user = $e->getData();

        if ($user instanceof UserEntity) {
            //TODO: send registration email
        }

    }
}