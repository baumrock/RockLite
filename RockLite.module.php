<?php

namespace ProcessWire;

/**
 * @author Bernhard Baumrock, 17.11.2022
 * @license COMMERCIAL DO NOT DISTRIBUTE
 * @link https://www.baumrock.com
 */
class RockLite extends WireData implements Module, ConfigurableModule
{

  public static function getModuleInfo()
  {
    return [
      'title' => 'RockLite',
      'version' => '0.0.1',
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
