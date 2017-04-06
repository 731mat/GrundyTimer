<?php

namespace App\Presenters;

use Nette;
use App\Model\KategorieManager;
use Nette\Application\UI\Form;

class StartPresenter extends BasePresenter
{


    public function renderDefault()
    {
        $this->redirect("homepage");
    }

}