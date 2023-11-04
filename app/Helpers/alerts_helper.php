<?php

if (!function_exists('alertDefault')) {
    function alertDefault($msg = 'Alert default', $options = [])
    {
        session()->setFlashdata('alert', ['type' => 'default', 'msg' => $msg, 'options' => json_encode($options)]);
    }
}

if (!function_exists('alertSuccess')) {
    function alertSuccess($msg = 'Alert success', $options = [])
    {
        session()->setFlashdata('alert', ['type' => 'success', 'msg' => $msg, 'options' => json_encode($options)]);
    }
}

if (!function_exists('alertInfo')) {
    function alertInfo($msg = 'Alert info', $options = [])
    {
        session()->setFlashdata('alert', ['type' => 'info', 'msg' => $msg, 'options' => json_encode($options)]);
    }
}

if (!function_exists('alertWarning')) {
    function alertWarning($msg = 'Alert warning', $options = [])
    {
        session()->setFlashdata('alert', ['type' => 'warning', 'msg' => $msg, 'options' => json_encode($options)]);
    }
}

if (!function_exists('alertError')) {
    function alertError($msg = 'Alert error', $options = [])
    {
        session()->setFlashdata('alert', ['type' => 'danger', 'msg' => $msg, 'options' => json_encode($options)]);
    }
}
