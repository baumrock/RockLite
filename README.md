# RockLite

ProcessWire MailerLite Integration

## Usage

```php
// RockForms example
public function processInput()
{
  $values = $this->getValues();

  /** @var RockLite $lite */
  $lite = $this->wire->modules->get('RockLite');
  $result = $lite->api()->subscribe(
    mail: $values->mail,
    groups: ['1234'], // your group id
  );
  // bd($result);

  $m = new WireMail();
  $m->from('robot@baumrock.com');
  $m->to('office@baumrock.com');
  $m->subject("New signup: {$values->mail}");
  $m->body(print_r($result, true));
  $m->send();
}
```