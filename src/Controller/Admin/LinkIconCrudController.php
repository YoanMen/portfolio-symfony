<?php

namespace App\Controller\Admin;

use App\Entity\LinkIcon;
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


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextareaField::new('icon')->renderAsHtml(),
        ];
    }
}
