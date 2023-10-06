<?php

namespace Drupal\custom_entity_migrate;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\custom_entity_migrate\Entity\MyEntityInterface;

/**
 * Defines the custom_entity_migrate storage.
 */
class MyEntityStorage extends SqlContentEntityStorage implements MyEntityStorageInterface {
}
