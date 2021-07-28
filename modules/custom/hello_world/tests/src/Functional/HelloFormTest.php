<?php

namespace Drupal\Tests\hello_world\Functional;

use Drupal\Tests\BrowserTestBase;

class HelloFormTest extends BrowserTestBase
{

    protected $strictConfigSchema = FALSE;

    /**
     * Modules to enable.
     *
     * @var array
     */
    protected static $modules = ['node', 'hello_world'];


    /**
   * {@inheritdoc}
   */
//   protected function setUp() {
//     // Make sure to complete the normal setup steps first.
//     parent::setUp();

//     // Set the front page to "/node".
//     \Drupal::configFactory()
//       ->getEditable('system.site')
//       ->set('page.front', '/node')
//       ->save(TRUE);
//   }


    public function testSubmitForm()
    {
        $form_data = [
            'title' => 'The title',
            'accept' => 'on'
        ];
        $this->drupalPostForm('/sample-form', $form_data, t('Submit'));

        // Confirm that the site didn't throw a server error or something else.
    
    }
}