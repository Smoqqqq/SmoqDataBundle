<?php

namespace Smoq\DataBundle\DataSource;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

interface DataSourceInterface
{
    /**
     * Configures the default query
     */
    public function configureQuery(): QueryBuilder;

    /**
     * Apply filters to the query builder.
     */
    public function applyFilters(mixed $data, QueryBuilder $queryBuilder): QueryBuilder;

    /**
     * Identifier used internally to identify the data source.
     */
    public function getIdentifier(): string;

    /**
     * Configure the filters form class
     *
     * @return ?class-string<FormInterface>
     */
    public function getFilterFormType(): ?string;
    public function buildForm(): ?FormInterface;
    public function getForm(): ?FormInterface;
    public function getFormView(): ?FormView;
    public function getData(): array;
}