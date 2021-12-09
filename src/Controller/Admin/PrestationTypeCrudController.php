<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use App\Entity\PrestationType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PrestationTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PrestationType::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom'),
            TextEditorField::new('description', 'Description'),

        ];
    }
    
}
