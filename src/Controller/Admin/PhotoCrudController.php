<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use App\Entity\PrestationType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PhotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Photo::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityLabelInSingular('Photo')
                    ->setPageTitle('index', 'Photos')
                    ->setPageTitle('new', 'Ajouter une Photo')
                    ->setPageTitle('edit', 'Modifier une Photo')
                ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ImageField::new('path', 'Photo')
                ->setUploadDir('/public/images/upload_photos')
                ->setBasePath('images/upload_photos')
                ->setUploadedFileNamePattern(mt_rand() . '.[extension]')
                ->setRequired(true),
            IdField::new('name')->setRequired(true),
            BooleanField::new('principalPhoto', 'Photo principal'),
            BooleanField::new('frontPhoto', 'Slider Page d\'accueil'),
            BooleanField::new('isMyWorksPhoto', 'Slider A propos de moi'),
            AssociationField::new('prestationType', 'Type de prestation')
                ->setFormType(EntityType::class),
            AssociationField::new('prestation', 'Prestation')
                ->setFormType(EntityType::class)
        ];
    }
}
