<?php
/**
 * This file is part of Illuxat/SLOom.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * PHP version 7
 *
 * @category  PHP
 * @package   Illuxat
 * @author    SLOom/Clément <admin@illuxat.com>
 * @copyright 2019 Illuxat
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link      https://illuxat.com
 */
namespace Illuxat;

/**
 * A PHP library for Illuxat.com
 *
 * @category  PHP
 * @package   Illuxat
 * @author    SLOom/Clément <admin@illuxat.com>
 * @copyright 2019 Illuxat
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link      https://illuxat.com
 */
class Illuxatlib
{
    /**
     * Main domain for Illuxat
     *
     * @var string $_illuxat_dom
     */
    private static $illuxatdom = 'https://api.illuxat.com/';

    /**
     * Get the informations of a power
     *
     * @param string $powerName Name of a xat power
     *
     * @return array
     */
    public static function powerInfo(string $powerName): array
    {
        if (empty($powerName) || strlen($powerName) == 0) {
            throw new \Exception('You must specify a power');
        }

        $content = self::getContent(
            self::$illuxatdom . 'powerApi?power=' . $powerName
        );

        if (empty($content['response'])) {
            throw new \Exception("Error Processing Request");
        }

        $content = json_decode($content['response'], true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Invalid JSON.');
        }

        return $content;
    }

    /**
     * Get the informations of the latest power
     *
     * @return mixed
     */
    public static function getLatest(): ?array
    {
        $content = self::getContent(self::$illuxatdom . 'latestpower');

        if (empty($content['response'])) {
            throw new \Exception("Error Processing Request");
        }

        $content = json_decode($content['response'], true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Invalid JSON.');
        }

        return $content;
    }

    /**
     *  Get content of a URL
     *
     * @param string $url Url to fetch content
     *
     * @return mixed
     */
    private function getContent(string $url): ?array
    {
        if (empty($url) || strlen($url) == 0) {
            throw new \Exception('You must specify a url');
        }

        $curlInit = curl_init();
        curl_setopt($curlInit, CURLOPT_URL, $url);
        curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curlInit);
        curl_close($curlInit);

        return [
         'response' => $output
        ];
    }

}
