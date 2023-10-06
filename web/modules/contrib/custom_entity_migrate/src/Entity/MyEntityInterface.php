<?php

namespace Drupal\custom_entity_migrate\Entity;

use Drupal\address\AddressInterface;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Defines the interface for my entity items.
 */
interface MyEntityInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the custom_entity_migrate name.
   *
   * @return string
   *   The custom_entity_migrate name.
   */
  public function getName();

  /**
   * Sets the custom_entity_migrate name.
   *
   * @param string $name
   *   The custom_entity_migrate name.
   *
   * @return $this
   */
  public function setName($name);

  /**
   * Gets the custom_entity_migrate creation timestamp.
   *
   * @return int
   *   The custom_entity_migrate creation timestamp.
   */
  public function getCreatedTime();

  /**
   * Sets the custom_entity_migrate creation timestamp.
   *
   * @param int $timestamp
   *   The custom_entity_migrate creation timestamp.
   *
   * @return $this
   */
  public function setCreatedTime($timestamp);

}
