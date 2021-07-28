<?php

namespace Drupal\hello_world\Form;

use Drupal\Core\Url;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Database\Database;
use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HelloForm extends \Drupal\Core\Form\FormBase {


  protected $database;

  public function __construct(Connection $connection)
  {
    $this->database = $connection;
  }

  /**
   * @inheritDoc
   */
  public static function create(ContainerInterface $container)
  {
      return new static(
        $container->get('database')
      );
  }


  /**
   * Returns a unique string identifying the form.
   *
   * The returned ID should be a unique string that can be a valid PHP function
   * name, since it's used in hook implementation names such as
   * hook_form_FORM_ID_alter().
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'hello_form';
  }

  /**
   * Form constructor.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form structure.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    /*$_SESSION['form_session'] = 'FROM FORM SESSION';
    
    $form['description'] = [
      '#type' => 'item',
      '#markup' => $this->t('Please enter the title and accept the terms of use of the site.'),
    ];

    
    $form['title'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Title'),
        '#description' => $this->t('Enter the title of the book. Note that the title must be at least 10 characters in length.'),
        '#required' => TRUE,
        ];

        $form['accept'] = array(
        '#type' => 'checkbox',
        '#title' => $this
            ->t('I accept the terms of use of the site'),
        '#description' => $this->t('Please read and accept the terms of use'),
        );


        // Group submit handlers in an actions element with a key of "actions" so
        // that it gets styled correctly, and so that other modules may add actions
        // to the form. This is not required, but is convention.
        $form['actions'] = [
        '#type' => 'actions',
        ];

        // Add a submit button that handles the submission of the form.
        $form['actions']['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Submit'),
        ];
        
        // Create form with twig
        $form['#theme'] = 'my_custom_form';


        return $form;*/

        $form['first_name'] = array(
          '#type' => 'textfield',
          '#title' => t('First Name:'),
          '#pattern' => '[A-Za-z]+',
          '#required' => TRUE,
        );
        $form['last_name'] = array(
          '#type' => 'textfield',
          '#title' => t('Last Name:'),
          '#pattern' => '[A-Za-z]+',
          '#required' => TRUE,
        );
        $form['email_address'] = array(
          '#type' => 'email',
          '#title' => $this->t('Email:'),
          '#pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$',
          '#required' => TRUE,
        );
     
        $form['pincode'] = array(
          '#type' => 'textfield',
          '#title' => t('Pincode:'),
          '#size' => 6,
          '#pattern' => '[0-9]{6}',
          '#required' => TRUE,
        );
     
        $form['employee_role'] = array (
          '#type' => 'select',
          '#title' => ('Employee Role'),
          '#options' => array(
            'manager' => t('Manager'),
            'executive_manager' => t('Executive  Manager'),
            'fresher' => t('Fresher'),
            'ceo' => t('CEO'),
            'team_lead' => t('Team Lead')
          ),
        );
     
        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = array(
          '#type' => 'submit',
          '#value' => $this->t('Save'),
          '#button_type' => 'primary',
        );

        $form['#theme'] = 'custom_employee_form';
        return $form;

  }

  /**
   * Validate the title and the checkbox of the form
   * 
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   * 
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    $first_name = $form_state->getValue('first_name');
    $last_name = $form_state->getValue('last_name');
    $email_address = $form_state->getValue('email_address');
    $pincode = $form_state->getValue('pincode');
    $employee_role = $form_state->getValue('employee_role');
    // $accept = $form_state->getValue('accept');

    // if (strlen($title) < 10) {
    //   // Set an error for the form element with a key of "title".
    //   $form_state->setErrorByName('title', $this->t('The title must be at least 10 characters long.'));
    // }

    // if (empty($accept)){
    //   // Set an error for the form element with a key of "accept".
    //   $form_state->setErrorByName('accept', $this->t('You must accept the terms of use to continue'));
    // }

  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    // $conn = Database::getConnection();
    $this->database->insert('custom_employee')->fields(
      array(
        'first_name' => $form_state->getValue('first_name'),
        'last_name' => $form_state->getValue('last_name'),
        'email' => $form_state->getValue('email_address'),
        'pincode' => $form_state->getValue('pincode'),
        'role' => $form_state->getValue('employee_role'),
      )
    )->execute();

    $url = Url::fromRoute('hello_world.content');
    $form_state->setRedirectUrl($url);


    // Display the results.
    
    // Call the Static Service Container wrapper
    // We should inject the messenger service, but its beyond the scope of this example.
    // $messenger = \Drupal::messenger();
    // $messenger->addMessage('Title: '.$form_state->getValue('title'));
    // $messenger->addMessage('Accept: '.$form_state->getValue('accept'));

    // // Redirect to home
    // $form_state->setRedirect('<front>');

  } 
}