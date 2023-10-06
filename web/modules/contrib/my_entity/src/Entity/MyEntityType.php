<?php

namespace Drupal\my_entity\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the my_entity type entity class.
 *
 * @ConfigEntityType(
 *   id = "my_entity_type",
 *   label = @Translation("My Entity type", context = "Custom Entity Modules"),
 *   label_collection = @Translation("My Entity types", context = "Custom Entity Modules"),
 *   label_singular = @Translation("my entity type", context = "Custom Entity Modules"),
 *   label_plural = @Translation("my entity types", context = "Custom Entity Modules"),
 *   label_count = @PluralTranslation(
 *     singular = "@count my entity type",
 *     plural = "@count my entity types",
 *     context = "Custom Entity Modules",
 *   ),
 *   handlers = {
 *     "access" = "Drupal\entity\BundleEntityAccessControlHandler",
 *     "list_builder" = "Drupal\my_entity\MyEntityTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\my_entity\Form\MyEntityTypeForm",
 *       "edit" = "Drupal\my_entity\Form\MyEntityTypeForm",
 *       "duplicate" = "Drupal\my_entity\Form\MyEntityTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm"
 *     },
 *     "local_task_provider" = {
 *       "default" = "Drupal\entity\Menu\DefaultEntityLocalTaskProvider",
 *     },
 *     "route_provider" = {
 *       "default" = "Drupal\entity\Routing\DefaultHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer my_entity_type",
 *   config_prefix = "my_entity_type",
 *   bundle_of = "my_entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *     "description",
 *     "traits",
 *     "locked",
 *   },
 *   links = {
 *     "add-form" = "/admin/content/my-entity-types/add",
 *     "edit-form" = "/admin/content/my-entity-types/{my_entity_type}/edit",
 *     "duplicate-form" = "/admin/content/my-entity-types/{my_entity_type}/duplicate",
 *     "delete-form" = "/admin/content/my-entity-types/{my_entity_type}/delete",
 *     "collection" = "/admin/content/my-entity-types",
 *   }
 * )
 */
class MyEntityType extends ConfigEntityBundleBase implements MyEntityTypeInterface {

  /**
   * A brief description of this my_entity type.
   *
   * @var string
   */
  protected $description;

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * {@inheritdoc}
   */
  public function setDescription($description) {
    $this->description = $description;
    return $this;
  }

}
