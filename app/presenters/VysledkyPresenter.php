<?php

namespace App\Presenters;

use App\Model\RaceManager;
use App\Model\SouteziciManager;
use Nette;

class VysledkyPresenter extends BasePresenter
{

    private $raceManager;
    private $souteziciManager;

    function __construct(RaceManager $raceManager, SouteziciManager $souteziciManager) {
        $this->raceManager = $raceManager;
        $this->souteziciManager = $souteziciManager;
    }

    public function renderDefault(){
        $this->template->data = $this->souteziciManager->getPeopleInFinnish();
    }


}