<?php
namespace User\Model\Listener;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Matryoshka\Model\ModelEvent;
use User\Model\Entity\UserEntity;

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
            //TODO: generate registration token
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