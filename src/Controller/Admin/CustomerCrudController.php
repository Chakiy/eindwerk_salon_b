<?php

namespace App\Controller\Admin;


use App\Entity\Customer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;



class CustomerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Customer::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('lastName'),
            TextField::new('password')->hideOnindex(),
            TextField::new('email'),
            IntegerField::new('gsm'),
            TextAreaField::new('about')->setRequired(false),
            TextField::new('sex')->hideOnForm(),
            ChoiceField::new('sex')->setChoices(["man"=>"man", "vrouw"=>"vrouw"])->hideOnIndex(),
            DateField::new('bday'),
            ArrayField::new('roles'),
            AssociationField::new('address')


        ];
    }

}
