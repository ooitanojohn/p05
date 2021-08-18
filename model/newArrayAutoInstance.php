<?php
class UserArrayData
{
    private $array;

    public function __construct($array)
    {
        $this->array = $array;
    }
    public function getUserData()
    {
        return $this->array;
    }
    // 1次元配列 obj化
    public function UserData()
    {
        foreach ($this->array as $key => $val) {
            $arrayName = [$key, $val];
            $arrayNames[] = $arrayName;
        }
        return $arrayNames;
    }
    /* 個別受け取り */
    // name指定のデータ受け取り
    public function findByData($name)
    {
        foreach ($this->array as $key => $val) {
            if ($key == $name) {
                return $val;
            }
        }
    }

    /* 配列データを入れるとcsvレコードを作る */
    public function csvRecord($array)
    {
        // ファイル出力処理
        $rec = ''; // csvレコード組み立て
        foreach ($array as $val) {
            $rec .= $val . ',';
        }
        $rec = rtrim($rec, ',');
        $rec .= "\n"; // 終端に改行を付加し、csvレコード完成
        return $rec;
    }
    /* $fnameのファイル名にcsvRecを書き込み */
    public function csvWrite($fname, $rec)
    {
        $fp = fopen($fname, 'a'); // ファイル追加オープン
        fputs($fp, $rec); // ファイル追加書込
        fclose($fp); // ファイルクローズ
    }
}
