<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Address;
use Override;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * extends is for psalm: https://github.com/psalm/psalm-plugin-symfony/issues/294
 *
 * @extends \Symfony\Component\Form\AbstractType<\App\Entity\Address|null>
 */
final class AddressFormType extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface<\App\Entity\Address|null> $builder
     * @phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     * @phpcs:ignore SlevomatCodingStandard.TypeHints.DisallowMixedTypeHint.DisallowedMixedTypeHint
     * @param array<mixed> $options
     * @suppress PhanUnusedPublicFinalMethodParameter
     */
    #[Override]
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('clientId', null, [
                /* One way to validate. See Address entity attributes for another way.
                 * 'constraints' => [
                    new Length(exactly: 6, exactMessage: 'ID must be exactly {{ limit }} characters.'),
                ],*/
                'help' => 'PV Client ID',
            ])
            ->add('name')
            ->add('address1')
            ->add('city')
            ->add('postalCode');
        $this->handleState($builder);
        $this->handleCountry($builder);
    }
    // @phpcs:enable

    #[Override]
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

    /**
     * @todo study further
     * @param \Symfony\Component\Form\FormBuilderInterface<\App\Entity\Address|null> $builder
     * @return \Symfony\Component\Form\FormBuilderInterface&\Symfony\Component\Form\FormBuilderInterface<\App\Entity\Address|null>
     */
    private function handleCountry(FormBuilderInterface $builder): FormBuilderInterface
    {
        return $builder->add('country', ChoiceType::class, [
            'choices' => [
                'France' => 'FR',
                'Germany' => 'DE',
                'Italy' => 'IT',
                'Switzerland' => 'CH',
            ],
            'placeholder' => 'Choose a country',
        ]);
    }

    /**
     * @todo study further
     * @param \Symfony\Component\Form\FormBuilderInterface<\App\Entity\Address|null> $builder
     * @return \Symfony\Component\Form\FormBuilderInterface&\Symfony\Component\Form\FormBuilderInterface<\App\Entity\Address|null>
     */
    private function handleState(FormBuilderInterface $builder): FormBuilderInterface
    {
        return $builder->add('state', ChoiceType::class, [
            'choices' => [
                'TODO populate based on country' => 'MI',
            ],
            'placeholder' => 'Choose a state',
            // When specifying the type parameter, the form type guessing sys does nothing.
            'required' => false,
        ]);
    }
}
