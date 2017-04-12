<?php

namespace App\Presenters;


use Nette;
use App\Model\RaceManager;
use App\Model\KategorieManager;
use Nette\Application\UI\Form;

class StartPresenter extends BasePresenter
{

    private $raceManager;
    private $kategorieManager;

    function __construct(RaceManager $raceManager, KategorieManager $kategorieManager) {
        $this->raceManager = $raceManager;
        $this->kategorieManager = $kategorieManager;
    }

    public function renderDefault()
    {

    }

    protected function createComponentStartForm()
    {
        $form = new Form;
        $form->addCheckboxList('category', 'název:', $this->kategorieManager->getPole());
        $form->addSubmit('submit', 'odeslat');
        $form->onSuccess[] = [$this, 'startFormSucceeded'];
        return $form;
    }

    // volá se po úspěšném odeslání formuláře
    public function startFormSucceeded(Form $form, $values)
    {
        $this->raceManager->peopleStart($values);
    }
}