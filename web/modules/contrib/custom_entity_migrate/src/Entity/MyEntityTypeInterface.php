<?php

namespace Drupal\custom_entity_migrate\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;
use Drupal\Core\Entity\EntityDescriptionInterface;

/**
 * Defines the interface for custom_entity_migrate types.
 */
interface MyEntityTypeInterface extends ConfigEntityInterface, EntityDescriptionInterface {
}
