<?php
declare(strict_types=1);

namespace Auction\Models;

use Auction\ValueObjects\Email;
use Auction\ValueObjects\Name;

class User
{
    /** @var Name */
    private $name;

    /** @var Email */
    private $email;

    /**
     * User constructor.
     * @param Name $name
     * @param Email $email
     */
    public function __construct(Name $name, Email $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->email;
    }

    /**
     * @param array $existingEmails
     * @return bool
     */
    public function isEmailUnique(array $existingEmails): bool
    {
        if(in_array($this->getEmail(), $existingEmails)) {
            return false;
        }
        return true;
    }
}
