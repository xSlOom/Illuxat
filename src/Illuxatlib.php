<?php

namespace Illuxat;

class Illuxatlib 
{
   /**
   * Main domain for Illuxat
   *
   * @var   string
   */
   private static $illuxat_dom = 'https://api.illuxat.com/';

  /**
   * Get the informations of a power
   * 
   * @param  string
   * @return array
   */
   public static function powerInfo(string $powerName): array 
   {
      if (empty($powerName) || strlen($powerName) == 0) {
         throw new \Exception('You must specify a power');
      }

      $content = self::getContent(self::$illuxat_dom . 'powerApi?power=' . $powerName);

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
    * @return mixed
    */
   public static function getLatest(): ?array 
   {
      $content = self::getContent(self::$illuxat_dom . 'latestpower');

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
   * @param  string
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