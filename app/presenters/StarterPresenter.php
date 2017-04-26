<?php

namespace App\Presenters;


use Nette;
use App\Model\RaceManager;
use App\Model\KategorieManager;
use Nette\Application\UI\Form;

class StarterPresenter extends BasePresenter
{

    private $raceManager;
    private $kategorieManager;

    public function startup(){
        parent::startup();
        if (!$this->userData->isLoggedIn()){
            $this->flashMessage("Nemáš oprávnění");
            $this->redirect("Homepage:");
        }
    }

    function __construct(RaceManager $raceManager, KategorieManager $kategorieManager) {
        $this->raceManager = $raceManager;
        $this->kategorieManager = $kategorieManager;
    }

    public function renderDefault()
    {
        $this->redirect(':start');
    }

    protected function createComponentStartForm()
    {
        $form = new Form;
        $form->addCheckboxList('category', 'název:', $this->kategorieManager->getPole());
        $form->addSubmit('submit', 'odeslat');
        $form->onSuccess[] = [$this, 'startFormSucceeded'];
        $this->renderForm($form);
        return $form;
    }

    // volá se po úspěšném odeslání formuláře
    public function startFormSucceeded(Form $form, $values)
    {
        $this->raceManager->peopleStart($values);
        $this->flashMessage("Odstartováno !!!!!!!!");
    }

    protected function createComponentStopForm()
    {
        $form = new Form;
        $form->addCheckboxList('category', 'název:', $this->kategorieManager->getPole());
        $form->addSubmit('submit', 'odeslat');
        $form->onSuccess[] = [$this, 'stopFormSucceeded'];
        $this->renderForm($form);
        return $form;
    }

    // volá se po úspěšném odeslání formuláře
    public function stopFormSucceeded(Form $form, $values)
    {
        $this->raceManager->peopleStop($values);
        $this->flashMessage("STOPnuto !!!!!!!!");
    }

    protected function createComponentResetForm()
    {
        $form = new Form;
        $form->addCheckboxList('category', 'název:', $this->kategorieManager->getPole());
        $form->addSubmit('submit', 'odeslat');
        $form->onSuccess[] = [$this, 'resetFormSucceeded'];
        $this->renderForm($form);
        return $form;
    }

    // volá se po úspěšném odeslání formuláře
    public function resetFormSucceeded(Form $form, $values)
    {
        $this->raceManager->peopleReset($values);
        $this->flashMessage("reset !!!!!!!!");
    }
}