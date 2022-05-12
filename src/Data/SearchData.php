<?php
namespace App\Data;
use App\Entity\Customer;
use App\Entity\Project;
use App\Entity\Tasks;
use App\Entity\User;
use DateTime;
class SearchData
{
/**
* @var string
*/
public $q = '';
/**
* @var string
*/
public $project;
/**
 * @var string
*/
public $tasks;
/**
 * @var string
*/
public  $customer;
/**
 * @var string
 */
public  $user;
/**
 * @var Date
 */
public $minDate;
/**
 * @var Date
 */
    public $maxDate;

}