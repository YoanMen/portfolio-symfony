<?php

namespace App\Controller\Admin;

use App\Entity\LinkIcon;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LinkIconCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LinkIcon::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle('index', 'Liens icône')
            ->setPageTitle('new', 'créer un lien icône');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextareaField::new('icon')->renderAsHtml(),
        ];
    }
}
