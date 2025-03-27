<?php

use RogerSites\Configurations\Configurations;
use RogerSites\Configurations\Enums\Components;

if (!function_exists('global_asset')) {

    function global_asset($path, $pam = null): string
    {
        $s3URL = str_replace('https://', '', env('AWS_S3_URL'));
        $url = 'https://' . env('AWS_DEFAULT_BUCKET') . '.' . $s3URL;
        $cdn = env('CDN');

        if (!is_null($cdn)) {
            $url = $cdn;

        } else {
            if (!is_null($pam)) {
                $configuration = Configurations::getComponentConfiguration($pam, Components::DESIGN->value);

                if (!is_null($configuration->cdn)) {
                    $url = $configuration->cdn;
                }
            } else {
                $configurations = config('pam.configurations');
                $configuration = $configurations[Components::DESIGN->value - 1]->data;

                if (!is_null($configuration->cdn)) {
                    $url = $configuration->cdn;
                }
            }
        }
        return "$url/$path";
    }
}

if (!function_exists('s3_asset')) {

    function s3_asset($path, $pam = null): string
    {
        if (!is_null($pam)) {
            $configuration = Configurations::getComponentConfiguration($pam, Components::DESIGN->value);
        } else {
            $configurations = config('pam.configurations');
            $configuration = $configurations[Components::DESIGN->value - 1]->data;
        }

        if (is_null($configuration->cdn)) {
            $s3URL = str_replace('https://', '', env('AWS_S3_URL'));
            $url = 'https://' . env('AWS_DEFAULT_BUCKET') . '.' . $s3URL . '/pam/' . $configuration->s3_path;
        } else {
            $url = $configuration->cdn . '/pam/' . $configuration->s3_path;;
        }
        return "$url/$path";
    }
}