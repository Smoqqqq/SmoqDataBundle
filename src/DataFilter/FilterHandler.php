<?php

namespace Smoq\DataBundle\DataFilter;

use Smoq\DataBundle\DataSource\DataSourceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class FilterHandler
{
    private Request $request;

    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getMainRequest();
    }

    /**
     * returns the filtered data from the data source after applying the filters
     */
    public function getFilteredDataFromDataSource(DataSourceInterface $dataSource): array
    {
        $queryBuilder = $dataSource->configureQuery();
        $filterForm = $dataSource->getForm();
        $session = $this->request->getSession();
        $sessionKey = $dataSource->getIdentifier() . '_filters';

        if ($filterForm) {
            $filterForm->handleRequest($this->request);

            // Load filters from request
            if ($filterForm->isSubmitted() && $filterForm->isValid()) {
                $queryBuilder = $dataSource->applyFilters($filterForm->getData(), $queryBuilder);
                $session->set($sessionKey, $filterForm->getData());
            } else if ($session->has($sessionKey)) {
                // Load filters from session
                $filters = $session->get($sessionKey);
                $queryBuilder = $dataSource->applyFilters($filters, $queryBuilder);
            }
        }

        return $queryBuilder->getQuery()->getResult();
    }
}