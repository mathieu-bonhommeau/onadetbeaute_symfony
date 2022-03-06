<?php

namespace App\Controller\Admin;

use App\Entity\OnadEtBeaute;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OnadEtBeauteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OnadEtBeaute::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email', 'Email'),
            TextField::new('firstname', 'Prénom'),
            TextField::new('lastname', 'Nom'),
            TextField::new('address', 'Adresse'),
            TextField::new('phone', 'Téléphone'),
            TextField::new('siret', 'Numéro de siret'),
            TextEditorField::new('aboutMe', 'A propos de moi'),
            TextEditorField::new('aboutMyActivity', 'Description de l\'activité'),
            IdField::new('facebookClientId', 'Facebook Client Id')
                ->hideOnIndex(),
            IdField::new('facebookUserId', 'Facebook User Id')
                ->hideOnIndex(),
            TextField::new('facebookClientSecret', 'Facebook Client Secret')
                ->hideOnIndex(),
            TextField::new('facebookRedirectUri', 'Facebook Redirect Uri')
                ->hideOnIndex(),
            IdField::new('facebookPageId', 'Facebook Page Id')
                ->hideOnIndex(),
        ];
    }
    
}
