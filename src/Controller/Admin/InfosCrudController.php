<?php

namespace App\Controller\Admin;

use App\Entity\Infos;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class InfosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Infos::class;
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
