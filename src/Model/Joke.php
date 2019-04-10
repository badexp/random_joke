<?php


namespace App\Model;

use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class Joke
 * Adds abstraction layer for RandomJokeController controller, but it's still FAT
 * @package App\Model
 */
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

    /**
     * Send the joke via email
     *
     * @param \Swift_Mailer $mailer
     * @param string $from
     * @param string $email
     * @param string $subject
     * @return Joke
     */
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

    /**
     * Save the joke in the file
     *
     * @param $fileName
     * @return Joke
     */
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