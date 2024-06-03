<?php

namespace App\Controller\Admin;

use App\Entity\Link;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LinkCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Link::class;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle('index', 'Liens')
            ->setPageTitle('edit', 'Modifier un lien')
            ->setPageTitle('new', 'Ajouter un lien');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->remove(Crud::PAGE_INDEX, Action::NEW);
    }

    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('name', 'nom')->setColumns(3),
            UrlField::new('path', 'lien'),
            TextField::new('linkIcon', 'icon')->renderAsHtml(),
            AssociationField::new('linkIcon', 'Icon')
                ->setFormTypeOptions([
                    'by_reference' => true,
                    'multiple' => false,
                    'choice_label' => 'name',
                ])->onlyOnForms(),
        ];
    }
}
