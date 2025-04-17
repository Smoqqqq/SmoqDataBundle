<?php

namespace Smoq\DataBundle\DataTable;

use Smoq\DataBundle\DataSource\DataSourceInterface;
use Symfony\Component\Form\FormView;

abstract class DataTable implements DataTableInterface
{
    public function getData(): array
    {
        return $this->getDataSource()->getData();
    }

    public function getForm(): ?FormView
    {
        return $this->getDataSource()->getFormView();
    }

    public function getDataSource(): DataSourceInterface
    {
        throw new \LogicException('You must implement the getDataSource method in your data table class to return a '.DataSourceInterface::class.' instance.');
    }
}