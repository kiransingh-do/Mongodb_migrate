<?php

namespace Drupal\my_entity;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\my_entity\Entity\MyEntityInterface;

/**
 * Defines the my_entity storage.
 */
class MyEntityStorage extends SqlContentEntityStorage implements MyEntityStorageInterface {
}
