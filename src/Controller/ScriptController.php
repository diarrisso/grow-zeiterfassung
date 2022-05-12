<?php
namespace App\Controller;
use App\Form\EvaluSearchTimeType;
use App\Entity\EvaluSearchTime;
use App\Repository\TasksRepository;
use App\Entity\Tracking;
use App\Entity\Tasks;
use App\Entity\User;
use App\Data\SearchData;
use App\Form\SearchForm;
use App\Repository\TrackingRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use function compact;
use function dd;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class ScriptController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/script/home", name="script.test.sql") Method({"POST"})
     */
    public function index(Request $request , TrackingRepository $trackingRepository
        ,PaginatorInterface $paginator ): Response {
        $users = new User();
        $usersid  = $this->getUser()->getId();
        $alltrakingTime=$this->getDoctrine()->getRepository(Tracking::class)->gettrackingtimeByuserByInterval($usersid);
        $taskHour= $this->getDoctrine()->getRepository(Tracking::class)->getALLWorkingHourByTasks();

        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $alltrac= $this->getDoctrine()->getRepository(Tracking::class)->findSearch($data);
        } else {
            $alltrac= $this->getDoctrine()->getRepository(Tracking::class)->findSearchAll();
        }
        $alltrac = $paginator->paginate($alltrac, $request->query->
        getInt('page', 1),2);
        return $this->render('script/home.html.twig', [
            'form' =>$form->createView(),
            'alltrac' => $alltrac,
        ]);
    }

    /**
     *@IsGranted("ROLE_ADMIN")
     * @Route("/stats/index", name="stats.show.project.alltime")
     *
     */
    public function statisHourByProject(Request $request , TrackingRepository $trackingRepository, PaginatorInterface $paginator ): Response
    {
        $projectHour= $this->getDoctrine()->getRepository(Tracking::class)->getALLWorkingHourByProject();
        return $this->render('stats/index.html.twig', [
            'projectHour' => $projectHour
        ]);
    }

    /**
     *@IsGranted("ROLE_ADMIN")
     * @Route("/stats/tasks" , name="stats.show.task.alltime")
     * @return Response
     * @param TrackingRepository $trackingRepository
     * @param Request $request
     *
     */

    public function  statisHourByTasks(Request $request , TrackingRepository $trackingRepository ): Response
    {
        $taskHour= $this->getDoctrine()->getRepository(Tracking::class)->getALLWorkingHourByTasks();
        return $this->render('stats/tasks.html.twig', [
            'taskHour' => $taskHour
        ]);
    }


}
