<?php
namespace OhPage;

class PaginateHelper
{
    /**
     * @var integer
     */
    public $currentPage = 1;

    /**
     * @var integer
     */
    public $perPage = 10;

    /**
     * @var integer
     */
    public $totalPages = 1;

    /**
     * @var integer
     */
    public $totalResults = 0;

    /**
     * @var integer
     */
    public $skip = 0;

    public function __construct($perPage, $currentPage, $totalResults)
    {
        $this->cleanPerPage($perPage);
        $this->cleanCurrentPage($currentPage);
        $this->cleanTotalResults($totalResults);
        $this->establishTotalPages();
        $this->establishSkip();
    }

    /**
     * Get the total number of pages
     *
     * @return integer
     */
    public function getTotalPages()
    {
        return $this->totalPages;
    }

    /**
     * Get the current page
     *
     * @return integer
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * Get the total number of results in the set
     *
     * @return integer
     */
    public function getTotalResults()
    {
        return $this->totalResults;
    }

    /**
     * Get the query limit number (per page)
     *
     * @return integer
     */
    public function getQueryLimit()
    {
        return $this->perPage;
    }

    /**
     * Get the query offset (skip) number
     *
     * @return integer
     */
    public function getQueryOffset()
    {
        return $this->skip;
    }

    /**
     * Establish the number of results to skip, or the offset
     */
    private function establishSkip()
    {
        $this->skip = (($this->currentPage * $this->perPage) - $this->perPage);
        if ($this->skip < 0) {
            $this->skip = 0;
        }
    }

    /**
     * Establish the total number of pages
     */
    private function establishTotalPages()
    {
        $this->totalPages = (int) ceil($this->totalResults / $this->perPage);
        if ($this->currentPage > $this->totalPages) {
            $this->currentPage = $this->totalPages;
        }
    }

    /**
     * Clean the total results
     * @param integer $totalResults
     */
    private function cleanTotalResults($totalResults)
    {
        $this->totalResults = $totalResults;
        if (!is_numeric($this->totalResults) || $this->totalResults < 1) {
            $this->totalResults = 0;
        }
        $this->totalResults = (int) $this->totalResults;
    }

    /**
     * Clean the per page
     * @param integer $perPage
     */
    private function cleanPerPage($perPage)
    {
        $this->perPage = $perPage;
        if (!is_numeric($this->perPage) || $this->perPage < 1) {
            $this->perPage = 10;
        }
        $this->perPage = (int) $this->perPage;
    }

    /**
     * Clean the current page
     * @param integer $currentPage
     */
    private function cleanCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
        if (!is_numeric($this->currentPage) || $this->currentPage < 1) {
            $this->currentPage = 1;
        }
        $this->currentPage = (int) $this->currentPage;
    }
}
