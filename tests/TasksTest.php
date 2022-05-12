<?php


namespace App\Tests;

use App\Entity\Project;
use App\Entity\Tasks;
use App\Entity\Tracking;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class TasksTest extends TestCase
{
    public function testProjectTasksWorkEntry(): void
    {
        $user = new User();
        $tasks = new Tasks();
        $projekte = new  Project();
        $date_expire = '2022-04-06 00:00:00';
        $date = new DateTime($date_expire);
        $tasks->setName('Ist Analyse')
            ->setDateStart($date)
            ->setDateEnde($date)
            ->setDescription('soll die ist Analyse gemacht')
            ->setStatus(true)
            ->SetUser($user->getId())
            ->setProject($projekte);
        $this->assertTrue($tasks->getName()=== 'Ist Analyse');
        $this->assertTrue($tasks->getDateStart() === $date);
        $this->assertTrue($tasks->getDateEnde() === $date);
        $this->assertTrue($tasks->getDescription() === 'soll die ist Analyse gemacht');
        $this->assertTrue($tasks->getUser() === $user->getId());
        $this->assertTrue($tasks->getProject() === $projekte);
        $this->assertTrue($tasks->getStatus() === true);
    }

    public function testProjectTasksWorkEntryIsFalse()
    {
        $user = new User();
        $tasks = new Tasks();
        $projekte = new  Project();
        $date_expire = '2022-04-18 00:00:00';
        $date = new DateTime($date_expire);
        $tasks->setName('Ist Analyse')
            ->setDateStart($date)
            ->setDateEnde($date)
            ->setDescription('soll die ist Analyse gemacht')
            ->setStatus(true)
            ->SetUser($user->getId())
            ->setProject($projekte);
        $this->assertFalse($tasks->getName()===  new DateTime());
        $this->assertFalse($tasks->getDateStart() === new DateTime());
        $this->assertFalse($tasks->getDateEnde() === new DateTime());
        $this->assertFalse($tasks->getDescription() === 'Ist die ist Analyse gemacht');
        $this->assertFalse($tasks->getUser() === 13);
        $this->assertFalse($tasks->getProject() === 'Spurwerk');
        $this->assertFalse($tasks->getStatus() === false);
    }
    public function testProjectTasksWorkEntryIsEmpty(): void
    {
        $tasks = new Tasks();
        $this->assertEmpty($tasks->getDateStart());
        $this->assertEmpty($tasks->getDateEnde());
        $this->assertEmpty($tasks->getDescription());
        $this->assertEmpty($tasks->getUser());
        $this->assertEmpty($tasks->getProject());

    }
}
