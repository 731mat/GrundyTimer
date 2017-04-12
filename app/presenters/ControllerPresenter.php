<?php

namespace App\Presenters;

use App\Model\RaceManager;
use Nette;

class ControllerPresenter extends BasePresenter
{

    private $raceManager;

    function __construct(RaceManager $raceManager) {
        $this->KategorieManager = $raceManager;
    }
    
    public function actionAddRound($id){
        $this->raceManager->delete($id);
        $this->flashMessage("přidáno");
        $this->redirect("default");
    }
}