<?php

namespace Hazbo\Component\Utils;

final class PhutilCommandString extends Phobject
{
  private $argv;

  public function __construct(array $argv) {
    $this->argv = $argv;

    // This makes sure we throw immediately if there are errors in the
    // parameters.
    $this->getMaskedString();
  }

  public function __toString() {
    return $this->getMaskedString();
  }

  public function getUnmaskedString() {
    return $this->renderString($unmasked = true);
  }
  
  public function getMaskedString() {
    return $this->renderString($unmasked = false);
  }

  private function renderString($unmasked) {
    $x = new Xsprintf(
      'xsprintf_command',
      array(
        'unmasked' => $unmasked,
      ),
      $this->argv);
    return $x->subject;
  }
}
