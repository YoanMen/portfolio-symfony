<?php

namespace App\Controller\Admin;

use App\Entity\LinkIcon;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LinkIconCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LinkIcon::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle('index', 'Link icon')
            ->setPageTitle('new', 'Create a link icon');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextareaField::new('icon')->setHelp('insert <a class="text-blue" href="https://icon-sets.iconify.design/" target="_blank">Iconify</a> svg code  ')->renderAsHtml(),
        ];
    }
}
