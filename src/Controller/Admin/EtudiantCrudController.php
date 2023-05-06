<?php

namespace App\Controller\Admin;

use App\Entity\Etudiant;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EtudiantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Etudiant::class;
    }

    public function configureCrud(Crud $crud):Crud
    {
        return  $crud
            ->setEntityLabelInPlural('Etudiants')
            ->setEntityLabelInSingular('Etudiant')
            ->setPaginatorPageSize(20)
            ->setDefaultSort(['classeId'=>'ASC'])
            ->setPageTitle('index','Listes des Etudiants');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield IdField::new('id')->hideOnForm(),
            yield TextField::new('etudiantId'),
            yield TextField::new('etudiantNom'),
            yield TextField::new('etudiantPrenom'),
            yield AssociationField::new('classeId')->autocomplete(),
        ];
    }

}
