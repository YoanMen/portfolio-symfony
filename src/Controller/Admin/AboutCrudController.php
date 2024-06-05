<?php

namespace App\Controller\Admin;

use App\Entity\About;
use App\Controller\Admin\Trait\EditOnlyTrait;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AboutCrudController extends AbstractCrudController
{
    use EditOnlyTrait;
    public static function getEntityFqcn(): string
    {
        return About::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle("index", "About")
            ->setPageTitle('edit', 'Edit about')
            ->setSearchFields(null);
    }




    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('description', 'About')->onlyOnIndex()->renderAsHtml(),
            TextEditorField::new('description', 'About')->setTrixEditorConfig([
                'blockAttributes' => [
                    'default' => ['tagName' => 'p'],
                    'heading1' => ['tagName' => 'h3'],
                ],
                'css' => [
                    'attachment' => 'admin_file_field_attachment',
                ],
            ])->onlyWhenUpdating()
                ->setColumns(12)->setNumOfRows(25)
        ];
    }
}
