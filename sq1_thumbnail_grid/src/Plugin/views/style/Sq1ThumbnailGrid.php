<?php

namespace Drupal\sq1_thumbnail_grid\Plugin\views\style;

use Drupal\core\form\FormStateInterface;
use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * Style plugin to render a thumbnail grid.
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "sq1_thumbnail_grid",
 *   title = @Translation("SQ1 Thumbnail Grid"),
 *   help = @Translation("Render content into a grid."),
 *   theme = "views_view_sq1_thumbnail_grid",
 *   display_types = { "normal" }
 * )
 */
class Sq1ThumbnailGrid extends StylePluginBase {

  protected function defineOptions() {
    $options = parent::defineOptions();

    $options['image_field'] = ['default' => ''];
    $options['include_title'] = ['default' => 1];
    $options['link_thumbnails'] = ['default' => 1];
    $options['thumbnail_shape'] = ['default' => 'rectangular'];
    $options['thumbnail_proportions'] = ['default' => 'square'];
    $options['thumbnail_shadow'] = ['default' => 'drop-shadow'];
    $options['columns_xl'] = ['default' => 2];
    $options['columns_l'] = ['default' => 2];
    $options['columns_m'] = ['default' => 2];
    $options['columns_s'] = ['default' => 2];
    $options['columns_xs'] = ['default' => 2];

    return $options;
  }

  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $options = [
      '' => 'Select an Image field',
    ];

    $field_map = \Drupal::entityManager()->getFieldMap();
    $node_field_map = $field_map['node'];

    foreach ($node_field_map as $field_key => $field_value) {

      if ($field_value['type'] == 'image') {

        $options[$field_key] = $field_key . ' (' . implode(', ', $field_value['bundles']) . ')';

      }

    }

    $form['image_field'] = [
      '#title' => $this->t('Image field'),
      '#description' => $this->t('Field that will be used for the slide image.'),
      '#type' => 'select',
      '#default_value' => $this->options['image_field'],
      '#options' => $options,
    ];

    $form['include_title'] = [
      '#type' => 'select',
      '#title' => $this->t('Include title'),
      '#default_value' => $this->options['include_title'],
      '#options' => [
        1 => $this->t('Yes'),
        0 => $this->t('No'),
      ]
    ];

    $form['link_thumbnails'] = [
      '#type' => 'select',
      '#title' => $this->t('Link thumbnails'),
      '#default_value' => $this->options['link_thumbnails'],
      '#options' => [
        1 => $this->t('Yes'),
        0 => $this->t('No'),
      ]
    ];

    $form['thumbnail_shape'] = [
      '#type' => 'select',
      '#title' => $this->t('Thumbnail shape'),
      '#default_value' => $this->options['thumbnail_shape'],
      '#options' => [
        'circle' => $this->t('Circle'),
        'rectangular' => $this->t('Rectangular'),
        'rounded' => $this->t('Rounded'),
      ]
    ];

    $form['thumbnail_proportions'] = [
      '#type' => 'select',
      '#title' => $this->t('Thumbnail proportions'),
      '#default_value' => $this->options['thumbnail_proportions'],
      '#options' => [
        'square' => $this->t('Square'),
        'tall' => $this->t('Tall'),
        'wide' => $this->t('Wide'),
      ]
    ];

    $form['thumbnail_shadow'] = [
      '#type' => 'select',
      '#title' => $this->t('Thumbnail shadow'),
      '#default_value' => $this->options['thumbnail_shadow'],
      '#options' => [
        'drop-shadow' => $this->t('Drop shadow'),
        'drop-and-inset-shadow' => $this->t('Drop and inset shadow'),
        'inset-shadow' => $this->t('Inset shadow'),
        'no-shadow' => $this->t('No shadow'),
      ]
    ];

    $form['columns_xl'] = [
      '#type' => 'number',
      '#title' => $this->t('Columns (Extra large screen)'),
      '#min' => 1,
      '#max' => 5,
      '#default_value' => $this->options['columns_xl'],
    ];

    $form['columns_l'] = [
      '#type' => 'number',
      '#title' => $this->t('Columns (Large screen)'),
      '#min' => 1,
      '#max' => 5,
      '#default_value' => $this->options['columns_l'],
    ];

    $form['columns_m'] = [
      '#type' => 'number',
      '#title' => $this->t('Columns (Medium screen)'),
      '#min' => 1,
      '#max' => 5,
      '#default_value' => $this->options['columns_m'],
    ];

    $form['columns_s'] = [
      '#type' => 'number',
      '#title' => $this->t('Columns (Small screen)'),
      '#min' => 1,
      '#max' => 5,
      '#default_value' => $this->options['columns_s'],
    ];

    $form['columns_xs'] = [
      '#type' => 'number',
      '#title' => $this->t('Columns (Extra small screen)'),
      '#min' => 1,
      '#max' => 5,
      '#default_value' => $this->options['columns_xs'],
    ];

  }

}
