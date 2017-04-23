<?php

namespace App\Presenters;

use App\Model\UserManager;
use Nette;
use App\Forms\SignFormFactory;
use Nette\Security\User;
use Nette\Security\IAuthenticator;
use Nette\Application\UI\Form;
use Nette\Security\Passwords;
use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;
use Tracy\Debugger;


class SignPresenter extends BasePresenter
{


    private $user;
    /**
     * Sign-in form factory.
     * @return Nette\Application\UI\Form
     */

    /**
     * @var \App\Model\UserManager
     * @inject
     */
    public $userManager;


    protected function createComponentSignInForm()
    {
        $form = new Form;
        $form->addText('name', 'Váš name: ')
            ->setAttribute('size', '40')
            ->setRequired("Zadejte prosím name.");
        $form->addPassword('password','Heslo: ')
            ->setAttribute('size','40')
            ->setRequired("Zadejte prosím heslo.");
        $form->addSubmit('submit','Přihlásit');
        $form->onSuccess[] = array($this, 'signInFormSucceeded');
        $this->renderForm($form);
        return $form;
    }

    public function signInFormSucceeded($form, $values){
        $this->user = $this->getUser();
        try {
            $this->user->login($values['name'], $values['password']);
            $this->flashMessage('Nyní jste přihlášen jako: '.$this->user->getIdentity()->roles['name'],'success');
            $this->redirect('Homepage:');

        } catch (Nette\Security\AuthenticationException $e) {
            $form->addError($e->getMessage());
        }
    }

    public function actionOut()
    {
        $this->getUser()->logout();
        $this->flashMessage('Uživatel úspěšně odhlášen.','success');
        $this->redirect('Homepage:');
    }

    protected function createComponentSignNewForm()
    {
        $form = new Form;
        $form->addText('name', '* Jméno: ')
            ->setAttribute('size', '50')
            ->addRule(Form::PATTERN,'Jméno nesmí obsahovat mezery a čísla. Pokud máte více jmen, stačí zadat to první.','^[^0-9 ]*$')
            ->setRequired('Zadejte prosím jméno.');
        $form->addPassword('password','* Heslo: ')
            ->addRule(Form::MIN_LENGTH,'Heslo musí mít alespoň 6 znaků',6)
            ->setAttribute('size', '50')
            ->setRequired('Zadejte prosím heslo.');
        $form->addPassword('password2','* Heslo znovu: ')
            ->setAttribute('size','50')
            ->setRequired('Heslo je nutné zopakovat. Zamezíte tím možným překlepům.');
        $form->addSubmit('submit','Dokončit!');
        $form->onSuccess[] = array($this, 'signNewFormSucceeded');
        $this->renderForm($form);
        return $form;
    }

    public function signNewFormSucceeded($form){
        $this->user = $this->getUser();
        $values = $form->getValues();

        if($values->password != $values->password2)
            $form->addError('Hesla se musejí shodovat');
        else {
            $arr = array(
                'name' => $values->name,
                'password' => $values->password
            );

            try {
                $this->userManager->add($arr);
                $this->flashMessage('Úspěšná registrace!', 'success');
                $this->user->login($values['name'], $values['password']);
            } catch (Nette\Database\UniqueConstraintViolationException $e) {
            }
        }
    }

}