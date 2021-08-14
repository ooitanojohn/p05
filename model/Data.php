<?php
/* 1次元配列を作ると二次元配列にインスタンス化した[id,配列要素]を格納する */
class UserData
{
    private $id;
    private $pass;

    public function __construct($id, $pass)
    {
        $this->id = $id;
        $this->pass = $pass;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getPass()
    {
        return $this->pass;
    }

    /* 個別受け取り */
    // name指定のデータ受け取り
    public function findByData($Data, $name)
    {
        if ($Data !== NULL) {
            foreach ($Data as $key => $val) {
                if ($key === $name) {
                    return $val;
                }
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
    /*  */
    public function csvWrite()
    {
    }
}
