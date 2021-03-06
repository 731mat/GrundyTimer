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

    public function startup(){
        parent::startup();
        if (!$this->userData->isLoggedIn()){
            $this->flashMessage("Nemáš oprávnění");
            $this->redirect("Homepage:");
        }
    }

    function __construct(RaceManager $raceManager, SouteziciManager $souteziciManager) {
        $this->raceManager = $raceManager;
        $this->souteziciManager = $souteziciManager;
    }

    public function renderTabletButton(){
        $this->template->tlacitka = $this->souteziciManager->getPeopleStarted();
    }

    public function renderTabletNumber(){
    }

    public function renderDisplay($id){
        $this->template->countRow = $id;
    }

    public function actionJsondisplay($id)
    {
        $vystup = array();
        foreach ($this->souteziciManager->getPoepleForControllerDisplay($id) as $people){
            $a = array( "id" => $people['id'], "start_number" => $people['start_number'], "cout_round" => $people['countRound'], "odstartu" =>$people['odstartu']);
            array_push($vystup,$a);
        }
        $this->sendResponse( new Nette\Application\Responses\JsonResponse($vystup) );
    }

    public function actionJson()
    {
        $vystup = array();
        foreach ($this->souteziciManager->getPoepleForController() as $people){
            $a = array( "id" => $people['id'], "start_number" => $people['start_number'], "cout_round" => $people['countRound'], "enable" =>$people['enable']);
            array_push($vystup,$a);
        }
        $this->sendResponse( new Nette\Application\Responses\JsonResponse($vystup) );
    }

    public function actionKolo($id)
    {
        if ($this->souteziciManager->stepDownRound($id)) {
            $this->raceManager->addRound($id);
            $this->sendResponse(new Nette\Application\Responses\JsonResponse(["odpoved" => 'true']));
        }
        $this->sendResponse(new Nette\Application\Responses\JsonResponse(["odpoved" => 'false']));
    }

}