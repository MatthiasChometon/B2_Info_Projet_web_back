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

        //throw new NotFoundHttpException($data);

        $email = (new Email())
            ->from('matthiaschometon787@gmail.com')
            ->to('matthiaschometon787@gmail.com')
            //$data->attributes->get('emailRestaurant')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        //$mailer->send($email);

        foreach ($arr as &$value) {
            $value = $value * 2;
        }

        return new Response(
            $data,
            Response::HTTP_OK
        );
        // ...
    }
}
