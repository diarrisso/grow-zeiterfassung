<?php

namespace App\Controller;
use App\Entity\Project;
use App\Entity\Tasks;
use App\Entity\Tracking;
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
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use function dd;
use function dump;
use function var_dump;


/**
 *
 */
class TrackingController extends AbstractController
{
    /**
     * @Route("/grow/home", name="home.html.show"  , methods={"GET", "POST"})
     * * @IsGranted("ROLE_USER")
     */

    public function index(): Response
    {
        return $this->render('grow/home.html.twig');

    }

    /**
     * @Route("/tracking/create", name="frontend.tracking.index" , methods={"GET" , "POST"})
     * * * @IsGranted("ROLE_USER")
     */


    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $tracking = new Tracking();
        $form = $this->getForm($tracking);
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

        return $this->render('/tracking/create.html.twig', [
            'form' => $this->getForm($tracking)->createView()
        ]);
    }

    private function getForm(Tracking $time): FormInterface
    {
        return $this->createFormBuilder($time)
            ->add('start', TimeType::class, [
                'input' => 'datetime',
                'widget' => 'choice',
            ])
            ->add('end', TimeType::class, [
                'input' => 'datetime',
                'widget' => 'choice',
            ])

            ->add('internalCommentary', TextareaType::class, [
                'row_attr' => ['class' => 'text-editor', 'id' => '...',
                ],

            ])
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'choice_label' => 'Project_name',
                'placeholder' => 'Project',
                'label' => 'Project',
                'required' => false
            ])
            ->add('task', EntityType::class, [
                'class' => Tasks::class,
                'choice_label' => 'name',
                'placeholder' => 'wahlt dein Aufgaben',
                'label' => 'Aufgaben',
                'required' => false
            ])
            ->add('submit',SubmitType::class)

            ->getForm();


    }
}
