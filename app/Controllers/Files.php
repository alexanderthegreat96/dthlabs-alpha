<?php
namespace App\Controllers;
use LexSystems\Core\System\Helpers\Debugger;
use LexSystems\Core\System\Helpers\FileSystem;
use LexSystems\Framework\Core\Kernel\Controller;
use Mpdf\Tag\P;

class Files extends Controller
{
    public function uploadFilesAction()
    {
       if($this->request->hasFiles())
       {
           $files = $this->request->getFiles();
           foreach($files['files'] as $file)
           {
                try{
                    FileSystem::copyFile($file['name'],$file['tmp_name'],'folder-2020');
                }
                catch (\Exception $e)
                {
                    echo $e->getMessage(). '<br/>';
                }
           }
       }
    }
}