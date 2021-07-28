<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

class AdminController extends ControllerBase {



    /**
     * Display the markup.
     *
     * @return array Return markup array
     */
    public function listing() {
        // $_SESSION['test'] = 'Test';
        $output = [
            [
                'id' => 1,
                'username' => 'test',
                'email' => 'test@example.com'
            ]
        ];

        $return  = [
            '#theme' => 'hello_listing',
            '#users' => $output,
            '#session_var' => $_SESSION
        ];
        unset($_SESSION['test']);
        return $return;
    }
}