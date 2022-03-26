<?php
namespace App\Controllers;
use Core\Controller;
use Core\Debugger;
use Core\Request;
use Core\View;
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

        Debugger::var_dump(Request::getArguments());
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
