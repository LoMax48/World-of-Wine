<?php

namespace App\Controller\Admin;

use App\Entity\Contains;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ContainsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contains::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('name','Вино'),
            AssociationField::new('booking','Номер заказа'),
            IntegerField::new('number','Количество'),
        ];
    }
}
