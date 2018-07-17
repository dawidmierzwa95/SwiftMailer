<?php

namespace Src;

class Main
{
    /*
     * Set config
     */
    const EMAIL_FROM = 'dawidmierzwa95@gmail.com';
    const EMAIL_TO = 'dawidmierzwa95@gmail.com';
    const SMTP_HOST = 'in-v3.mailjet.com';
    const SMTP_PORT = 25;
    const SMTP_USERNAME = '8e30a7db7983d444b498bc8bd173126d';
    const SMTP_PASSWORD = 'c216eee46d91540205502bcc116d3605';

    private static $reference = null;
    private static $mailer = null;

    public function __construct () {
        self::$reference = (new \Swift_SmtpTransport(self::SMTP_HOST, self::SMTP_PORT))
            ->setUsername(self::SMTP_USERNAME)
            ->setPassword(self::SMTP_PASSWORD);

        self::$mailer = new \Swift_Mailer(self::$reference);
    }

    /**
     * Check e-mail address format
     * @param string $email
     *
     * @return mixed
     */
    public static function formatEmail(string $email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Check if reference created
     * @return bool
     */
    private static function referenceCreated() {
        return self::$reference ? true : false;
    }

    /**
     * Mailer reference
     * @return null|\Swift_Mailer
     */
    private function mailer() {
        return self::$mailer;
    }

    /**
     * Send test mail. Return 0 (FAIL) or 1 (SUCCESS)
     * @return int
     */
    public function test ()
    {
        $status = 0;

        if(self::referenceCreated() &&
           self::formatEmail(self::EMAIL_FROM) &&
           self::formatEmail(self::EMAIL_TO)) {

            $message = (new \Swift_Message("Test mail"))
                ->setFrom(self::EMAIL_FROM)
                ->setTo(self::EMAIL_TO)
                ->setBody("It's working!");

            $status = $this->mailer()->send($message);
        }

        return $status;
    }
}