<?php
namespace LexSystems\Framework\Kernel\Helpers\Arrays;

class ArrayToCsv
{
    /**
     * @var string
     */
    public $delimiter;
    /**
     * @var string
     */
    public $enclosure;
    /**
     * @var string
     */
    public $linefeed;

    /**
     * ArrayToCsv constructor.
     * @param string $delimiter
     * @param string $enclosure
     * @param string $linefeed
     */
    public function __construct(string $delimiter = ',', string $enclosure = '\"', string $linefeed = '\r\n')
    {
        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
        $this->linefeed = $linefeed;
    }

    /**
     * @param string $filename
     */
    public function sendCSVHeaders(string $filename = '')
    {
        if(!$filename)
        {
            $filename = 'csv_export_'.time().'.csv';
        }

        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename={$filename}");
        header("Pragma: no-cache");
        header("Expires: 0");
    }


    /**
     * @param array $array
     * @return string
     */

    public function arrayToCSV(array $array)
    {
        $csv = '';
        foreach ($array as $key => $val) {
            if (is_array($val)) {
                $csv .= $this->CSVRow($val);
            } else {
                $csv .= $this->CSVRow(array($key, $val));
            }
        }

        return $csv;
    }

    /**
     * @param $row
     * @return string
     */

    private function CSVRow($row)
    {
        $rowtext = "";
        $first = true;
        foreach ($row as $col) {
            if (!$first) {
                $rowtext .= $this->delimiter;
            }
            $col = utf8_decode($col);
            $col = str_replace('"', '""', $col);
            $rowtext .= $this->enclosure . "$col" . $this->enclosure;
            $first = false;
        }
        $rowtext .= $this->linefeed;

        return $rowtext;
    }
}
