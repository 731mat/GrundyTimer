<?php

namespace App\Presenters;

use App\Model\KategorieManager;
use App\Model\RaceManager;
use App\Model\SouteziciManager;
use Nette;

class VysledkyPresenter extends BasePresenter
{

    private $raceManager;
    private $souteziciManager;
    private $kategorieManager;

    function __construct(RaceManager $raceManager, SouteziciManager $souteziciManager, KategorieManager $kategorieManager) {
        $this->raceManager = $raceManager;
        $this->souteziciManager = $souteziciManager;
        $this->kategorieManager = $kategorieManager;
    }

    public function renderDefault(){

        $this->template->data = $this->souteziciManager->getPeopleInFinnish();
        $this->template->maxCulom = $this->kategorieManager->getMaxRoundInCategory();
    }


}