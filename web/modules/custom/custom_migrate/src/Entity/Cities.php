<?php

namespace Drupal\custom_migrate\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\custom_migrate\CitiesInterface;

/**
 * Defines the cities entity class.
 *
 * @ContentEntityType(
 *   id = "cities",
 *   label = @Translation("cities"),
 *   label_collection = @Translation("citiess"),
 *   label_singular = @Translation("cities"),
 *   label_plural = @Translation("citiess"),
 *   label_count = @PluralTranslation(
 *     singular = "@count citiess",
 *     plural = "@count citiess",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\custom_migrate\CitiesListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "default" = "Drupal\custom_migrate\Form\CitiesForm",
 *       "add" = "Drupal\custom_migrate\Form\CitiesForm",
 *       "edit" = "Drupal\custom_migrate\Form\CitiesForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "cities",
 *   admin_permission = "administer cities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "collection" = "/admin/content/cities",
 *     "add-form" = "/admin/content/city/add",
 *     "canonical" = "/admin/content/city/{cities}",
 *     "edit-form" = "/admin/content/city/{cities}/edit",
 *     "delete-form" = "/admin/content/city/{cities}/delete",
 *   },
 *   field_ui_base_route = "entity.cities.settings",
 * )
 */
class Cities extends ContentEntityBase implements CitiesInterface {

  /**
   * {@inheritdoc}
   */
  public function getid() {
    return $this->get('id')->value();
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    return $this->get('label')->value;
  }

 /**
  * {@inheritdoc}
  */
  public function getPop() {
    return $this->get('pop')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getState() {
    return $this->get('state')->value;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['label'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Label'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('City id.'))
      ->setSetting('unsigned', TRUE)
      ->setDisplayOptions('form', [
        'settings' => ['display_label' => TRUE],
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

      $fields['state'] = BaseFieldDefinition::create('string')
      ->setLabel(t('State'))
      ->setDescription(t('State for '))
      ->setSetting('unsigned', TRUE)
      ->setDisplayOptions('form', [
        'settings' => ['display_label' => TRUE],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
    
      $fields['pop'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('POP'))
      ->setDescription(t('POP of ID.'))
      ->setSetting('unsigned', TRUE)
      ->setDisplayOptions('form', [
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);


    return $fields;
  }

}
