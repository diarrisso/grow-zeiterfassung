<?php

namespace App\Tests;

use App\Entity\Project;
use App\Entity\Tasks;
use App\Entity\Tracking;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class TrackingTest extends TestCase
{
    public function testUserWorkTimeEntry(): void{
        $tracking = new Tracking();
        $user = new User();
        $tasks = new Tasks();
        $datetime = new DateTime();
        $projekte = new  Project();
        $date_expire = '2022-04-06 00:00:00';
        $date = new DateTime($date_expire);
        $tracking->setStart($date )
        ->setEnd($date)
        ->setInternalCommentary('ich habe heute alle aufgaben erledigt')
        ->SetUser($user)
        ->setProject($projekte)
        ->setTask($tasks);
        $this->assertTrue($tracking->getStart() === $date);
        $this->assertTrue($tracking->getEnd() === $date);
        $this->assertTrue($tracking->getInternalCommentary() === 'ich habe heute alle aufgaben erledigt');
        $this->assertTrue($tracking->getUser() === $user);
        $this->assertTrue($tracking->getProject() === $projekte);
        $this->assertTrue($tracking->getTask() === $tasks);
    }
    public function testUserWorkTimeEntryIsFalse(){
        $tracking = new Tracking();
        $user = new User();
        $tasks = new Tasks();
        $datetime = new DateTime();
        $projekte = new  Project();
        $date_expire = '2022-04-08 00:00:00';
        $date = new DateTime($date_expire);
        $tracking->setStart($date )
        ->setEnd($date)
        ->setInternalCommentary('ich habe heute alle aufgaben erledigt')
         ->SetUser($user)
        ->setProject($projekte)
        ->setTask($tasks);
        $this->assertFalse($tracking->getStart() === 7);
        $this->assertFalse($tracking->getEnd()=== 'false');
        $this->assertFalse($tracking->getInternalCommentary() === 'false');
        $this->assertFalse($tracking->getUser() === 'fff');
        $this->assertFalse($tracking->getProject() === 'salut');
        $this->assertFalse($tracking->getTask() === 'false');
    }
    public function testUserWorkTimeEntryIsEmpty(): void{
        $tracking = new Tracking();
        $this->assertEmpty($tracking->getStart());
        $this->assertEmpty($tracking->getEnd());
        $this->assertEmpty($tracking->getInternalCommentary());
        $this->assertEmpty($tracking->getUser());
        $this->assertEmpty($tracking->getProject());
        $this->assertEmpty($tracking->getTask());
    }
}
