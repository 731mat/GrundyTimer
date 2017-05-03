<?php

namespace App\Presenters;

use Nette;
use App\Model\KategorieManager;
use Nette\Application\UI\Form;

class KategoriePresenter extends BasePresenter
{
    private $KategorieManager;

    public function startup(){
        parent::startup();
        if (!$this->userData->isLoggedIn()){
            $this->flashMessage("Nemáš oprávnění");
            $this->redirect("Homepage:");
        }
    }

    function __construct(KategorieManager $kategorieManager) {
        $this->KategorieManager = $kategorieManager;
    }


    public function actionDelete($id){
        if($this->KategorieManager->delete($id))
            $this->flashMessage("smazáno");
        else
            $this->flashMessage("v kategorii jsou uživatelé ! odstaň uživatele !!");
        $this->redirect("default");
    }

    public function renderDefault()
    {
        $this->template->data = $this->KategorieManager->getAll();
    }
    public function renderEdit($id){
        $kategorie = $this->KategorieManager->getById($id);
        $vystup = array();
        $vystup['min_time'] = $kategorie['min_time']->format("%H:%I:%S");
        $vystup['name'] = $kategorie['name'];
        $vystup['count_round'] = $kategorie['count_round'];
        $this['kategorieForm']->setDefaults($vystup);
    }

    protected function createComponentKategorieForm()
    {
        $form = new Form;
        $form->addText('name', 'název:');
        $form->addText('min_time','Minimální čas:')
            ->setRequired()
            ->addRule(Form::PATTERN, 'HH:MM:SS', '([0-1]?\d|2[0-3]):([0-5]?\d):([0-5]?\d)');
        $form->addText('count_round', 'pocet kol:')
            ->setType('number')
            ->setRequired(FALSE)
            ->addRule(Form::RANGE, 'kola musí být v rozsahu', [1, 120]);
        $form->addSubmit('submit', 'odeslat');
        $form->onSuccess[] = [$this, 'kategorieFormSucceeded'];
        $this->renderForm($form);
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