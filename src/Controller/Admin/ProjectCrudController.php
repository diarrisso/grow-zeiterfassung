<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use App\Entity\Customer;


class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
          /*  IntegerField::new('id', 'ID')->onlyOnIndex(),*/
            TextField::new('project_name','Projekte Name'),
            TextField::new('description','Projekte Beschreibung'),
            TextField::new('contact_person','Ansprechpartner'),
            TextField::new('competence_employe','Zustand Mitarbeiter'),
            IntegerField::new('order_number','Auftragsnummer'),
            DateField::new('order_date','Order Datum'),
            DateField::new('delivery_date','Liefertermin'),
            IntegerField::new('document_id','document_id'),
            BooleanField::new('status'),
            AssociationField::new('customer','Zugehörigen Kunden'),


        ];
    }


}
