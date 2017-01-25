<?php
declare(strict_types=1);

namespace Auction\ValueObjects;

class Name
{
    const MIN_NAME_LENGTH = 2;

    /** @var string */
    private $name;

    /**
     * Name constructor.
     * @param $name
     */
    public function __construct(string $name)
    {
        if ($this->isValid($name)) {
            $this->name = $name;
            return;
        }
        throw new \InvalidArgumentException("Name is invalid");
    }

    /**
     * @param string $name
     * @return bool
     */
    private function isValid(string $name): bool
    {
        if (strlen($name) < self::MIN_NAME_LENGTH) {
            return false;
        }

        return preg_match_all('/[\d]+/i', $name) ? false : true;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }
}