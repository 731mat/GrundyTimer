<?php

namespace App\Presenters;

use Nette;
use App\Model;
use App\Model\InfoManager;
use App\Model\KategorieManager;
use Nette\Application\UI\Form;



class HomepagePresenter extends BasePresenter
{

    private $infoManager;
    private $kategorieManager;


    function __construct(InfoManager $infoManager, KategorieManager $kategorieManager) {
        $this->infoManager = $infoManager;
        $this->kategorieManager = $kategorieManager;
    }

	public function renderDefault()
	{
		$this->template->dataInfo = $this->infoManager->getAll();
        $this->template->dataKategorie = $this->kategorieManager->getPoleObsazeniKategorie();
	}

    public function renderEdit($id){
        $article = $this->infoManager->getAll();
        $this['infoForm']->setDefaults($article);
    }
    protected function createComponentInfoForm()
    {
        $form = new Form;
        $form->addText('name', 'Název události:');
        $form->addText("date", "Datum")
            ->setRequired("Datum je povinný údaj!")
            ->setAttribute("class", "dtpicker")
            ->setAttribute("placeholder", "dd.mm.rrrr");
        $form->addText("adress", "Místo konání")
            ->setRequired("Povinný udaj")
            ->setAttribute("class", "dtpicker")
            ->setAttribute("placeholder", "prdelovice");

        $form->addSubmit('submit', 'odeslat');
        $form->onSuccess[] = [$this, 'infoFormSucceeded'];
        return $form;
    }

    // volá se po úspěšném odeslání formuláře
    public function infoFormSucceeded(Form $form, $values)
    {
        $this->infoManager->update($values);
        $this->flashMessage("update");
        $this->redirect('default');
    }

}
