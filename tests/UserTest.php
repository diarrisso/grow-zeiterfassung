<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testIsTrue(): void{
        $user = new User();
        $user->setEmail('true@gmail.com');
        $user->setVorname('vorname');
        $user->setNachname('nachname');
        $user->setPassword('password$');
        $user->setRoles(['ROLE_USER']);
        $this->assertSame($user->getEmail(), 'true@gmail.com');
        $this->assertSame($user->getVorname(), 'vorname');
        $this->assertSame($user->getNachname(),'nachname');
        $this->assertSame($user->getPassword(), 'password$');
        $this->assertSame($user->getRoles(), ['ROLE_USER']);
    }

    public function testIsFalse(): void {
        $user = new User();
        $user->setEmail('true@gmail.com');
        $user->setVorname('mamadi');
        $user->setNachname('diarrisso');
        $user->setPassword('pasdwword$');
        $user->setRoles(['ROLE_USER']);
        $this->assertFalse($user->getEmail()=== 'false@gmail.com');
        $this->assertFalse($user->getVorname()=== 'false');
        $this->assertFalse($user->getNachname()=== 'false');
        $this->assertFalse($user->getPassword()=== 'false');
        $this->assertFalse($user->getRole()==='false');
    }

    public function testIsEmpty(): void {
        $user = new User();
        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getVorname());
        $this->assertEmpty($user->getNachname());
        $this->assertEmpty($user->getPassword());
    }

    public function testUserCreate(){

        $user = new User(); // Create User object.
        $user->setEmail('diarrisso@gmail.com');
        $user->setPassword('testtttsss$');
        $user->setRoles(['ROLE_USER']);
        $user->setVorname("Mamadi");
        $user->setNachname("Diarrisso");

        $this->assertEquals("diarrisso@gmail.com", $user->getEmail());
        $this->assertEquals("testtttsss$", $user->getPassword());
        $this->assertEquals("Mamadi", $user->getVorname());
        $this->assertEquals("Diarrisso", $user->getNachname());
        $this->assertEquals(['ROLE_USER'],$user->getRoles());
        $this->assertEquals(null, $user->getId());

    }
}
