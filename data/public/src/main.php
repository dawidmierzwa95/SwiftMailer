<?php

namespace Src;

class Main
{
    /*
     * Set config
     */
    const EMAIL_FROM = '';
    const EMAIL_TO = 'dawidmierzwa95@gmail.com';
    const SMTP_HOST = '';
    const SMTP_PORT = 25;
    const SMTP_USERNAME = '';
    const SMTP_PASSWORD = '';

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