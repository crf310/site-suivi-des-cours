<?php

namespace Virgule\Bundle\SecurityBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VirguleSecurityBundle extends Bundle {

  public function getParent() {
    return 'FOSUserBundle';
  }

}
