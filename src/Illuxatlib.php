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
     * @var string $illuxatdom
     */
    private static $illuxatdom = 'https://api.illuxat.com/';

    /**
     * Array of options for GetList
     *
     * @var array $optionArray
     */
    private static $optionArray = [
        'stats',
        'powers',
        'smilies',
        'hugs',
        'all'
    ];

    /**
     * Array of languages
     *
     * @var array $langArray
     */
    private static $langArray = [
        'en',
        'fr',
        'es',
        'pt',
        'ar',
        'n0',
        'ro',
        'it',
        'de',
        'th',
        'tr',
        'pl',
        'nl',
        'hr',
        'sr',
        'bs'
    ];

    /**
     * Get the informations of a power
     *
     * @param string $powerName Name of a xat power
     *
     * @throws Exception If argument $powerName is empty
     * @throws Exception If response is empty
     * @throws Exception If invalid json on URL response
     *
     * @return array
     */
    public static function powerInfo(string $powerName): array
    {
        if (empty($powerName) || strlen($powerName) == 0) {
            throw new \EmptyArgument('You must specify a power');
        }

        $content = self::getContent(
            self::$illuxatdom . 'power/' . $powerName
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
     * @throws Exception If response is empty
     * @throws Exception If invalid json on URL response
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
     * Get the informations of a xat chat
     *
     * @param string $roomName Name of the chat
     *
     * @throws Exception If argument $roomName is empty
     * @throws Exception If response is empty
     * @throws Exception If invalid json on URL response
     *
     * @return mixed
     */
    public static function getChatInfos(string $roomName): ?array
    {
        if (empty($roomName) || strlen($roomName) == 0) {
            throw new \Exception('You must specify a room name');
        }

        $content = self::getContent(
            self::$illuxatdom . 'room/' . $roomName
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
     * Get a content depending of the option
     *
     * @param string $option
     *
     * @throws Exception If argument $option is empty
     * @throws Exception If argument $option is not in $optionArray
     * @throws Exception If response is empty
     * @throws Exception If invalid json on URL response
     *
     * @return mixed
     */
    public static function getData(string $option): ?array
    {
        if (empty($option) || strlen($option) == 0) {
            throw new \Exception('You must specify an option');
        }

        if (!in_array($option, self::$optionArray)) {
            throw new \Exception(
                'Invalid option. Available options: ' . implode(', ', self::$optionArray)
            );
        }

        $content = self::getContent(
            self::$illuxatdom . 'getList/' . $option
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
     * Get the connection information of a xat chat.
     *
     * @param int $roomID
     *
     * @throws Exception If argument $option is empty
     * @throws Exception If response is empty
     * @throws Exception If invalid json on URL response
     *
     * @return mixed
     */
    public static function getChatConnection(int $roomID): ?array
    {
        if (empty($roomID) || strlen($roomID) == 0 || !is_numeric($roomID)) {
            throw new \Exception('You must specify a numeric roomid');
        }

        $content = self::getContent(
            self::$illuxatdom . 'connection/' . $roomID
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
     * Get the price of a shortname
     *
     * @param string $shortname
     *
     * @throws Exception If argument $shortname is empty
     * @throws Exception If response is empty
     * @throws Exception If invalid json on URL response
     *
     * @return mixed
     */
    public static function getShortname(string $shortname): ?array
    {
        if (empty($shortname) || strlen($shortname) == 0) {
            throw new \Exception('You must specify a shortname');
        }

        $content = self::getContent(
            self::$illuxatdom . 'shortname',
            [
                'shortname' => $shortname
            ]
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
     * Get the promoted list from a language code
     *
     * @param string $languageCode
     *
     * @throws Exception If argument $languageCode is empty
     * @throws Exception If argument $languageCode is not in $langArray
     * @throws Exception If response is empty
     * @throws Exception If invalid json on URL response
     *
     * @return mixed
     */
    public static function getPromotedChats(string $languageCode): ?array
    {
        if (empty($languageCode) || strlen($languageCode) == 0) {
            throw new \Exception('You must specify a language code');
        }

        if (!in_array($languageCode, self::$langArray)) {
            throw new \Exception(
                'Invalid language code. Available languages: ' . implode(', ', self::$langArray)
            );
        }

        $content = self::getContent(
            self::$illuxatdom . 'promoted/' . $languageCode
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
     * Get content of a URL
     *
     * @param string $url Url to fetch content
     *
     * @param array $data (optional)
     *
     * @throws Exception If argument $url is empty
     *
     * @return mixed
     */
    private function getContent(string $url, array $data = []): ?array
    {
        if (empty($url) || strlen($url) == 0) {
            throw new \Exception('You must specify a url');
        }

        $curlInit = curl_init();
        curl_setopt($curlInit, CURLOPT_URL, $url);

        if (!empty($data)) {
            $i = 0;
            $arrData = "";
            foreach ($data as $key => $value) {
                $arrData .= $key . '=' . $value . ($i < sizeof($data) ? '&' : '');
                $i++;
            }

            curl_setopt($curlInit, CURLOPT_POST, 1);
            curl_setopt($curlInit, CURLOPT_POSTFIELDS, $arrData);
        }

        curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curlInit);
        curl_close($curlInit);

        return [
         'response' => $output
        ];
    }
}
