<?php

namespace App\Controller\Admin;

use App\Entity\Cost;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use phpDocumentor\Reflection\Types\Integer;

class CostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cost::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            DateTimeField::new('date'),
            MoneyField::new('cost')->setCurrency('EUR'),
            AssociationField::new('service')
        ];
    }

}
