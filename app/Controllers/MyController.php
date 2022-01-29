<?php
namespace App\Controllers;
use App\Models\DthAuthUsers;
use App\Models\Users;
use LexSystems\Core\System\Helpers\CoreUtils\Hash;
use LexSystems\Framework\Core\Kernel\Controller;
class MyController extends Controller
{
    public function indexAction()
    {
        $elements =
            [
                [
                    'type' => 'file',
                    'label' => 'Chose your files',
                    'id'  => 'username',
                    "multiple" => "multiple",
                    'name' => 'files[]',
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
                'action' => '/upload',
                'display'  => 'grid',
                'enctype' => 'multipart/form-data'
            ];

        $upload = $this->system->arrayForm($elements,$form);
        echo $upload->build();
    }
}
