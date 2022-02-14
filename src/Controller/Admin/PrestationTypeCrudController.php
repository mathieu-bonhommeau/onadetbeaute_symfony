<?php

namespace App\Controller\Admin;

use App\Entity\PrestationType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PrestationTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PrestationType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityLabelInSingular('Type de prestation')
                    ->setPageTitle('index', 'Types de prestation')
                    ->setPageTitle('new', 'Ajouter un type de prestation')
                    ->setPageTitle('edit', 'Modifier un type de prestation')
                ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom')->setRequired(true),
            TextField::new('slug', 'Nom unique/Slug')->setRequired(true),
            TextEditorField::new('description', 'Description')->setRequired(true),
            AssociationField::new('photoInPromote', 'Photo')
                ->setRequired(true) 
        ];
    }
    
}
