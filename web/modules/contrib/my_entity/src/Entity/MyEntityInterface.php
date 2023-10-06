<?php

namespace Drupal\my_entity\Entity;

use Drupal\address\AddressInterface;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Defines the interface for my entity items.
 */
interface MyEntityInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the my_entity name.
   *
   * @return string
   *   The my_entity name.
   */
  public function getName();

  /**
   * Sets the my_entity name.
   *
   * @param string $name
   *   The my_entity name.
   *
   * @return $this
   */
  public function setName($name);

  /**
   * Gets the my_entity creation timestamp.
   *
   * @return int
   *   The my_entity creation timestamp.
   */
  public function getCreatedTime();

  /**
   * Sets the my_entity creation timestamp.
   *
   * @param int $timestamp
   *   The my_entity creation timestamp.
   *
   * @return $this
   */
  public function setCreatedTime($timestamp);

}
