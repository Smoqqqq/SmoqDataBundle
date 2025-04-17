<?php

namespace Smoq\DataBundle\DataTable;

use Smoq\DataBundle\DataSource\DataSourceInterface;
use Symfony\Component\Form\FormView;

interface DataTableInterface
{
    public function getDataSource(): DataSourceInterface;
    public function getData(): array;
    public function getForm(): ?FormView;
}