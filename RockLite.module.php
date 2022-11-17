<?php

namespace ProcessWire;

/**
 * @author Bernhard Baumrock, 17.11.2022
 * @license COMMERCIAL DO NOT DISTRIBUTE
 * @link https://www.baumrock.com
 */
class RockLite extends WireData implements Module, ConfigurableModule
{
  public $http = false;
  public $url;
  public $apikey;

  public static function getModuleInfo()
  {
    return [
      'title' => 'RockLite',
      'version' => '1.0.0',
      'summary' => 'MailerLite Integration',
      'autoload' => true,
      'singular' => true,
      'icon' => 'envelope-o',
      'requires' => [],
      'installs' => [],
    ];
  }

  public function init()
  {
    $this->url = "https://connect.mailerlite.com/";
  }

  /** ##### public api ##### */

  public function get($url)
  {
    return json_decode(
      $this->http()->get($this->url($url))
    );
  }

  public function post($url, $data)
  {
    return json_decode(
      $this->http()->post($this->url($url), json_encode($data))
    );
  }

  public function subscribe($mail, $fields = [], $groups = [])
  {
    return $this->post("/api/subscribers", [
      'email' => $mail,
      'fields' => (object)$fields,
      'groups' => $groups,
    ]);
  }

  /** ##### internal ##### */

  public function http(): WireHttp
  {
    if ($this->http) return $this->http;
    /** @var WireHttp $http */
    $http = $this->wire(new WireHttp());
    $http->setHeader('Content-Type', 'application/json');
    $http->setHeader('Accept', 'application/json');
    $http->setHeader('Authorization', 'Bearer ' . $this->apikey);
    return $this->http = $http;
  }

  public function url($url)
  {
    return $this->url . ltrim($url, "/");
  }

  /**
   * Config inputfields
   * @param InputfieldWrapper $inputfields
   */
  public function getModuleConfigInputfields($inputfields)
  {
    $inputfields->add([
      'type' => 'text',
      'name' => 'apikey',
      'label' => 'API Key',
      'value' => $this->apikey,
    ]);
    return $inputfields;
  }
}
