<?php

namespace App\EventListener;

use App\Entity\User;
use DateTime;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTDecodedEvent;

class JWTAuthenticatedListener
{
/**
 * @param JWTDecodedEvent $event
 *
 * @return void
 */
public function onJWTDecoded(JWTDecodedEvent $event)
{
    $payload = $event->getPayload();
    $user = $this->userRepository->findOneByUsername($payload['username']);

    $payload['id'] = $user->getId();

    $event->setPayload($user); // Don't forget to regive the payload for next event / step
}
}
