<?php

namespace App;

use App\MongoDb;

class Pagination
{
	public $perPage;
	public $currentPage;
	public $total;

	public function __construct($perPage, $currentPage, $total)
	{
		$this->perPage = $perPage;
		$this->currentPage = $currentPage;
		$this->total = $total;
	}

    public function offset()
    {
        return $this->perPage * ($this->currentPage -1);
    }


    public function totalPages()
    {
        return ceil($this->total / $this->perPage);
    }

    public function prevPage()
    {
        return $this->currentPage - 1;
    }

    public function nextPage()
    {
        return $this->currentPage + 1;
    }

    public function hasPrev()
    {
        return $this->prevPage() >= 1 ? true : false;
    }

    public function hasNext()
    {
        return $this->nextPage() <= $this->totalPages() ? true : false;
    }

	
}
