<?php

namespace Smoq\DataBundle\Twig\Components;

use Smoq\DataBundle\DataTable\DataTableInterface;
use Symfony\UX\LiveComponent\DefaultActionTrait;

class DataTableComponent
{
    use DefaultActionTrait;

    public DataTableInterface $datatable;
}