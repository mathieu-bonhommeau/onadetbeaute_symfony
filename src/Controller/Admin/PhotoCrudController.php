<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
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

    public function configureActions(Actions $actions): Actions
    {
        $actions
            ->update(
                Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                    $action->displayIf(
                        function (Photo $entity) {

                            if ($entity->getPrestationType()
                                || $entity->getPrincipalPhoto() 
                                || $entity->getFrontPhoto() 
                                || $entity->getIsMyWorksPhoto() 
                                || $entity->getPrestation()
                            ) {
                                return false;
                            }
                            return true;
                        }
                    );
                    return $action;
                }
            );
        
        return $actions;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('imageFile')->setFormType(VichImageType::class)->onlyWhenCreating(),
            ImageField::new('path', 'Photo')
                ->setBasePath('images/upload_photos')
                ->setUploadDir('public/images/upload_photos')
                ->onlyOnIndex(),
            IdField::new('name')->setRequired(true),
            BooleanField::new('principalPhoto', 'Photo principal')
                ->addCssClass('principal-photo'),
            BooleanField::new('frontPhoto', 'Slider Page d\'accueil')
                ->addCssClass('front-photo'),
            BooleanField::new('isMyWorksPhoto', 'Slider A propos de moi')
                ->addCssClass('ismyworks-photo'),
            TextField::new('prestationType', 'Type de prestation')
                ->hideWhenCreating()
                ->setDisabled(true),
            TextField::new('prestation', 'Prestation')
                ->hideWhenCreating()
                ->setDisabled(true),
            ArrayField::new('tags', 'Tags')
        ];
    }
}
