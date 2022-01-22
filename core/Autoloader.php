<?php
namespace LexSystems\Framework\Core;
class Autoloader {
    /**
     * @param string $directory
     */
    public static function load(string $directory) {
        if(is_dir($directory)) {
            $scan = scandir($directory);
            unset($scan[0], $scan[1]); //unset . and ..
            foreach($scan as $file) {
                if(is_dir($directory."/".$file)) {
                    self::load($directory."/".$file);
                } else {
                    if(pathinfo($file)['extension'] == 'php')
                    {
                        require($directory."/".$file);
                    }
                }
            }
        }
    }

    /**
     * @param string $directory
     */

    public static function loadComposerLibs(string $directory) {
        if(is_dir($directory)) {
            $scan = scandir($directory);
            unset($scan[0], $scan[1]); //unset . and ..
            foreach($scan as $file) {
                if(is_dir($directory."/".$file)) {
                    self::loadComposerLibs($directory."/".$file);
                } else {
                    /**
                     * Autoload composer libraries?
                     */
                        if($file == 'autoload.php')
                        {
                            require($directory."/autoload.php");
                        }
                }
            }
        }
    }



}
