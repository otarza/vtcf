<?php

namespace Drupal\vtcf\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class VtcfEntityForm.
 *
 * @package Drupal\vtcf\Form
 */
class VtcfEntityForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);
    $vtcf_entity = $this->entity;
    $values = [];
    if (!$vtcf_entity->isNew()) {
      $values = $vtcf_entity->toArray();
    }

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $vtcf_entity->label(),
      '#description' => $this->t("Label for the VTCF Entity."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $vtcf_entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\vtcf\Entity\VtcfEntity::load',
      ],
      '#disabled' => !$vtcf_entity->isNew(),
    ];

    $form['view_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('View name'),
      '#maxlength' => 255,
      '#default_value' => (!empty($values['view_name'])) ? $values['view_name'] : "",
      '#description' => $this->t("View machine name."),
      '#required' => TRUE,
    ];

    $form['view_display'] = [
      '#type' => 'textfield',
      '#title' => $this->t('View display name'),
      '#maxlength' => 255,
      '#default_value' => (!empty($values['view_display'])) ? $values['view_display'] : "",
      '#description' => $this->t("View display machine name."),
      '#required' => TRUE,
    ];

    $vocabularies = taxonomy_vocabulary_get_names();
    $form['taxonomy_vocabularies'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Taxonomy vocabularies'),
      '#description' => $this->t('Select taxonomy vocabularies.'),
      '#options' => $vocabularies,
      '#multiple' => TRUE,
      '#default_value' => (!empty($values['taxonomy_vocabularies'])) ? $values['taxonomy_vocabularies'] : [],
    ];

    foreach ($vocabularies as $vid => $vocabulary) {

      $terms = \Drupal::service('entity_type.manager')
        ->getStorage("taxonomy_term")
        ->loadTree($vid);

      $options = [];
      foreach ($terms as $tid => $term) {
        $options[$term->tid] = $term->name;
      }
      $form[$vid] = [
        '#type' => 'checkboxes',
        '#title' => $this->t('Taxonomy: ' . $vocabulary),
        '#description' => $this->t('Select: ' . $vocabulary),
        '#options' => (!empty($options)) ? $options : [],
        '#multiple' => TRUE,
        '#default_value' => (!empty($values['taxonomy_terms'])) ? $values['taxonomy_terms'] : [],
        '#states' => [
          'visible' => [
            ":input[name='taxonomy_vocabularies[$vid]']" => ['checked' => TRUE],
          ],
        ],
      ];
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $vtcf_entity = $this->entity;
    $vtcf_entity->taxonomy_terms = [];
    foreach ($vtcf_entity->taxonomy_vocabularies as $vid) {
      if (property_exists($vtcf_entity, $vid)) {
        $vtcf_entity->taxonomy_terms = array_merge($vtcf_entity->taxonomy_terms, $vtcf_entity->{$vid});
      }
    }
    $status = $vtcf_entity->save();

    switch ($status) {
      case SAVED_NEW:
        \Drupal::messenger()->addMessage($this->t('Created the %label VTCF Entity.', [
          '%label' => $vtcf_entity->label(),
        ]));
        break;

      default:
        \Drupal::messenger()->addMessage($this->t('Saved the %label VTCF Entity.', [
          '%label' => $vtcf_entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($vtcf_entity->toUrl('collection'));
  }
}
