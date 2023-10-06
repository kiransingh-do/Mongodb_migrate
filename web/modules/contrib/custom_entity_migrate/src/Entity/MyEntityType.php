<?php

namespace Drupal\custom_entity_migrate\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the custom_entity_migrate type entity class.
 *
 * @ConfigEntityType(
 *   id = "custom_entity_migrate_type",
 *   label = @Translation("My Entity type", context = "custom"),
 *   label_collection = @Translation("My Entity types", context = "custom"),
 *   label_singular = @Translation("my entity type", context = "custom"),
 *   label_plural = @Translation("my entity types", context = "custom"),
 *   label_count = @PluralTranslation(
 *     singular = "@count my entity type",
 *     plural = "@count my entity types",
 *     context = "custom",
 *   ),
 *   handlers = {
 *     "access" = "Drupal\entity\BundleEntityAccessControlHandler",
 *     "list_builder" = "Drupal\custom_entity_migrate\MyEntityTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\custom_entity_migrate\Form\MyEntityTypeForm",
 *       "edit" = "Drupal\custom_entity_migrate\Form\MyEntityTypeForm",
 *       "duplicate" = "Drupal\custom_entity_migrate\Form\MyEntityTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm"
 *     },
 *     "local_task_provider" = {
 *       "default" = "Drupal\entity\Menu\DefaultEntityLocalTaskProvider",
 *     },
 *     "route_provider" = {
 *       "default" = "Drupal\entity\Routing\DefaultHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer custom_entity_migrate_type",
 *   config_prefix = "custom_entity_migrate_type",
 *   bundle_of = "custom_entity_migrate",
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
 *     "edit-form" = "/admin/content/my-entity-types/{custom_entity_migrate_type}/edit",
 *     "duplicate-form" = "/admin/content/my-entity-types/{custom_entity_migrate_type}/duplicate",
 *     "delete-form" = "/admin/content/my-entity-types/{custom_entity_migrate_type}/delete",
 *     "collection" = "/admin/content/my-entity-types",
 *   }
 * )
 */
class MyEntityType extends ConfigEntityBundleBase implements MyEntityTypeInterface {

  /**
   * A brief description of this custom_entity_migrate type.
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
