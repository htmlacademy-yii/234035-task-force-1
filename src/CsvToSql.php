<?php
namespace TaskForce;

use SplFileObject;
use TaskForce\Exceptions\TaskException;

class CsvToSql
{
    private function getDataFromCsv(string $path): array
    {
        if (!file_exists($path)) {
            throw new TaskException('File not found');
        } else {
            $file = new SplFileObject($path);
            while (!$file->eof())
            {
                $array[] = $file->fgetcsv();
            }
            array_pop($array);
        }
        return $array;
    }

    private function getSql(string $table, array $data):string
    {
        $fields = "(";
        foreach (array_shift($data) as $value) {
            $fields .= trim($value).",";
        }
        $fields = substr($fields, 0, -1);
        $fields .= ") ";
        $sql = "";
        foreach ($data as $array) {
            $sql .= "INSERT INTO ".$table.$fields;
            $sql .= "VALUES (";
            foreach ($array as $element) {
                $sql .= "\"".$element."\",";
            }
            $sql = substr($sql, 0, -1);
            $sql .= ");\n";
        }
        return $sql;
    }

    public function createSql(string $path, array $data):void
    {
        $info = pathinfo($path);
        $table = $info['filename'];
        $filename = $info['dirname'].'/'.$info['filename'].'.sql';
        $fp = fopen($filename, 'w');
        $text = $this->getSql($table, $data);
//        echo $text;
        fwrite($fp, $text);
        fclose($fp);
    }

    public function toSql(string $path)
        {
            $data = $this->getDataFromCsv($path);
            $this->createSql($path, $data);
        }
}
