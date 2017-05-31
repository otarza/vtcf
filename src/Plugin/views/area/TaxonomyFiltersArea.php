<?php
/**
 * @file
 * Contains \Drupal\vtcf\Plugin\views\area\TaxonomyFiltersArea.
 */
namespace Drupal\vtcf\Plugin\views\area;
use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\area\AreaPluginBase;
use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Drupal\views\ViewExecutable;
use Drupal\vtcf\Form\TaxonomyFilterForm;

/**
 * Views area MyCustomSiteArea handler.
 *
 * @ingroup views_area_handlers
 *
 * @ViewsArea("taxonomy_filters_area")
 */
class TaxonomyFiltersArea extends AreaPluginBase {
  public $view;
  public $display;
  /**
   * {@inheritdoc}
   */
  public function init(ViewExecutable $view, DisplayPluginBase $display, array &$options = NULL) {
    parent::init($view, $display, $options);
    $this->view = $view;
    $this->display = $display;
  }

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    return $options;
  }
  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);
  }
  /**
   * {@inheritdoc}
   */
  public function render($empty = FALSE) {
    dump($this->display);
    $output = [];
    // We check if the views result are empty, or if the settings of this area
    // force showing this area even if the view is empty.
    if (!$empty || !empty($this->options['empty'])) {
      $form = \Drupal::formBuilder()->getForm(TaxonomyFilterForm::class);
      $output['taxonomy_filters_form'] = [
        '#type' => 'processed_text',
        '#text' => render($form),
        '#format' => 'full_html',
      ];
    }

    return $output;
  }
}
