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
    public function actionChacked($id){
        $this->SouteziciManager->chacked($id);
        $this->flashMessage("oznaceno");
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
        $form->addText('start_number', 'start číslo:')
            ->setType('number')
            ->setRequired(FALSE)
            ->addRule(Form::RANGE, 'startovaci cislo musi byt v platnem rozsahu [0, 1000] ', [0, 1000]);
        $form->addText('first_name', 'jmeno:')
            ->setRequired('Zadejte prosím jméno')
            ->addRule(Form::MIN_LENGTH, 'musí mít min 3 znaky', 3);
        $form->addText('last_name', 'přijmeni:')
            ->setRequired('Zadejte prosím příjmení')
            ->addRule(Form::MIN_LENGTH, 'musí mít min 3 znaky', 3);
        $form->addText('birth_year', 'datum narozeni:')
            ->setType('number')
            ->setRequired(FALSE)
            ->addRule(Form::RANGE, 'rocnik musi byt v rozsahu 1900 až 2200', [1900, 2200]);
        $form->addSelect('category', 'kategorie',$this->KategorieManager->getPole());
        $form->addCheckbox('chacked','ZDE');
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

    public function renderDetail($id)
    {
        $this->template->data = $this->SouteziciManager->getById($id);
        $this->template->dataCasy = $this->SouteziciManager->getRoundfromUserId($id);
    }
}