<?php

namespace App\Controller\Admin;

use App\Entity\Name;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;


class NameCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Name::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextEditorField::new('description'),
            TextField::new('color'),
            TextField::new('sweetness'),
            IntegerField::new('degrees'),
            IntegerField::new('sugar'),
            IntegerField::new('price'),
        ];
    }
}
