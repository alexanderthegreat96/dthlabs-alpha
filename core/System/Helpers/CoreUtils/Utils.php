<?php

namespace LexSystems\Framework\Kernel\Helpers\CoreUtils;

/**
 * Core Functionality
 * Contains Various Functions
 * For different actions
 * (c) 2020 Alexandru Lupaescu
 */
Class Utils
{
    /**
     * Cleans Up Strings
     * Makes Sure the data is sanitized
     * and no forbidden chars are used
     */

    public function clean($string)
    {
        $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-\|]/', '', $string); // Removes special chars.
    }


    /**
     * @param int $page
     * @param int $total
     * @param int $range
     * @return array
     */

    public function paginate(int $page, int $total, int $range): array
    {
        if ($total < $range) {
            return range(1, $total);
        }

        $adjacent = floor($range/2);

        // First pages
        if ($page <= $range - $adjacent) {
            $pages = range(1, $range);

            $pages[] = '...';
            $pages[] = $total;

            return $pages;
        }

        // Last pages
        if ($page >= ($total - $range + $adjacent)) {
            $pages = range($total - $range, $total);
            array_unshift($pages, '...');
            array_unshift($pages, 1);

            return $pages;
        }

        $pages = range($page - $adjacent, $page + $adjacent);

        if (reset($pages) > 2) {
            array_unshift($pages, '...');
        }

        array_unshift($pages, 1);

        $pages[] = '...';
        $pages[] = $total;

        return $pages;
    }

    /**
     * @param string $string
     * @return false|string|string[]
     */

    public function keywordify(string $string)
    {
        $words = explode('+',$string);
        if(count($words) > 1)
        {
            foreach($words as $w)
            {
                $ww[] = $this->clean($w);
            }
            return implode('+',array_filter($ww));
        }
        else
        {
            return $words;
        }

    }
    /**
     * Redirect to a specific URI
     */
    public function redirect($url)
    {
        if (!headers_sent()) {
            header('Location: ' . $url);
        } else {
            $content = '<script type="text/javascript">';
            $content .= 'window.location.href="' . $url . '";';
            $content .= '</script>';
            $content .= '<noscript>';
            $content .= '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
            $content .= '</noscript>';
            echo $content;
        }
    }

    /**
     * Format bits to bytes,megabytes and so on
     */
    public function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;

    }

    /**
     * Generate form based on array
     */

    public function render_form(array $form_array)
    {
        if (is_array($form_array) && !empty($form_array)) {
            $form_id = $form_array["form_id"];
            $form_title = $form_array["form_title"];

            $html = "<form id='$form_id' action='".$_SERVER["REQUEST_URI"]."' method='POST'>";
            $html .= '<input type="hidden" name="form_id" value="'.$form_id.'">';
            if (isset($form_array["fields"]) && count($form_array["fields"]) > 0) {
                foreach ($form_array["fields"] as $field) {
                    $field_id = $field["id"];
                    $field_label = $field["label"];
                    $field_type = $field["type"];
                    $field_opts = $field["opts"];
                    $bound_to = $field["bound_to"];
                    $field_values = $field["values"];
                    $field_required = $field["required"];

                    if($field_required == "true")
                    {
                        $required_string = 'required = ""';
                        $required_label = '<small class="text-danger">*</small>';
                    }
                    else
                    {
                        $required_string = "";
                        $required_label = '';
                    }

                    $html .= '<input type="hidden" name="input_id[]" value="'.$field_id.'">';
                    $html .= '<div class="form-group">';
                    $html .= '<label>' . $field_label . '</label> '.$required_label.'';

                    if ($field_type == "select" && count($field_values) > 0) {
                        if ($field_opts == "multiple") {
                            $select_alter = 'multiple="muliple"';
                            $name = 'input_value['.$field_id.'][]';

                        } else {
                            $select_alter = "";
                            $name = 'input_value['.$field_id.']';

                        }

                        $html .= '<select class="form-control form-control-sm" ' . $select_alter . ' name="'.$name.'" '.$required_string.'>';
                        $html .= '<option value="0">Selectati</option>';
                        foreach ($field_values as $value) {
                            $value_id = $value["id"];
                            $value_label = $value["label"];
                            $value_int = $value["value"];

                            $html .= '<option value="' . $value_id . '">' . $value_label . '</option>';

                        }

                        $html .= '</select>';
                    } else {
                        $html .= '<input type="' . $field_type . '" class="form-control form-control-sm" placeholder="' . $field_label . '" name="input_value['.$field_id.']" '.$required_string.'/>';
                    }


                    $html .= "</div>";
                }
                $html .= '<button type="submit" class="btn btn-primary" name="submit_'.$form_id.'"><i class="fas fa-arrow-circle-right"></i>&nbsp;Continua</button>';
                $html .= "</form>";
                return $html;
            } else {
                $html = "";
            }
        } else {
            return null;
        }
    }

    /**
     * Array merge and unique
     * merge 2 arrays
     */

    public function merge_arrays(array $array, array $array2)
    {
        return array_unique(array_merge($array, $array2));
    }

    /**
     * Build URL
     * used to keep the current values in
     * used mainly for pagination purposes with
     * multiple GET params
     */
    public function build_url(array $append_params)
    {
        if (isset($_GET)) {
            foreach ($_GET as $key => $val) {
                if (in_array($key, $append_params)) {
                    unset($_GET[$key]);
                }
            }

            $url = array_merge($_GET, $append_params);

            return $_SERVER["PHP_SELF"] . "?" . http_build_query($url);
        } else {
            return null;
        }
    }

    /**
     * @param string $string
     * @return string|string[]|null
     */
    public function readableVals(string $string)
    {
        return preg_replace('/(?<!\ )[A-Z]/', ' $0', ucfirst($string));
    }

    /**
     * Build HTML table from array
     */

    /**
     * @param array $array
     * @param string $style
     * @return string
     */

    public function build_html_table(array $array, string $style = "horizontal")
    {
        if (is_array($array) && count($array) > 0) {
            if ($style == "inline") {

                $table = '<table class="table table-bordered table-hove data-view" style="font-size:13px;">';
                // header row
                $table .= '<thead class="bg-primary text-white">';
                $table .= '<tr>';
                foreach($array[0] as $key=>$value){
                    $table .= '<th>' . htmlspecialchars($this->readableVals($key)) . '</th>';
                }
                $table .= '</tr>';
                $table .= '</thead>';

                // data rows
                foreach( $array as $key=>$value){
                    $table .= '<tr>';
                    foreach($value as $key2=>$value2){
                        $table .= '<td>' . htmlspecialchars($value2) . '</td>';
                    }
                    $table .= '</tr>';
                }

                // finish table and return it

                $table .= '</table>';

            } else {
                $table = '<table class="table table-bordered table-hover" style="font-size:13px;">';
                $table .= "<tbody>";
                foreach ($array as $array_key => $array_value) {
                    if (!is_array($array_value)) {
                        $table .= "<tr><td><b>".$this->readableVals($array_key)."</b></td><td>$array_value</td></tr>";
                    } else {
                        $table .= "<tr><td>";
                        $table .= $this->build_html_table($array_value);
                        $table .= "</td></tr>";
                    }


                }
                $table .= "</tbody>";
                $table .= "</table>";
            }


            return $table;
        } else {
            return "No data found!";
        }
    }

    /**
     * @param array|null $array
     * @return array|mixed[]
     */

    public function array_flatten(array $array = []) {
        $result = array();

        if (!is_array($array)) {
            $array = func_get_args();
        }

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, self::array_flatten($value));
            } else {
                $result = array_merge($result, array($key => $value));
            }
        }

        return $result;
    }

    /**
     * @param string $price
     * @return string
     */

    public function formatPrice(string $price)
    {
        return number_format($price,'2','.',',');
    }

    /**
     * @param array $array
     * @return array
     */

    public function super_unique(array $array)
    {
        $result = array_map("unserialize", array_unique(array_map("serialize", $array)));

        foreach ($result as $key => $value)
        {
            if ( is_array($value) )
            {
                $result[$key] = self::super_unique($value);
            }
        }

        return $result;
    }
    /**
     * Date difference
     *
     */

    public function date_diff(string $start_date, string $end_date)
    {
        $date1 = strtotime($start_date);
        $date2 = strtotime($end_date);


        $diff = abs($date2 - $date1);

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24)
            / (30 * 60 * 60 * 24));

        $days = floor(($diff - $years * 365 * 60 * 60 * 24 -
                $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        $hours = floor(($diff - $years * 365 * 60 * 60 * 24
                - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24)
            / (60 * 60));

        $minutes = floor(($diff - $years * 365 * 60 * 60 * 24
                - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24
                - $hours * 60 * 60) / 60);

        $seconds = floor(($diff - $years * 365 * 60 * 60 * 24
            - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24
            - $hours * 60 * 60 - $minutes * 60));


        if($years > 0 ) $years = "<b>". $years."</b> ani"; else $years = "";
        if($months > 0 ) $months = "<b>". $months. " </b> luni"; else $months = "";
        if($days > 0 ) $days = "<b>" .$days. "</b> zile"; else $days = "";
        if($hours > 0 ) $hours = "<b>".$hours. "</b> ore"; else $hours = "";
        if($minutes > 0 ) $minutes = "<b>". $minutes. "</b> minute"; else $minutes = "";
        if($seconds > 0 ) $seconds = "<b>". $seconds. "</b> secunde"; else $seconds = "";

        return $years . " ". $months. " ". $days. " ". $hours. " ". $minutes . " ". $seconds . " ";
    }

    /**
     * @param string $string
     * @param int $limit
     * @return string|string
     * Shortens titles and descriptions
     */
    public function short_string(string $string,int $limit = 10)
    {
        if (strlen($string) >= $limit) {
            return substr($string, 0, $limit). " ... " . substr($string, -5);
        }
        else {
            return $string;
        }
    }

    /**
     * friendly format date
     */

    public function friendly_date(string $date)
    {
        return date("d-m-Y H:i:s", strtotime($date));
    }

    /**
     * Gets the full domain and folder path
     */
    /**
     * @return string
     * returns current url
     */
    public function this_url()
    {
        $http=isset($_SERVER['HTTPS']) ? 'https://' : 'http://';

        $part=rtrim($_SERVER['SCRIPT_NAME'],basename($_SERVER['SCRIPT_NAME']));

        $part = str_replace("app","",$part);
        $part = explode("/",$part);
        $part = array_filter($part);
        $part = implode("/",$part);

        $domain=$_SERVER['SERVER_NAME'];

        return "$http"."$domain"."/"."$part";
    }



    /**
     * Generate a slug based on a text input
     */

    public function slug(string $text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // trim
        $text = trim($text, '-');
        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // lowercase
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }



    /**
     * MySQL Tables Backup
     */

    public function backup_tables($link,string $tables = '*', string $relative_location = "../../backups/sql/", string $actual_location = "../backups/sql/")
    {
        mysqli_query($link, "SET NAMES 'utf8'");
        //get all of the tables
        if($tables == '*')
        {
            $tables = array();
            $result = mysqli_query($link, 'SHOW TABLES');
            while($row = mysqli_fetch_row($result))
            {
                $tables[] = $row[0];
            }
        }
        else
        {
            $tables = is_array($tables) ? $tables : explode(',',$tables);
        }

        $return = '';
        //cycle through
        foreach($tables as $table)
        {
            $result = mysqli_query($link, 'SELECT * FROM '.$table);
            $num_fields = mysqli_num_fields($result);
            $num_rows = mysqli_num_rows($result);

            $return.= 'DROP TABLE IF EXISTS '.$table.';';
            $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
            $return.= "\n\n".$row2[1].";\n\n";
            $counter = 1;

            //Over tables
            for ($i = 0; $i < $num_fields; $i++)
            {   //Over rows
                while($row = mysqli_fetch_row($result))
                {
                    if($counter == 1){
                        $return.= 'INSERT INTO '.$table.' VALUES(';
                    } else{
                        $return.= '(';
                    }

                    //Over fields
                    for($j=0; $j<$num_fields; $j++)
                    {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n","\\n",$row[$j]);
                        if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                        if ($j<($num_fields-1)) { $return.= ','; }
                    }

                    if($num_rows == $counter){
                        $return.= ");\n";
                    } else{
                        $return.= "),\n";
                    }
                    ++$counter;
                }
            }
            $return.="\n\n\n";
        }

        //save file
        $fileName = 'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
        $handle = fopen($relative_location.$fileName,'w+');
        fwrite($handle,$return);
    }

    /**
     * Removes all files from a directory
     */
    public function remove_files($path)
    {
        $files = glob($path.'/*'); //get all file names
        foreach($files as $file){
            if(is_file($file))
                unlink($file); //delete file
        }
    }


    /**
     * @param string $table
     * @param array $columns
     * @param array $values
     * @return array
     */

    public function insert_data($con,string $table, array $columns, array $values)
    {
        $column_count = count($columns);
        $overwriteArr = array_fill(0, $column_count, '?');

        for ($i = 0; $i < sizeof($columns); $i++) {
            $columns[$i] = trim($columns[$i]);
            $columns[$i] = '`' . $columns[$i] . '`';
        }

        $query = "INSERT INTO {$table} (" . implode(',', $columns) . ") VALUES (" .
            implode(',', $overwriteArr) . ")";

        foreach ($values as $value) {
            $value = trim($value);
            $value = mysqli_real_escape_string($con, $value);
            $value = '"' . $value . '"';
            $query = preg_replace('/\?/', $value, $query, 1);
        }
        $result = mysqli_query($con, $query);

        if ($result == true) {
            return array(
                "result" => true,
                "query_id" => mysqli_insert_id($con)
            );
        } else {
            return array(
                "result" => false,
                "error" => mysqli_error($con),
                "sql" => $query);
        }
    }

    /**
     * Update Mysql Data
     * @array of cols
     * @array of values
     * @array containing criteria
     * ex: criteria : array("id" => "11", "name" => "alexander")
     */
    public function update_data($con,string $table, array $criteria, array $cols, array $vals,string $dbName = "")
    {
        if (count($cols) == count($vals)) {
            $begin_query = "UPDATE " . $table . " SET ";

            foreach ($cols as $col_key => $col_value) {
                $value = $vals[$col_key];
                $value = mysqli_real_escape_string($con, $value);
                $values[] = " `" . $col_value . "` = '" . $value . "' ";
            }

            $begin_query .= implode(",", $values) . " WHERE ";

            foreach ($criteria as $criteria_key => $criteria_value) {
                $criteria_value = mysqli_real_escape_string($con, $criteria_value);
                $criterias[] = "" . $criteria_key . " = '" . addslashes($criteria_value) . "' ";
            }

            $begin_query .= implode(" AND ", $criterias);

            $execute = mysqli_query($con, $begin_query);

            if ($execute) {
                return array("result" => true);
            } else {
                return array("result" => false, "error" => mysqli_error($con) . " - " . $begin_query . "");
            }


        } else {
            return array("result" => false, "error" => "Mismatch between column and value count! : " . count($cols) . " columns and " . count($vals) . "");
        }
    }

    /**
     * Query Generator based on given parameters
     * Generates MySQL Query
     */
    public function buildParamsQuery(array $params, string $table_name)
    {


        $request_input = $this->is_request("GET");

        /**
         * Define stort order
         */
        if (array_key_exists("sort", $params)) {


            foreach ($params["sort"] as $sort) {

                $get_field = $sort["GET"];
                $sql_field = $sort["sql_field"];
                $sql_order = $sort["order_sql"];

                if (isset($request_input["sort"])) {

                    if ($request_input["sort"] == $get_field) {
                        $sql_sort[] = "ORDER by $sql_field $sql_order";

                    } else {
                        $sql_sort[] = null;
                    }
                } else {
                    $sql_sort[] = null;
                }

            }
            if (!empty($sql_sort)) {
                $sql_sort = array_filter($sql_sort);
                $sql_sort = implode("", $sql_sort);
            } else {
                $sql_sort = null;
            }


        } else {
            $sql_sort = null;
        }


        /**
         * Pairing criteria with the GET criteria
         */


        if (array_key_exists("criteria", $params)) {
            foreach ($params["criteria"] as $c) {


                $c_field = $c["GET"];
                $c_sql = $c["sql_field"];
                if (isset($request_input[$c_field])) {


                    if (array_key_exists($c_field, $request_input)) {

                        $criteria_input = $request_input[$c_field];

                        if ($criteria_input != "") {
                            $criteria[] = "$c_sql = '$criteria_input'";
                        } else {
                            $criteria[] = null;
                        }


                    } else {
                        $criteria[] = null;
                    }

                } else {
                    $criteria[] = null;
                }


            }

            if (!is_null($criteria)) {
                $criteria = array_filter($criteria);
                $criteria = implode(' AND ', $criteria);


            } else {
                $criteria = null;
            }

        } else {
            $criteria = null;
        }

        /**
         * Define REGEXP Criteria
         */

        if (array_key_exists("regexp", $params) && isset($params["regexp"])) {
            foreach ($params["regexp"] as $r) {
                $r_field = $r["GET"];
                $r_sql = $r["sql_field"];

                if (isset($request_input[$r_field])) {
                    if (array_key_exists($r_field, $request_input)) {
                        $regexp_input = $request_input[$r_field];

                        if ($regexp_input != "") {
                            $regexp_input = explode(" ", $regexp_input);
                            $regexp_input = array_filter($regexp_input);


                            if (count($regexp_input) > 0 && !is_null($regexp_input)) {

                                $regexp_input = implode("|", $regexp_input);
                                $regexp_input = rtrim($regexp_input, "|");
                            } else {
                                $regexp_input = $regexp_input[0];
                            }

                            $regexp[] = "$r_sql REGEXP '$regexp_input'";
                        } else {
                            $regexp = null;
                        }

                    }
                } else {
                    $regexp = null;
                }
            }
            if (!is_null($regexp)) {

                if (count($regexp) > 0) {
                    $regexp = implode(' OR ', $regexp);
                } else {
                    $regexp = $regexp;
                }

            } else {
                $regexp = null;
            }

        } else {
            $regexp = null;
        }
        /**
         * Define between parameters
         */

        if (array_key_exists("between", $params)) {
            foreach ($params["between"] as $b) {

                $b_from = $b["GET"];
                $b_to = $b["GET2"];
                $b_sql = $b["sql_field"];

                $from = $request_input["$b_from"];
                $to = $request_input["$b_to"];

                if (isset($request_input[$b_from]) && isset($request_input[$b_to])) {
                    if (array_key_exists($b_from, $request_input) && array_key_exists($b_to, $request_input)) {
                        if (empty($from) && !empty($to) && is_numeric($to)) {
                            $from = 1;

                            $between[] = "$b_sql BETWEEN '$from' AND '$to'";
                            $between = implode(' AND ', $between);
                        } elseif (!empty($from) && is_numeric($from) && !empty($to) && is_numeric($to)) {
                            $between[] = "$b_sql BETWEEN '$from' AND '$to'";
                            $between = implode(' AND ', $between);
                        } else {
                            $between = null;
                        }
                    }
                } else {
                    $between = null;
                }

            }
        } else {
            $between = null;
        }

        /**
         * FOUND IN condition
         */

        if (array_key_exists("found_in", $params)) {

            foreach ($params["found_in"] as $c) {
                $b_in_get = $c["GET"];
                $b_in_sql = $c["sql_field"];



                if (isset($request_input[$b_in_get])) {

                    $b_in_get_data = $request_input["$b_in_get"];
                    $b_in_get_data = rawurldecode($b_in_get_data);
                    if (array_key_exists($b_in_get, $request_input) && !empty($b_in_get_data)) {
                        $found_in[] = "$b_in_sql IN ($b_in_get_data)";


                    }
                } else {
                    $found_in = null;
                }
            }
            if (is_array($found_in)) {
                $found_in = implode(' OR ', $found_in);
            } else {
                $found_in = null;
            }
        } else {
            $found_in = null;
        }

        $data = array(
            $criteria,
            $regexp,
            $between,
            $found_in
        );

        $data = array_filter($data);
        $data = implode(" AND ", $data);

        if (!empty($data)) {
            $sql = "SELECT * FROM $table_name WHERE $data $sql_sort";
        } else {
            $sql = "SELECT * FROM $table_name $sql_sort";
        }


        return $sql;
    }

    /**
     * @param array $array
     * @return false|string
     */

    public function toJson(array $array = [])
    {
        return json_encode($array);
    }

    /**
     * @param string $json
     * @return mixed
     * @throws \ErrorException
     */
    public function fromJson(string $json)
    {
        if(json_decode($json,true))
        {
            return json_decode($json,true);
        }
        else
        {
            throw new \ErrorException('No valid JSON string detected!');
        }
    }
}

?>
