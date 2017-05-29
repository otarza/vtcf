<?php

namespace Drupal\vtcf\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the VTCF Entity entity.
 *
 * @ConfigEntityType(
 *   id = "vtcf_entity",
 *   label = @Translation("VTCF Entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\vtcf\VtcfEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\vtcf\Form\VtcfEntityForm",
 *       "edit" = "Drupal\vtcf\Form\VtcfEntityForm",
 *       "delete" = "Drupal\vtcf\Form\VtcfEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\vtcf\VtcfEntityHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "vtcf_entity",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/vtcf_entity/{vtcf_entity}",
 *     "add-form" = "/admin/structure/vtcf_entity/add",
 *     "edit-form" = "/admin/structure/vtcf_entity/{vtcf_entity}/edit",
 *     "delete-form" = "/admin/structure/vtcf_entity/{vtcf_entity}/delete",
 *     "collection" = "/admin/structure/vtcf_entity"
 *   }
 * )
 */
class VtcfEntity extends ConfigEntityBase implements VtcfEntityInterface {

  /**
   * The VTCF Entity ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The VTCF Entity label.
   *
   * @var string
   */
  protected $label;

}
