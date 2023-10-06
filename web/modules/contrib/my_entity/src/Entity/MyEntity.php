<?php

namespace Drupal\my_entity\Entity;

use Drupal\address\AddressInterface;
use Drupal\user\EntityOwnerTrait;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityChangedTrait;

/**
 * Defines the my_entity entity class.
 *
 * @ContentEntityType(
 *   id = "my_entity",
 *   label = @Translation("My Entity", context = "Custom Entity Modules"),
 *   label_collection = @Translation("My Entity items", context = "Custom Entity Modules"),
 *   label_singular = @Translation("my entity item", context = "Custom Entity Modules"),
 *   label_plural = @Translation("my entity items", context = "Custom Entity Modules"),
 *   label_count = @PluralTranslation(
 *     singular = "@count my entity item",
 *     plural = "@count my entity items",
 *     context = "Custom Entity Modules",
 *   ),
 *   bundle_label = @Translation("My Entity type", context = "Custom Entity Modules"),
 *   handlers = {
 *     "event" = "Drupal\my_entity\Event\MyEntityEvent",
 *     "storage" = "Drupal\my_entity\MyEntityStorage",
 *     "access" = "Drupal\entity\EntityAccessControlHandler",
 *     "query_access" = "Drupal\entity\QueryAccess\QueryAccessHandler",
 *     "permission_provider" = "Drupal\entity\EntityPermissionProvider",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\my_entity\MyEntityListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "default" = "Drupal\my_entity\Form\MyEntityForm",
 *       "add" = "Drupal\my_entity\Form\MyEntityForm",
 *       "edit" = "Drupal\my_entity\Form\MyEntityForm",
 *       "duplicate" = "Drupal\my_entity\Form\MyEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *     },
 *     "local_task_provider" = {
 *       "default" = "Drupal\entity\Menu\DefaultEntityLocalTaskProvider",
 *     },
 *     "route_provider" = {
 *       "default" = "Drupal\entity\Routing\AdminHtmlRouteProvider",
 *       "delete-multiple" = "Drupal\entity\Routing\DeleteMultipleRouteProvider",
 *     },
 *     "translation" = "Drupal\content_translation\ContentTranslationHandler"
 *   },
 *   base_table = "my_entity",
 *   data_table = "my_entity_field_data",
 *   admin_permission = "administer my_entity",
 *   permission_granularity = "bundle",
 *   translatable = TRUE,
 *   entity_keys = {
 *     "id" = "my_entity_id",
 *     "uuid" = "uuid",
 *     "bundle" = "type",
 *     "label" = "name",
 *     "langcode" = "langcode",
 *     "owner" = "uid",
 *     "uid" = "uid",
 *   },
 *   links = {
 *     "canonical" = "/my-entity/{my_entity}",
 *     "add-page" = "/my-entity/add",
 *     "add-form" = "/my-entity/add/{my_entity_type}",
 *     "edit-form" = "/my-entity/{my_entity}/edit",
 *     "duplicate-form" = "/my-entity/{my_entity}/duplicate",
 *     "delete-form" = "/my-entity/{my_entity}/delete",
 *     "delete-multiple-form" = "/admin/content/my-entity-items/delete",
 *     "collection" = "/admin/content/my-entity-items",
 *   },
 *   bundle_entity_type = "my_entity_type",
 *   field_ui_base_route = "entity.my_entity_type.edit_form",
 * )
 */
class MyEntity extends ContentEntityBase implements MyEntityInterface {

  use EntityOwnerTrait;
  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);
    $fields += static::ownerBaseFieldDefinitions($entity_type);

    $fields['type'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Type'))
      ->setDescription(t('The my_entity type.'))
      ->setSetting('target_type', 'my_entity_type')
      ->setReadOnly(TRUE);

    $fields['uid']
      ->setLabel(t('Owner'))
      ->setDescription(t('The my_entity owner.'))
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayConfigurable('form', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The my_entity name.'))
      ->setRequired(TRUE)
      ->setTranslatable(TRUE)
      ->setSettings([
        'default_value' => '',
        'max_length' => 255,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
      ])      
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayConfigurable('form', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time when the my_entity was created.'))
      ->setTranslatable(TRUE)
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time when the my_entity was last edited.'))
      ->setTranslatable(TRUE);

    return $fields;
  }

  /**
   * Default value callback for the 'timezone' base field definition.
   *
   * @see ::baseFieldDefinitions()
   *
   * @return array
   *   An array of default values.
   */
  public static function getSiteTimezone() {
    $site_timezone = \Drupal::config('system.date')->get('timezone.default');
    if (empty($site_timezone)) {
      $site_timezone = @date_default_timezone_get();
    }

    return [$site_timezone];
  }

  /**
   * Gets the allowed values for the 'timezone' base field.
   *
   * @return array
   *   The allowed values.
   */
  public static function getTimezones() {
    return system_time_zones(NULL, TRUE);
  }

  /**
   * Gets the allowed values for the 'billing_countries' base field.
   *
   * @return array
   *   The allowed values.
   */
  public static function getAvailableCountries() {
    return \Drupal::service('address.country_repository')->getList();
  }

}
