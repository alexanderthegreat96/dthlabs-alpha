<?php

namespace LexSystems\Core\System\Helpers\CoreUtils;

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

    public static function clean($string)
    {
        $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-\|]/', '', $string); // Removes special chars.
    }


    /**
     * @param string $str
     * @return string
     */
    public static function normalizeString (string $str = ''):string
    {
        $str = strip_tags($str);
        $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
        $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
        $str = strtolower($str);
        $str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
        $str = htmlentities($str, ENT_QUOTES, "utf-8");
        $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
        $str = str_replace(' ', '-', $str);
        $str = rawurlencode($str);
        $str = str_replace('%', '-', $str);
        return $str;
    }


    /**
     * @param int $page
     * @param int $total
     * @param int $range
     * @return array
     */

    public static function paginate(int $page, int $total, int $range): array
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

    public static function keywordify(string $string)
    {
        $words = explode('+',$string);
        if(count($words) > 1)
        {
            foreach($words as $w)
            {
                $ww[] = self::clean($w);
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
    public static function redirect($url)
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
    public static function formatSizeUnits($bytes)
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
     * Build URL
     * used to keep the current values in
     * used mainly for pagination purposes with
     * multiple GET params
     */
    public static function build_url(array $append_params = [])
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
    public static function readableVals(string $string)
    {
        return preg_replace('/(?<!\ )[A-Z]/', ' $0', ucfirst($string));
    }

    /**
     * @param string $price
     * @return string
     */

    public static function formatPrice(string $price)
    {
        return number_format($price,'2','.',',');
    }


    /**
     * @param string $start_date
     * @param string $end_date
     * @return string
     */
    public static function date_diff(string $start_date = '', string $end_date = ''):string
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
    public static function short_string(string $string,int $limit = 10)
    {
        if (strlen($string) >= $limit) {
            return substr($string, 0, $limit). " ... " . substr($string, -5);
        }
        else {
            return $string;
        }
    }

    /**
     * Gets the full domain and folder path
     */
    /**
     * @return string
     * returns current url
     */
    public static function this_url()
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

    public static function slug(string $text)
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
     * @param array $array
     * @return false|string
     */
    public static function toJson(array $array = [])
    {
        return json_encode($array);
    }

    /**
     * @param string $json
     * @return mixed
     * @throws \ErrorException
     */
    public static function fromJson(string $json)
    {
        if(json_decode($json,true))
        {
            return json_decode($json,true);
        }
        else
        {
            throw new \Exception('No valid JSON string detected!');
        }
    }
}

?>
