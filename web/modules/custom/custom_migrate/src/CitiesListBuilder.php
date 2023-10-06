<?php

namespace Drupal\custom_migrate;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Provides a list controller for the cities entity type.
 */
class CitiesListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function render() {
    $build['table'] = parent::render();

    $total = $this->getStorage()
      ->getQuery()
      ->accessCheck(FALSE)
      ->count()
      ->execute();

    $build['summary']['#markup'] = $this->t('Total citiess: @total', ['@total' => $total]);
    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['label'] = $this->t('Label');
    $header['state'] = $this->t('State');
    $header['pop'] = $this->t('POP');
    return $header + parent::buildHeader();

  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /** @var \Drupal\custom_migrate\CitiesInterface $entity */
    $row['label'] = $entity->get('label')->value;
    $row['id'] = $entity->get('id')->value;
    $row['state'] = $entity->get('state')->value;
    $row['pop'] = $entity->get('pop')->value;
    return $row + parent::buildRow($entity);
  }

}
