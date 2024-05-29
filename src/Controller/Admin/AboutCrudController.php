<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Trait\EditOnlyTrait;
use App\Entity\About;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AboutCrudController extends AbstractCrudController
{
    use EditOnlyTrait;
    public static function getEntityFqcn(): string
    {
        return About::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle("index", " A propos")
            ->setPageTitle('edit', 'Modification du à propos')
            ->setSearchFields(null);
    }



    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('description', 'A propos')->onlyOnIndex()->renderAsHtml(),
            TextEditorField::new('description', 'A propos')->setTrixEditorConfig([
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
