<?php

namespace App\Controller;


use App\Repository\TrackingRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function compact;
use function dd;

class AccountController extends AbstractController
{
    /**
     * @Route("/profile", name="account.user.ertrage")
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function index(TrackingRepository $trackingRepository ): Response
    {
        $trackingResult = $trackingRepository->findAllTracTasks($this->getUser());
        return $this->render('/account/index.html.twig', compact('trackingResult'));
    }

}
