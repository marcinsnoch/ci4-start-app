<?php

if (!function_exists('arrayFromPost')) {
    function arrayFromPost(array $fields)
    {
        $request = service('request');
        $data = [];
        foreach ($fields as $field) {
            $input = $request->getPost($field);
            if ($input == '' || $input == false) {
                $data[$field] = null;
            } else {
                $data[$field] = $input;
            }
        }

        return $data;
    }
}
