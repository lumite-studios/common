<?php

namespace LumiteStudios\Common\Services;

use DeviceDetector\DeviceDetector;

/**
 * @method static string getDeviceAndIPAddress()
 * @method static string getDevice()
 * @method static string getIPAddress()
 */
class Device
{
    public static function getDeviceAndIPAddress(): string
    {
        return self::getDevice().' ('.self::getIPAddress().')';
    }

    public static function getDevice(): string
    {
        $client = self::getClient();

        if (is_array($client)) {
            return $client['name'].' '.$client['version'];
        }

        return 'unknown';

    }

    public static function getIPAddress(): string
    {
        if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        if (! empty($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        }

        return '127.0.0.1';

    }

    private static function getClient(): array|string|null
    {
        if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
            $dd = new DeviceDetector($_SERVER['HTTP_USER_AGENT']);
            $dd->parse();

            return $dd->getClient();
        }

        return null;
    }
}
