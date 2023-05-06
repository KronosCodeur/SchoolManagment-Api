<?php

namespace App\Controller\Admin;

use App\Entity\Enseigner;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EnseignerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Enseigner::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
