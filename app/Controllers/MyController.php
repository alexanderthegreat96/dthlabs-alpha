<?php
namespace App\Controllers;
use Illuminate\Support\Str;
use LexSystems\Core\System\Extend\Validation;
use LexSystems\Core\System\Helpers\Debugger;
use LexSystems\Framework\Core\Kernel\Controller;
use LexSystems\Framework\Kernel\Helpers\CoreUtils\Hash;
use LexSystems\Core\System\Helpers\Database\DB;
class MyController extends Controller
{
    public function indexAction()
    {
//        Debugger::var_dump($this->request->getArguments());
//
//        $test = DB::table('dth_auth_users')->paginate('15');
//        Debugger::var_dump( Validation::validate([],[]));
//
//        if($this->request->hasFile('my_file'))
//        {
//
//        }

        $elements =
            [
                [
                    'type' => 'file',
                    'label' => 'Select your files',
                    'id'  => 'files',
                    'name' => 'data[]',
                    'multiple' => 'true'
                ],
                [
                    'type' => 'submit',
                    'name' => 'submit',
                    'value' => 'Upload',
                    'class' => 'submit'
                ]
            ];

        $form =
            [
                'method' => 'POST',
                'enctype' => 'multipart/form-data',
                'action' => '/upload',
                'display'  => 'grid'
            ];

        $uploadForm = $this->system->arrayForm($elements,$form);

        return $uploadForm->build();
    }
}
