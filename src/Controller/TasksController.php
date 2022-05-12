<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\Response;
use function dd;

/**
 *
 */
class TasksController extends AbstractController {
    public function index() : Response
    {
    }

    public function indexAction(Request $request)
    {
        $tasks = new Tasks();
        dd($tasks);
        $form=$this->get('form.task')->create(SearchF::class,$tasks);
        if($request->isMethod('post') && $form->handleRequest($request)->isValid()){
            $em=$this->getDoctrine()->getManager();
            $criteria = $form["name"]->getData();
            $type='name';
            return $this->redirectToRoute('app_home', array('criteria'=>$criteria,'type'=>$type));
        }
        return $this->render('script/home.html.twig',array('form'=>$form->createView()));
    }




}
