<?php

namespace App\Controller\Admin;

use App\Entity\Appointment;
use Doctrine\ORM\Mapping\Builder\AssociationBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;


use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use Symfony\Component\Validator\Constraints\Date;

class AppointmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Appointment::class;
    }



    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('date'),
            TimeField::new('time'),
            AssociationField::new('customerApp', 'Customer'),
//            AssociationField::new('customerApp', 'Name'),
            AssociationField::new('service')
        ];
    }

}
