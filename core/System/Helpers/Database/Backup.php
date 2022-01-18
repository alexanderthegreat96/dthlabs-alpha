<?php
/**
 * @author Alexandru Lupaescu
 * @package DthLabs Alpha
 * @version 2.5
 */

use LexSystems\Core\System\Helpers\Database\MySqli;
class Backup
{
    /**
     * @param string $tables
     * @param string $location
     * @param string $dbname
     * @return bool
     * @throws Exception
     */

    public static function backupMySqlTables(string $tables = '*', string $location = 'backups/mysql', string $dbname = '')
    {
        $db = new MySqli();
        $link = $db->connect($dbname);
        mysqli_query($link, "SET NAMES 'utf8'");
        if ($tables == '*') {
            $tables = array();
            $result = mysqli_query($link, 'SHOW TABLES');
            while ($row = mysqli_fetch_row($result)) {
                $tables[] = $row[0];
            }
        } else {
            $tables = is_array($tables) ? $tables : explode(',', $tables);
        }

        $return = '';
        foreach ($tables as $table) {
            $result = mysqli_query($link, 'SELECT * FROM ' . $table);
            $num_fields = mysqli_num_fields($result);
            $num_rows = mysqli_num_rows($result);

            $return .= 'DROP TABLE IF EXISTS ' . $table . ';';
            $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE ' . $table));
            $return .= "\n\n" . $row2[1] . ";\n\n";
            $counter = 1;

            for ($i = 0; $i < $num_fields; $i++) {
                while ($row = mysqli_fetch_row($result)) {
                    if ($counter == 1) {
                        $return .= 'INSERT INTO ' . $table . ' VALUES(';
                    } else {
                        $return .= '(';
                    }
                    for ($j = 0; $j < $num_fields; $j++) {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n", "\\n", $row[$j]);
                        if (isset($row[$j])) {
                            $return .= '"' . $row[$j] . '"';
                        } else {
                            $return .= '""';
                        }
                        if ($j < ($num_fields - 1)) {
                            $return .= ',';
                        }
                    }

                    if ($num_rows == $counter) {
                        $return .= ");\n";
                    } else {
                        $return .= "),\n";
                    }
                    ++$counter;
                }
            }
            $return .= "\n\n\n";
        }

        //save file
        $fileName = 'db-backup-' . time() . '-' . (md5(implode(',', $tables))) . '.sql';
        $handle = fopen($location . $fileName, 'w+');
        fwrite($handle, $return);
        if (fclose($handle)) {
            return true;
        } else {
            throw new \Exception('Unable to write sql file: ' . $fileName . 'in ' . $location);
        }
    }
}