<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use App\Form\BlogImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class BlogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Blog::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle('index', "Blog")
            ->setPageTitle('edit', 'Edit a article')
            ->setPageTitle('detail', 'Detail of article')
            ->setPageTitle('new', 'Create a article')
            ->setDateFormat('   dd/MM/Y')
            ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', "Title"),
            TextEditorField::new('detail', 'Article')->onlyOnIndex(),
            TextEditorField::new('detail', 'Article')->setTrixEditorConfig([
                'blockAttributes' => [
                    'default' => ['tagName' => 'p'],
                    'heading1' => ['tagName' => 'h3'],
                ],
                'css' => [
                    'attachment' => 'admin_file_field_attachment',
                ],
            ])
                ->onlyOnForms()
                ->setColumns(12)->setNumOfRows(25),
            CollectionField::new('blogImages', 'Insert images')
                ->setEntryType(BlogImageType::class)->onlyOnForms(),
            AssociationField::new('blogImages', 'Images')->onlyOnIndex()



        ];
    }
}
