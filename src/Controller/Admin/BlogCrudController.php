<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use App\Form\BlogImageType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BlogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Blog::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle('index', "Blog")
            ->setPageTitle('edit', 'Modification d\'un article de Blog')
            ->setPageTitle('detail', 'Détails d\'un article de blog')
            ->setPageTitle('new', 'Création d\'un article de Blog')
            ->setDateFormat('   dd/MM/Y');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name', "Titre"),
            TextField::new('detail', 'Article')->onlyOnIndex(),
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
            CollectionField::new('blogImages', 'Ajouter des images')
                ->setEntryType(BlogImageType::class)->onlyOnForms(),



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
