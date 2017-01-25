<?php

namespace Auction\ValueObjects;

class Email
{
    /** @var string */
    private $email;

    /**
     * Email constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        if ($this->isValid($email)) {
            $this->email = $email;
            return;
        }
        throw new \InvalidArgumentException("Email is invalid");
    }

    /**
     * @param string $email
     * @return bool
     */
    private function isValid(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->email;
    }
}