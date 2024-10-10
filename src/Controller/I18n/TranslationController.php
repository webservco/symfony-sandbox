<?php

declare(strict_types=1);

namespace App\Controller\I18n;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Contracts\Translation\TranslatorInterface;

final class TranslationController extends AbstractController
{
    #[Route('/{_locale}/i18n', name: 'app_i18n', requirements: ['_locale' => '%app.supported_locales.string%'])]
    public function index(TranslatorInterface $translator): Response
    {
        return $this->render(
            'app/i18n/translations.html.twig',
            [
                // {{ message | trans }}
                'message_translatable' => new TranslatableMessage('test.home.message', ['name' => 'haver']),
                // {{ message }}
                'message_translated' => $translator->trans('test.home.message', ['name' => 'haver']),
                // Or directly in twig: {% trans %}test.home.title{% endtrans %}
                'title' => $translator->trans('test.home.title'),
            ],
        );
    }
}
