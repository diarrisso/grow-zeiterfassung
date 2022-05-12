<?php

namespace App\Controller\Admin;

use App\Entity\Tasks;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
USE EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;


class TasksCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tasks::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name','Aufgaben Name'),
            TextField::new('description','Aufgaben Beschreibung'),
            DateField::new('date_start','Anfang Datum'),
            DateField::new('date_ende','Ende Datum'),
            BooleanField::new('status'),
            AssociationField::new('project','Zugehörigen Projekte'),
            AssociationField::new('user', 'Zustand Mitarbeiter')
        ];
    }

}
