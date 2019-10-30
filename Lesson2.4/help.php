<?php

function _end($data){
    echo \yii\helpers\VarDumper::dumpAsString($data, 5, true);
    exit();
}