<?php
/* バリデーションチェック */
require_once 'form.php';
class ValidateCheck extends Form
{
    // フォーム内容継承
    public function __construct($buttonName, $HttpReq)
    {
        parent::__construct($buttonName, $HttpReq);
    }
    /* 個別受け取り */
    // name指定のデータ受け取り
    public function findByData($Data, $name)
    {
        if (
            $Data !== NULL
        ) {
            foreach ($Data as $key => $val) {
                if ($key === $name) {
                    return $val;
                }
            }
        }
    }
    /* validateCheck 条件に合わないとfalseを返す */
    // 未入力チェック
    public function ValidateEmpty($obj)
    {
        if ($obj === '') {
            return true;
        } else {
            return false;
        }
    }
    // 数値型チェック
    public function ValidateNumeric($obj)
    {
        if (!is_numeric($obj)) {
            return true;
        } else {
            return false;
        }
    }
    // 数値の範囲チェック
    public function ValidateNumericSize($obj, $array)
    {
        if (!($obj >= 0 && $obj <= count($array) - 1)) {
            return true;
        } else {
            return false;
        }
    }
}
