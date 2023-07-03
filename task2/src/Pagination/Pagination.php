<?php

namespace Task2\Pagination;

use Task2\Config\Config;

class Pagination {

    private $config;

    private int $paginationSize;

    private array $list;

    private int $currentPage;

    public function __construct(array $list, int $currentPage)
    {
        $this->config = Config::getInstance()->getAppConfig();
        $this->paginationSize = $this->config->pagination;
        $this->list = $list;
        $this->currentPage = $currentPage;
    }

    public function paginate(): array
    {
        $pagination = [];

        $remaining = count($this->list) % $this->paginationSize;
        $pages = (int) (count($this->list) / $this->paginationSize);

        if ($remaining > 0) {
            $pages += 1;
        }

        if ($this->currentPage <= $pages) {
            if ($this->currentPage === 1) {
                $pagination = [
                    'first'    => null,
                    'previous' => null,
                    'current'  => 1,
                    'next'     => $this->getNextPage($this->currentPage, $pages),
                    'last'     => ($this->getNextPage($this->currentPage, $pages) ? $pages : null),
                    'items'    => array_slice($this->list, 0, $this->paginationSize),
                ];
            } else if ($this->currentPage > 1) {
                $pagination = [
                    'first'    => 1,
                    'previous' => $this->currentPage - 1,
                    'current'  => $this->currentPage,
                    'next'     => $this->getNextPage($this->currentPage, $pages),
                    'last'     => ($this->getNextPage($this->currentPage, $pages) ? $pages : null),
                    'items'    => array_slice($this->list, (($this->currentPage - 1) * $this->paginationSize), $this->paginationSize),
                ];
            }
        } else {
            return [];
        }

        return $pagination;
    }

    private function getNextPage($currentPage, $pages)
    {
        if ($pages > $currentPage) {
            return $currentPage + 1;
        } else if ($pages === $currentPage) {
            return null;
        }
    }

}