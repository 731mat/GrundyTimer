<?php

namespace App\Presenters;

use Nette;
use App\Model;
use Nette\Security\User;
use Nette\Security\Authenticator;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

    /** @var Nette\Security\User @inject */
    public $userData;

    public function startup()
    {
        parent::startup();
        $this->userData = $this->getUser();

    }

    public function beforeRender()
    {
        $this->template->user = $this->userData;

    }

}
