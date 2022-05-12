<?php

namespace App\Controller;

use App\Entity\Tasks;
use App\Entity\Tracking;
use App\Entity\User;
use App\Repository\TrackingRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use function compact;
use function dd;
use function get_current_user;


class GrowController extends AbstractController
{

    /**
     * @Route ("/", name="app_home")

     */
    public function index( ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('grow/home.html.twig');
    }



}
