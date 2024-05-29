<?php

namespace App\Form;

use App\Entity\Link;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class LinkType extends AbstractType
{


  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('path', TextType::class, ['label' => "url"])->setRequired(true)
      ->add('name', TextType::class, ['label' => "nom"])->setRequired(true)
      ->add('label', TextType::class, ['label' => "label"])->setRequired(true)
      ->add('icon', TextareaType::class, ['label' => "code SVG de l'icône"])->setRequired(true);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Link::class,
    ]);
  }
}
