<?php
namespace App\Controllers;
use App\Models\Users;
use Core\Validation;
use Core\ArrayUtility;
use Core\Hash;
use Core\IlluminateDb;
use Core\Debugger;
use Core\Controller;

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
        $rules = array(
            'username' => ['required', 'min:3', 'max:20'],
            'password' => ['required', 'min:5', 'max:60']
        );
        $messages = array(
            'username.required' => 'Username is required.',
            'username.min' => 'Username must be at least :min characters.',
            'username.max' => 'Username must be no more than :max characters.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least :min characters.',
            'password.max' => 'Password must be no more than :max characters.',
        );

        $validate = Validation::validate($rules,$messages);

        if($validate['status'])
        {
            $username = $this->request->getArgument('username','POST');
            $password = $this->request->getArgument('password', 'POST');

            $fetch = IlluminateDb::table('users')
                ->where('username','=',$username)
                ->orWhere('email', '=', $username)
                ->first();

            if($fetch)
            {
                $user_id = $fetch->id;
                $username = $fetch->username;
                $hash = $fetch->password;
                $rank = $fetch->rank;

                if(Hash::check($hash,$password))
                {
                    $this->session->sendTheseToSession(
                        [
                            'logged_in' => true,
                            'user_id' => $user_id,
                            'username' => $username,
                            'rank' => $rank
                        ]
                    );

                    switch ($rank)
                    {
                        case 'admin':
                            $this->request->redirect('/admin/');
                            break;
                        case 'user':
                            $this->request->redirect('/user/');
                            break;
                    }
                }
                else
                {
                    $error = 'The password you provided is incorrect. Please try again.';
                }
            }
            else
            {
                $error = 'No account associated with the deatails you provided!';
            }
        }
        else
        {
           $error = ArrayUtility::arrayToList($validate['error']);
        }

        return $error;
    }
}