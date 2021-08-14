<?php
/* 1次元連想配列内からkey値で検索する */
class arrayData
{
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
}
