<?php

namespace App;

class SwMailer
{
    public function setMessage($subject, $body, $priority)
    {
        $message = \Swift_Message::newInstance($subject); //subject!
        // Set the From address with an associative array
        $message->setFrom(['mailer.swift@yandex.ru' => 'system']);
        // Indicate priority 1 == Highest
        $message->setPriority($priority);
        // Set the To addresses with an associative array
        $message->setTo(['webmaza75@gmail.com' => 'webmaza']);
        // Give it a body
        $message->setBody($body);
        return $message;
    }

    public function setTransport()
    {
        $transport = \Swift_SmtpTransport::newInstance('smtp.yandex.ru', 465, 'ssl')
            ->setUsername('mailer.swift@yandex.ru')
            ->setPassword('12345678901234567890')
        ;
        return $transport;
    }

    public function sendMail($subject, $body, $priority = 3) // normal priority
    {
        $mailer = \Swift_Mailer::newInstance($this->setTransport());
        $message = $this->setMessage($subject, $body, $priority);
        $result = $mailer->send($message);
        return $result;
    }
}