<?php
namespace App\Controllers;
use LexSystems\Core\App\FileSystem;
use LexSystems\Core\App\Request;
use LexSystems\Core\System\Helpers\Debugger;
use LexSystems\Framework\Core\Kernel\Controller;
class MyController extends Controller
{
    public function index()
    {
        $filename = 'myfile.txt';
        $contents = 'THis is my file';

        echo '
            <form action="try" method="POST" enctype="multipart/form-data">
            <input type="file" name="file[]" multiple=""/>
            <button type="submit">Upload</button>
            </form>
        ';
    }

    public function upload()
    {
        if(Request::hasFile('file'))
        {
            Debugger::var_dump(FileSystem::getStoragePath());
            Debugger::var_dump(Request::bulkUpload('file'));
        }
    }
}
