<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MailerController extends AbstractController
{
    /**
     * @Route("/email", methods={"POST"})
     */
    public function sendEmail(MailerInterface $mailer, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $email = (new Email())
            ->from('matthiaschometon787@gmail.com')
            ->to($data['emailRestaurant'])
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('new command of '.$data['userName'])
            ->text('Sending emails is fun again!')
            ->html('<p>The command</p><p>'. <?php
            foreach ($arr as &$value) {
                $value = $value * 2;
            }
            .'</p>');

        //$mailer->send($email);

        return new Response(
            Response::HTTP_OK
        );
        // ...
    }
}
