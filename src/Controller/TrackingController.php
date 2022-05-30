<?php

namespace App\Controller;
use App\Entity\Project;
use App\Entity\Tasks;
use App\Entity\Tracking;
use App\Form\TrackingType;
use DateInterval;
use DateTimeZone;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use http\Client\Curl\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Repository\TrackingRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\PseudoTypes\TraitString;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;



/**
 *
 */
class TrackingController extends AbstractController
{
    /**
     * @Route("/zeit-eintrage", name="frontend.tracking.index") Method({"POST"})
     * * * @IsGranted("ROLE_USER")
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $tracking = new Tracking();
        $form = $this->createForm(TrackingType ::class, $tracking);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $start =  $tracking->getStart();
            $end =  $tracking->getEnd();
            $diff = $start->diff($end);
            $tracking->setTotal( $diff);
            $userForm = $this->getUser();
            $tracking->setUser($userForm);
            $em->persist($tracking);
            $em->flush($tracking);
            return $this->redirectToRoute('account.user.ertrage');
        }
        return $this->render('/tracking/zeit-eintrage.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
