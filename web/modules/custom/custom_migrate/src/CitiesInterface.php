<?php

namespace Drupal\custom_migrate;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface defining a cities entity type.
 */
interface CitiesInterface extends ContentEntityInterface {

  /** 
   * Gets the city name.
   *
   * @return string
   *   The custom_migrate name.
   */
  public function getLabel();

  /**
   * Gets the city id.
   *
   * @return int
   *   The custom_migrate city id
   */
  public function getId();

   /**
   * Sets the custom_migrate state name.
   *
   * @param string $name
   *   The custom_migrate name.
   *
   * @return $this
   */
  
  public function getState();

  /**
   * Gets the POP id.
   *
   * @return int
   *   The custom_migrate POP id
   */
  public function getPOP();

}
