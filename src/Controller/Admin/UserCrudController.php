<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('email'),
            TextField::new('surname','Фамилия'),
            TextField::new('name','Имя'),
            TextField::new('midname','Отчество'),
            TextField::new('phone','Номер телефона'),
            ChoiceField::new('roles','Роль',)->setChoices([
                'Админ' => 'ROLE_ADMIN',
                'Отдел продаж' => 'ROLE_SELLER',
                'Холодильная камера' => 'ROLE_HK',
            ])->allowMultipleChoices(true)->setRequired(false),
        ];
    }
}
