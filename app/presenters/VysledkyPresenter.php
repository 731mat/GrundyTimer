<?php

namespace App\Presenters;

use App\Model\InfoManager;
use App\Model\KategorieManager;
use App\Model\RaceManager;
use App\Model\SouteziciManager;
use Nette\Application\UI\Form;
use Nette;

class VysledkyPresenter extends BasePresenter
{

    private $raceManager;
    private $souteziciManager;
    private $kategorieManager;
    private $infoManager;

    function __construct(RaceManager $raceManager, SouteziciManager $souteziciManager, KategorieManager $kategorieManager, InfoManager $infoManager) {
        $this->raceManager = $raceManager;
        $this->souteziciManager = $souteziciManager;
        $this->kategorieManager = $kategorieManager;
        $this->infoManager = $infoManager;
    }



    public function renderDefault(){
        $this->template->data = $this->souteziciManager->getPeopleInFinnish();
        $this->template->maxCulom = $this->kategorieManager->getMaxRoundInCategory();
        $this->template->dataInfo = $this->infoManager->getAll();
        $this->template->dataKategorie = $this->kategorieManager->getAll();
    }
    public function renderKategorie($id){
        $this->template->data = $this->souteziciManager->getPeopleInFinnishByCategory($id);
        $this->template->maxCulom = $this->kategorieManager->getMaxRoundInCategoryById($id);
        $this->template->dataKategorie = $this->kategorieManager->getById($id);
        $this->template->dataInfo = $this->infoManager->getAll();
    }

    public function renderVyber($data){
        $this->template->data = $this->souteziciManager->getPeopleInFinnish();
        $this->template->maxCulom = $this->kategorieManager->getMaxRoundInCategory();
        $this->template->dataInfo = $this->infoManager->getAll();
        $this->template->dataKategorie = $this->kategorieManager->getAll();
    }



    // volá se po úspěšném odeslání formuláře
    public function vysledekCategoryFormSucceeded(Form $form, $values)
    {
        $this->redirect(':vyber', $values['category']);
    }

    protected function createComponentVysledekCategoryForm()
    {
        $form = new Form;
        $form->addCheckboxList('category', 'název:', $this->kategorieManager->getPole());
        $form->addSubmit('submit', 'odeslat');
        $form->onSuccess[] = [$this, 'vysledekCategoryFormSucceeded'];
        $this->renderForm($form);
        return $form;
    }
}