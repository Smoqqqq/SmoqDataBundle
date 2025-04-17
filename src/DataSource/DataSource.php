<?php

namespace Smoq\DataBundle\DataSource;

use Doctrine\ORM\QueryBuilder;
use Smoq\DataBundle\DataFilter\FilterHandler;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

abstract class DataSource implements DataSourceInterface
{
    public ?FormInterface $form = null;
    public ?FormView $formView = null;

    public function __construct(
        private readonly FormFactoryInterface $formFactory,
        private readonly FilterHandler $filterHandler,
    ) {
        $this->form = $this->buildForm();
        $this->formView = $this->form?->createView();
    }

    public function configureQuery(): QueryBuilder
    {
        throw new \LogicException('You must implement the configureQuery method in your data source class.');
    }

    public function applyFilters(mixed $data, QueryBuilder $queryBuilder): QueryBuilder
    {
        return $queryBuilder;
    }

    public function getIdentifier(): string
    {
        return static::class;
    }

    public function getFilterFormType(): ?string
    {
        return null;
    }

    public function buildForm(): ?FormInterface
    {
        return $this->getFilterFormType() ? $this->formFactory->create($this->getFilterFormType()) : null;
    }

    public function getForm(): ?FormInterface
    {
        return $this->form;
    }

    public function getFormView(): ?FormView
    {
        return $this->formView;
    }

    public function getData(): array
    {
        return $this->filterHandler->getFilteredDataFromDataSource($this);
    }
}