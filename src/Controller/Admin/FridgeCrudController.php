<?php

namespace App\Controller\Admin;

use App\Entity\Fridge;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class FridgeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Fridge::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            IntegerField::new('capacity'),
            IntegerField::new('temperature'),
            AssociationField::new('worker'),
        ];
    }
}
