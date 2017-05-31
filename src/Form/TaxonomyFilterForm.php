<?php

namespace Drupal\vtcf\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class TaxonomyFilterForm.
 *
 * @package Drupal\vtcf\Form
 */
class TaxonomyFilterForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'taxonomy_filter_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['terms'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Terms'),
      '#options' => ['topic1' => $this->t('topic1'), 'topic2' => $this->t('topic2'), 'topic3' => $this->t('topic3')],
    ];

//    $form['date'] = [
//      '#type' => 'date',
//      '#title' => $this->t('Date'),
//    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }

  }

}
