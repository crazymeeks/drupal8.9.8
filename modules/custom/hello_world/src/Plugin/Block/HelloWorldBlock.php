<?php

namespace Drupal\hello_world\Plugin\Block;

use Drupal;
use Drupal\Core\Block\BlockBase;
use Drupal\hello_world\Form\HelloForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a block called "Example hello world block"
 * 
 * @Block(
 *  id = "hello_world_hello_world",
 *  admin_label = @Translation("Example hello world block")
 * )
 */
class HelloWorldBlock extends BlockBase {


    /**
     * @inheritDoc
     */
    public function build() {

        // return [
        //     '#type' => 'markup',
        //     '#markup' => $this->t('The output of our hello world block'),
        // ];

        // Display form in frontend
        $form = Drupal::formBuilder()->getForm(HelloForm::class);
        
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state) {
        $form = parent::blockForm($form, $form_state);

        $config = $this->getConfiguration();

        $form['hello_block_name'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Who'),
        '#description' => $this->t('Who do you want to say hello to?'),
        '#default_value' => $config['hello_block_name'] ?? '',
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state) {
        parent::blockSubmit($form, $form_state);
        $values = $form_state->getValues();
        $this->configuration['hello_block_name'] = $values['hello_block_name'];
    }

    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration() {
        $default_config = \Drupal::config('hello_world.settings');
        return [
            'hello_block_name' => $default_config->get('hello.name'),
        ];
    }
}