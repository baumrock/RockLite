<?php

namespace RockLiteApi;

use ProcessWire\RockLite;
use ProcessWire\Wire;
use ProcessWire\WireHttp;

class API extends Wire
{
  public $url = "https://connect.mailerlite.com/";
  public $rocklite;

  public function __construct(RockLite $rocklite)
  {
    $this->rocklite = $rocklite;
  }

  public function get($url)
  {
    return json_decode(
      $this->http()->get($this->url($url))
    );
  }

  public function http(): WireHttp
  {
    if ($this->http) return $this->http;
    /** @var WireHttp $http */
    $http = $this->wire(new WireHttp());
    $http->setHeader('Content-Type', 'application/json');
    $http->setHeader('Accept', 'application/json');
    $http->setHeader('Authorization', 'Bearer ' . $this->rocklite->apikey);
    return $this->http = $http;
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

  public function url($url)
  {
    return $this->url . ltrim($url, "/");
  }
}
