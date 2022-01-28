<?php
namespace App\Controllers;
use App\Models\Customers;
use Delight\Db\Throwable\Exception;
use LexSystems\Core\System\Helpers\Debugger;
use LexSystems\Core\System\Helpers\FileSystem;
use LexSystems\Framework\Core\Kernel\Controller;
use LexSystems\Framework\Kernel\Helpers\CoreUtils\Hash;
use LexSystems\Core\System\Helpers\Database\IlluminateDb;
use LexSystems\Migrations\UserMigration;

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

       // Debugger::var_dump(FileSystem::removeFile('time-svgrepo-com (1).svg'));

    }
}
