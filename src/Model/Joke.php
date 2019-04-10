<?php


namespace App\Model;

use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

class Joke
{
    /**
     * @var string $text
     */
    protected $text = '';

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function getText() : string
    {
        return $this->text;
    }

    public function setText($text) : void
    {
        $this->text = $text;
    }

    public function sendByEmail(\Swift_Mailer $mailer, string $from, string $email, string $subject) : self
    {
        $message = (new \Swift_Message())
            ->setFrom($from)
            ->setTo($email)
            ->setSubject($subject)
            ->setBody($this->text);

        $mailer->send($message);
        return $this;
    }

    public function saveAsFile($fileName) : self
    {
        $filesystem = new Filesystem();

        try {
            $filesystem->appendToFile($fileName, $this->text.PHP_EOL);
        } catch (IOExceptionInterface $exception) {
            echo $exception->getTraceAsString();
        }
        return $this;
    }
}