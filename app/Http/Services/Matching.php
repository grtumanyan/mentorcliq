<?php


namespace App\Http\Services;


class Matching
{

    public function process($fileName)
    {
        $array = $this->csvToArray($fileName);

        foreach (CRITERIAS as $criteria) {
            if (!array_key_exists($criteria, $array[array_rand($array)])) {
                return ['error' => true, 'data' => 'CSV file contains unexpected keys.'];
            }
        }
        $data = [];
        foreach ($array as $elementKey => $element) {

            foreach ($array as $key => $value) {
                if($key == $elementKey) {
                    continue;
                }
                $percent = 0;
                if ($value['Division'] === $element['Division']) {
                    $percent += PERCENTAGE['Division'];
                }
                if (checkAge($value['Age'], $element['Age'])) {
                    $percent += PERCENTAGE['Age'];
                }
                if ($value['Timezone'] === $element['Timezone']) {
                    $percent += PERCENTAGE['Timezone'];
                }
                if ($percent != 0) {
                    array_push($data, [$value['Name'], $element['Name'], 'percent' => $percent]);
                }
            }
            unset($array[$elementKey]);
        }

        usort($data, function($a, $b) {
            return $b['percent'] <=> $a['percent'];
        });

        return ['error' => false, 'data' => $data];
    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        $filename = public_path('uploads/' . $filename);

        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

}
