<?php

namespace App\Presenters;

use Nette;
use App\Model\KategorieManager;
use Nette\Application\UI\Form;

class KategoriePresenter extends BasePresenter
{
    private $KategorieManager;

    function __construct(KategorieManager $kategorieManager) {
        $this->KategorieManager = $kategorieManager;
    }


    public function actionDelete($id){
        $this->KategorieManager->delete($id);
        $this->flashMessage("smazáno");
        $this->redirect("default");
    }

    public function renderDefault()
    {
        $this->template->data = $this->KategorieManager->getAll();
    }
    public function renderEdit($id){
        $kategorie = $this->KategorieManager->getById($id);
        $this['kategorieForm']->setDefaults($kategorie);
    }

    protected function createComponentKategorieForm()
    {
        $form = new Form;
        $form->addText('name', 'název:');
        $form->addSubmit('submit', 'odeslat');
        $form->onSuccess[] = [$this, 'kategorieFormSucceeded'];
        return $form;
    }

    // volá se po úspěšném odeslání formuláře
    public function kategorieFormSucceeded(Form $form, $values)
    {
        $id = $this->getParameter('id');
        if ($id) {
            $this->KategorieManager->update($id, $values);
            $this->flashMessage("update");
        }else{
            $this->KategorieManager->insert($values);
        }
        $this->redirect('default');
    }
}