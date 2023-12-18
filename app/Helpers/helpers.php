<?php

if (!function_exists('getUserTagsStringFromArray')) {
    function getUserTagsStringFromArray($users)
    {
        $first = true;
        $userTags = collect($users)->map(function ($oneUser) use (&$first) {
            $tag = $first ? '[' : ',{"operator": "OR"},';
            $first = false;

            return $tag . '{"key": "email", "relation": "=", "value": "' . strtolower($oneUser->email) . '"}';
        })->push(']')->flatten(1)->toJson();

        return $userTags;
    }
}

if (!function_exists('convertToHoursMins')) {
    function convertToHoursMins($time, $format = '%02dh %02dmin')
    {
        if ($time < 60) {
            return $time . 'min';
        } else if ($time == 60) {
            return '1h';
        }

        $hours = floor($time / 60);
        $minutes = ($time % 60);

        return sprintf($format, $hours, $minutes);
    }
}