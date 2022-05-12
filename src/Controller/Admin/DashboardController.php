<?php

namespace App\Controller\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Knp\Component\Pager\PaginatorInterface;
use PhpParser\Node\Expr\Yield_;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use App\Entity\User;
use App\Entity\Customer;
use App\Entity\Tasks;
use App\Entity\Project;
use App\Repository\TrackingRepository;
use App\Repository\ TasksRepository;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use function dd;


class DashboardController extends AbstractDashboardController
{

    private $tasksRepository;
    private  $trackingRepository;
    private $userRepository;

    public function __construct( TrackingRepository $trackingRepository){
               $this->trackingRepository=$trackingRepository;
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin", name="admin")
     */

    public function index(): Response
    {
        return $this->render('Bundles/EasyAdminBundles/welcome.html.twig', [
            'myJSON' =>  $this->trackingRepository->findSearchAll()
        ]);
    }
    public function configureMenuItems(): iterable{
        yield MenuItem::linkToRoute('Zeiterfassung', 'fa fa-home', 'app_home');
        yield MenuItem::linkToCrud('Kunden ', 'fa fa-list-alt', Customer::class);
        yield MenuItem::linkToCrud('Aufgaben Liste', 'fa fa-list-alt', Tasks::class);
        yield MenuItem::linkToCrud('Projekte Liste','fa fa-list-alt', Project::class);
        yield MenuItem::linkToUrl('Zeite Aufgaben','fa fa-clock-o','stats/tasks');
        yield MenuItem::linkToUrl('Zeite Projekte','fa fa-clock-o','stats/index');
        yield MenuItem::linkToUrl('Suchfunktion','fa fa-filter','script/home');
    }
    public function configureDashboard(): Dashboard {
        return Dashboard::new()
            ->setTitle('grow-werbeagentur');
    }
    public function configureAssets(): Assets {
        return Assets::new()
        ->addWebpackEncoreEntry('admin')
        ->addWebpackEncoreEntry('simple')
        ->addJsFile('js/simple-datatables.js')
        ->addCssFile('css/bootstrap.min.css');
    }



}
