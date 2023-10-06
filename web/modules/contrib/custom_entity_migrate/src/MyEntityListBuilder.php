<?php

namespace Drupal\custom_entity_migrate;

use Drupal\custom_entity_migrate\Entity\MyEntityType;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Defines the list builder for my entity items.
 */
class MyEntityListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['name'] = $this->t('Name');
    $header['type'] = $this->t('Type');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /** @var \Drupal\custom_entity_migrate\Entity\MyEntityInterface $entity */
    $custom_entity_migrate_type = MyEntityType::load($entity->bundle());

    $row['name']['data'] = [
      '#type' => 'link',
      '#title' => $entity->label(),
    ] + $entity->toUrl()->toRenderArray();
    $row['type'] = $custom_entity_migrate_type->label();

    return $row + parent::buildRow($entity);
  }

}
