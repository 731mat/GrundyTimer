<?php

namespace App\Presenters;

use Nette;
use App\Model\SouteziciManager;
use App\Model\KategorieManager;
use Nette\Application\UI\Form;

class SouteziciPresenter extends BasePresenter
{
    private $SouteziciManager;
    private $KategorieManager;

    function __construct(SouteziciManager $souteziciManager, KategorieManager $kategorieManager) {
        $this->SouteziciManager = $souteziciManager;
        $this->KategorieManager = $kategorieManager;
    }

    public function actionDelete($id){
        $this->SouteziciManager->delete($id);
        $this->flashMessage("smazáno");
        $this->redirect("default");
    }

    public function renderDefault($order = 'start_number')
    {
        $this->template->data = $this->SouteziciManager->getAll($order);
    }

    public function renderEdit($id){
        $article = $this->SouteziciManager->getById($id);
        $this['souteziciForm']->setDefaults($article);
    }
    protected function createComponentSouteziciForm()
    {
        $form = new Form;
        $form->addText('start_number', 'start číslo:');
        $form->addText('first_name', 'jmeno:');
        $form->addText('last_name', 'přijmeni:');
        $form->addText('birth_year', 'datum narozeni:');
        $form->addSelect('category', 'kategorie',$this->KategorieManager->getPole());
        $form->addSubmit('submit', 'odeslat');
        $form->onSuccess[] = [$this, 'souteziciFormSucceeded'];
        return $form;
    }

    // volá se po úspěšném odeslání formuláře
    public function souteziciFormSucceeded(Form $form, $values)
    {
        $id = $this->getParameter('id');
        if ($id) {
            $this->SouteziciManager->update($id, $values);
            $this->flashMessage("update");
        }else{
            $this->SouteziciManager->insert($values);
        }
        $this->redirect('default');
    }
}