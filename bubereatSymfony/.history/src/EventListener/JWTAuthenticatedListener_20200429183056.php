<?php

namespace App\EventListener;

use App\Entity\User;
use DateTime;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTAuthenticatedEvent;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class JWTAuthenticatedListener
{
    /**
     * @param JWTAuthenticatedEvent $event
     *
     * @return void
     */
    public function onJWTAuthenticated(JWTAuthenticatedEvent $event, InputInterface $input, OutputInterface $output)
    {
        $token = $event->getToken();
        $payload = $event->getPayload();

        $token->setAttribute('uuid', 'sdfsf');
        $output->writeln('Some info');
        $output->writeln('Some more info');
    }
}
