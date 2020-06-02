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
            ->html('<p>The command</p><p>'.         <?php
            foreach ($allResults[0] as $key => $value) {
                if (empty($_GET[$key]) == false && $key != 'player') {
                    echo "UPDATE utilisateur SET " . $key . " = " . $_GET[$key];
                    $statement = $connectionQQM->prepare("UPDATE utilisateur SET " . $key . " = " . "'" . $_GET[$key] . "'" . "WHERE player = " . "'" . $_GET['player'] . "'");
                    $statement->execute();
                }
            }
            ?>
            .'</p>');

        //$mailer->send($email);

        return new Response(
            Response::HTTP_OK
        );
        // ...
    }
}
