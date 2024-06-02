<?php

namespace App\Form;

use App\Entity\Link;
use App\Entity\LinkIcon;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class LinkType extends AbstractType
{


  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('path', TextType::class, ['label' => "url",  'required' => true])
      ->add('name', TextType::class, ['label' => "name",  'required' => true])
      ->add('linkIcon', EntityType::class, [
        'class' => LinkIcon::class,
        'choice_label' => 'name',
        'label' => 'Icon',
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Link::class,
    ]);
  }
}
