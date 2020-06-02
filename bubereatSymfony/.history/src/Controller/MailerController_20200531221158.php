<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MailerController extends AbstractController
{
    /**
     * @Route("/email", methods={"POST"})
     */
    public function sendEmail(MailerInterface $mailer, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $email = (new TemplatedEmail())
            ->from('bubereat@gmail.com')
            ->to($data['emailRestaurant'])
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('new command of '.$data['userEmail'])
            ->text('New command')
            ->htmlTemplate('emails/newCommandRestaurant.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'commandDishes' => $data['commandDishes'],
                'userName' => $data['userName'],
                'commandDate' => $data['commandDate']
            ]);

        $mailer->send($email);

        return new Response(
            Response::HTTP_OK
        );
        // ...
    }
}
