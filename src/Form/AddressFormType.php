<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddressFormType extends AbstractType
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     * @phpcs:ignore SlevomatCodingStandard.TypeHints.DisallowMixedTypeHint.DisallowedMixedTypeHint
     * @param array<mixed> $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('clientId', null, [
                'help' => 'PV Client ID',
            ])
            ->add('name')
            ->add('address1')
            ->add('city')
            ->add('postalCode')
            ->add('state')
            ->add('country');
    }
    // @phpcs:enable

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            /**
             * Bind the form to the Address class (can be any php class)
             * The form type guessing system will try to guess the form type for each field.
             */
            'data_class' => Address::class,
        ]);
    }
}
