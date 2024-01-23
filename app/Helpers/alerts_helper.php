<?php

if (!function_exists('alertDefault')) {
    function alertDefault($msg = 'Alert default', $options = [])
    {
        $options['title'] = 'Message';
        session()->setFlashdata('alert', ['type' => 'default', 'msg' => $msg, 'options' => json_encode($options)]);
    }
}

if (!function_exists('alertSuccess')) {
    function alertSuccess($msg = 'Alert success', $options = [])
    {
        $options['title'] = 'Success';
        session()->setFlashdata('alert', ['type' => 'success', 'msg' => $msg, 'options' => json_encode($options)]);
    }
}

if (!function_exists('alertInfo')) {
    function alertInfo($msg = 'Alert info', $options = [])
    {
        $options['title'] = 'Info';
        session()->setFlashdata('alert', ['type' => 'info', 'msg' => $msg, 'options' => json_encode($options)]);
    }
}

if (!function_exists('alertWarning')) {
    function alertWarning($msg = 'Alert warning', $options = [])
    {
        $options['title'] = 'Warning';
        session()->setFlashdata('alert', ['type' => 'warning', 'msg' => $msg, 'options' => json_encode($options)]);
    }
}

if (!function_exists('alertError')) {
    function alertError($msg = 'Alert error', $options = [])
    {
        $options['title'] = 'Error!';
        session()->setFlashdata('alert', ['type' => 'danger', 'msg' => $msg, 'options' => json_encode($options)]);
    }
}
