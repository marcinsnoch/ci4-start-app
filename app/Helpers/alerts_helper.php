<?php

if (!function_exists('alertSuccess')) {
    function alertSuccess($msg, $title = null, $options = null)
    {
        session()->setFlashdata('alert', ['type' => 'success', 'msg' => $msg, 'title' => $title, 'options' => json_encode($options)]);
    }
}

if (!function_exists('alertInfo')) {
    function alertInfo($msg, $title = null, $options = null)
    {
        session()->setFlashdata('alert', ['type' => 'info', 'msg' => $msg, 'title' => $title, 'options' => json_encode($options)]);
    }
}

if (!function_exists('alertWarning')) {
    function alertWarning($msg, $title = null, $options = null)
    {
        session()->setFlashdata('alert', ['type' => 'warning', 'msg' => $msg, 'title' => $title, 'options' => json_encode($options)]);
    }
}

if (!function_exists('alertError')) {
    function alertError($msg, $title = null, $options = null)
    {
        session()->setFlashdata('alert', ['type' => 'error', 'msg' => $msg, 'title' => $title, 'options' => json_encode($options)]);
    }
}
