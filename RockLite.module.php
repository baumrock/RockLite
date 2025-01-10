<?php

namespace ProcessWire;

use RockLiteApi\API;

/**
 * @author Bernhard Baumrock, 17.11.2022
 * @license MIT
 * @link https://www.baumrock.com
 */
class RockLite extends WireData implements Module, ConfigurableModule
{
  public $api = false;
  public $apikey = false;

  public static function getModuleInfo()
  {
    return [
      'title' => 'RockLite',
      'version' => '1.0.1',
      'summary' => 'MailerLite Integration',
      'autoload' => true,
      'singular' => true,
      'icon' => 'envelope-o',
      'requires' => [],
      'installs' => [],
    ];
  }

  public function api(): API
  {
    require_once __DIR__ . "/API.php";
    if ($this->api) return $this->api;
    return $this->api = new API($this);
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
