<?php

namespace App\Controller\Admin;


use App\Entity\Project;
use App\Form\ProjectImageType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;


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
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name', 'Nom'),
            TextField::new('detail', 'Description')->onlyOnIndex(),

            TextEditorField::new('detail', 'Description')->onlyOnForms()
                ->setNumOfRows(15)
                ->setColumns(15),
            DateField::new('createdAt', 'Crée le')->hideOnForm(),
            DateField::new('updatedAt', 'Modifier le ')->hideOnForm(),
            AssociationField::new('links', 'Liens externe')
                ->setFormTypeOptions([
                    'by_reference' => false,
                    'multiple' => true,
                    'choice_label' => 'name',
                ]),
            AssociationField::new('technologies', 'Technologies')
                ->setFormTypeOptions([
                    'by_reference' => false,
                    'multiple' => true,
                    'choice_label' => 'name',
                ]),
            CollectionField::new('projectImages', 'Ajouter des images')
                ->setEntryType(ProjectImageType::class)->onlyOnForms()


        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setCreatedAt(new \DateTimeImmutable());
        $entityInstance->setUpdatedAt(new \DateTimeImmutable());
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
    public function updateEntity(EntityManagerInterface $entityManager,  $entityInstance): void
    {

        $entityInstance->setUpdatedAt(new \DateTimeImmutable());

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
}
