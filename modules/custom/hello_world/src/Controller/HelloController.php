<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloController extends ControllerBase {



    /**
     * Display the markup.
     *
     * @return array Return markup array
     */
    public function content() {
        return [
            '#type' => 'markup',
            '#markup' => $this->t('Hello World'),
        ];
    }
}