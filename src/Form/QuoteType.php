<?php

namespace App\Form;

use App\Entity\Quote;
use Symfony\Component\Form\{
    AbstractType,
    FormBuilderInterface
};
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\{
    FormEvents,
    FormEvent
};
use App\Service\{
    QuoteTypeService,
    AuthorService
};

class QuoteType extends AbstractType
{

    /**
     * @required
     */
    public QuoteTypeService $typeService;

    /**
     * @required
     */
    public AuthorService $authorService;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('quote')
                ->add('type')
                ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                    $data = $event->getData();

                    foreach ($data['type'] as $key => $type) {
                        if (!is_numeric($type)) {
                            $quoteType = $this->typeService->create($type);
                            $data['type'][$key] = $quoteType->getId();
                        }
                    }

                    $event->setData($data);
                })
                ->add('author')
                ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                    $data = $event->getData();

                    if (is_numeric($data['author'])) {
                        return;
                    }

                    $author = $this->authorService->create($data['author']);
                    $data['author'] = $author->getId();

                    $event->setData($data);
                })
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Quote::class,
        ]);
    }

}
