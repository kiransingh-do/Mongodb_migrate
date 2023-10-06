<?php

namespace Drupal\my_entity\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;
use Drupal\Core\Entity\EntityDescriptionInterface;

/**
 * Defines the interface for my_entity types.
 */
interface MyEntityTypeInterface extends ConfigEntityInterface, EntityDescriptionInterface {
}
