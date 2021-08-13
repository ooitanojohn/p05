<?php
/* フォーム受け取り */
class Form
{
    // 送信名
    protected $buttonName;
    public function __construct($buttonName)
    {
        $this->buttonName = $buttonName;
    }
    // POST受け取りメソッド
    public function postData()
    {
        if (isset($_POST[$this->buttonName])) {
            return filter_input_array(INPUT_POST);
        }
    }
    // GET受け取りメソッド
    public function getData()
    {
        if (isset($_POST[$this->buttonName])) {
            return filter_input_array(INPUT_GET);
        }
    }
}
