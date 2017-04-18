<?php

namespace App\Presenters;

use Nette;
use App\Model;
use App\Model\InfoManager;



class HomepagePresenter extends BasePresenter
{

    private $infoManager;

    function __construct(InfoManager $infoManager) {
        $this->infoManager = $infoManager;
    }

	public function renderDefault()
	{
		$this->template->data = $this->infoManager->getAll();
	}

}
