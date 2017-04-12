<?php

namespace App\Presenters;

use Nette\Application\Responses;
use App\Model\RaceManager;
use App\Model\SouteziciManager;
use Nette;

class ControllerPresenter extends BasePresenter
{

    private $raceManager;
    private $souteziciManager;

    function __construct(RaceManager $raceManager, SouteziciManager $souteziciManager) {
        $this->raceManager = $raceManager;
        $this->souteziciManager = $souteziciManager;
    }

    public function renderDefault(){
        $this->template->tlacitka = $this->souteziciManager->getPeopleInSomeRace();
    }

    public function actionJson()
    {
        $vystup = array();
        foreach ($this->souteziciManager->getAll() as $people){
            $a = array( "id" => $people['id'], "start_number" => $people['start_number'], "cout_round" => $people['countRound'] );
            array_push($vystup,$a);
        }
        $this->sendResponse( new Nette\Application\Responses\JsonResponse($vystup) );
    }

    public function actionKolo($id){
        $this->raceManager->addRound($id);
        $this->redirect("default");
    }

}