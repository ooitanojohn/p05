<?php
/* フォーム受け取り */
class Form
{
    // 送信名,HttpReq
    private $buttonName;
    private $HttpReq;

    public function __construct($buttonName, $HttpReq)
    {
        $this->buttonName = $buttonName;
        $this->HttpReq = $HttpReq;
    }

    public function receiveData()
    {
        /* 配列で全data受け取り */
        if ($this->HttpReq === 'post') {  // POST受け取り
            if (isset($_POST[$this->buttonName])) {
                return filter_input_array(INPUT_POST);
            }
        } elseif ($this->HttpReq === 'get') { // GET受け取り
            if (isset($_GET[$this->buttonName])) {
                return filter_input_array(INPUT_GET);
            }
        }
    }
}
