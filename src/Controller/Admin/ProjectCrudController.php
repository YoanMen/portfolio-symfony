<?php

namespace App\Controller\Admin;

use App\Form\LinkType;
use App\Entity\Project;
use App\Form\ProjectImageType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle('index', 'Projets')
            ->setPageTitle('edit', 'Modification d\'un projet')
            ->setPageTitle('new', 'Création d\'un nouveau projet')
            ->setDateFormat('   dd/MM/Y');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
            TextField::new('description', 'Description'),

            TextField::new('detail', 'Détail')->onlyOnIndex(),

            TextEditorField::new('detail', 'Détail')->onlyOnForms()
                ->setNumOfRows(15)
                ->setColumns(15),

            AssociationField::new('links', 'Liens externe')
                ->setFormTypeOptions([
                    'by_reference' => false,
                    'multiple' => true,
                    'choice_label' => 'name',
                ])->onlyOnIndex(),
            AssociationField::new('technologies', 'Technologies')
                ->setFormTypeOptions([
                    'by_reference' => false,
                    'multiple' => true,
                    'choice_label' => 'name',
                ]),
            AssociationField::new('projectImages', 'Images')->onlyOnIndex(),
            CollectionField::new('Links', 'Créer des liens externe')
                ->setEntryType(LinkType::class)
                ->setFormTypeOptions([
                    'required' => true,
                ])
                ->allowAdd()
                ->allowDelete()
                ->onlyOnForms(),
            CollectionField::new('projectImages', 'Ajouter des images')
                ->setEntryType(ProjectImageType::class)->onlyOnForms(),

        ];
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setUpdatedAt(new \DateTimeImmutable());
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
}
