<?php
namespace App\Controllers;
use LexSystems\Core\System\Extend\Validation;
use LexSystems\Framework\Core\Kernel\Controller;

class Login extends Controller
{
    public function indexAction()
    {
        $elements =
            [
                [
                    'type' => 'text',
                    'label' => 'Username',
                    'id'  => 'username',
                    'placeholder' => 'Type your username',
                    'maxlength' => '20',
                    'name' => 'username',
                    'value'  => $this->request->getFormValue('username')
                ],
                [
                    'label' => 'Password',
                    'type' => 'password',
                    'id'  => 'password',
                    'placeholder' => 'Type your password',
                    'maxlength' => '20',
                    'name' => 'password',
                    'value' => $this->request->getFormValue('password')
                ],
                [
                    'type' => 'submit',
                    'name' => 'submit',
                    'value' => 'Login',
                    'class' => 'submit'
                ]
            ];

        $form =
            [
                'method' => 'POST',
                'action' => '/login/try',
                'display'  => 'grid'
            ];

        $login = $this->system->arrayForm($elements,$form);

        $this->view->renderTemplate('login',['form' => $login->build()]);
    }

    public function tryAction()
    {
        $this->request->getArgument('','');
        Debugger::var_dump($this->request->getArguments());
        $this->system->validateInputs('');


    }
}