<?php

namespace App\Form;

use App\DTO\ContactDTO;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'required' => false,
                    'empty_data' => '',
                    'row_attr' => [
                        'class' => 'flex flex-col'
                    ],
                    'label_attr' => [],
                    'attr' => [
                        'minlength' => '3',
                        'maxlength' => '200',
                        'class' => 'w-full h-10 text-color placeholder-gray-500 bg-transparent p-2 border-color outline-0 rounded focus:border-[#2276f5] focus:border-[1px] border-[1px]'
                    ]
                ]
            )
            ->add('email', EmailType::class, [
                'empty_data' => '',
                'required' => false,
                'row_attr' => array(
                    'class' => 'flex flex-col'
                ),
                'label_attr' => [],
                'attr' =>
                [
                    'class' => 'w-full h-10 text-color placeholder-gray-500 bg-transparent p-2 border-color outline-0 rounded focus:border-[#2276f5] focus:border-[1px] border-[1px]'
                ],
            ])
            ->add('contactType', ChoiceType::class, [
                'choices'  => [
                    'Creation of a site' =>  0,
                    'Implement functionality' => 1,
                    'A job' =>  2,
                    'Other' => 3,
                ],
                'label_attr' => [],
                'choice_attr' => function () {
                    return ['class' => 'text-black'];
                },
                'attr' =>
                [
                    'class' => 'w-full h-10 text-color placeholder-gray-500 bg-transparent p-2 border-color outline-0 rounded focus:border-[#2276f5] focus:border-[1px] border-[1px] mt-4'
                ],
            ])
            ->add('message', TextareaType::class, [
                'required' => false,
                'empty_data' => '',
                'label_attr' => [],
                'attr' =>
                [
                    'minlength' => '10',
                    'rows' => '10',
                    'class' => 'w-full text-color placeholder-gray-500 bg-transparent p-2 border-color outline-0 rounded focus:border-[#2276f5] focus:border-[1px] border-[1px] resize-none'
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => false,
                'required' => true,

            ])
            ->add('save', SubmitType::class, [
                'label' => 'submit',
                'attr' => [
                    'class' => 'bg-blue w-full  max-lg:mt-6 h-10 rounded-sm   hover:opacity-95 active:opacity-80 cursor-pointer'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactDTO::class,
        ]);
    }
}
