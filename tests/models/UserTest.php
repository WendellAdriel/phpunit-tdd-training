<?php

use PHPUnit\Framework\TestCase;
use Auction\Models\User;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function hasName()
    {
        $user = new User('Wendell');
        $this->assertNotNull($user->getName());
    }
}
