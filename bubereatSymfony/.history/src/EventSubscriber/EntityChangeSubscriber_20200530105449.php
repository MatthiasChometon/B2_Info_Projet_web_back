<?php

namespace App\EventSubscriber;

use App\Entity\User;
use DateTime;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EntityChangeSubscriber implements EventSubscriber
{
  private $encoder;

  public function __construct(UserPasswordEncoderInterface $encoder)
  {
      $this->encoder = $encoder;
  }
  public function getSubscribedEvents()
  {
    return [
      Events::preUpdate
    ];
  }

  public function preUpdate(LifecycleEventArgs $args)
  {
    $object = $args->getObject();
  
    if ($object instanceof User) {
      $encoded = strpos($object->getPassword(), "argon2");
      throw new NotFoundHttpException($encoded);

      if($encoded == "" && $encoded != "0") {
        throw new NotFoundHttpException($encoded);
        $object->setPassword($this->encoder->encodePassword($object,  $object->getPassword()));
      }
    }
  }
}