<?php
namespace Drupal\custom_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SourcePluginBase;
use Drupal\migrate\Row;
use Drupal\migrate\Plugin\MigrationInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use MongoDB\Client as MongoClient;

/**
 * Source plugin for MongoDB data.
 *
 * @MigrateSource(
 *   id = "mongodb_source"
 * )
 */
class MongoDBSource extends SourcePluginBase {

  /**
   * MongoDB client.
   *
   * @var \MongoDB\Client
   */
  protected $client;

  /**
   * MongoDBSource constructor.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, MigrationInterface $migration) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $migration);
    $this->client = new MongoClient('mongodb://localhost:27017');
  }

  /**
   * Initialize the iterator with MongoDB data.
   */
  public function initializeIterator() {
    $collection = $this->client->selectCollection('Blog', 'cities');
    //dump($collection->find());die();
    $data= $collection->find();
    $rows = [];
    foreach ($data as $document) {
       $rows[] =  (array) $document;

       
    }
    //dump($rows); die();
    // return $value['city'] ;
   return new \ArrayIterator($rows);
    // You might need to adjust this depending on your specific data structure.
}

  /**
   * {@inheritdoc}
   */
  public function fields() {
    // Define available fields in your source data here.
    ['_id', 'city', 'loc', 'pop', 'state'];
    return[] ;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    // Define the primary key of your source data here.
    // Define the primary key(s) of your source data.
    ['_id' => ['type' => 'integer']];
    return [];
  }

/**
 * Returns a string representing the object.
 *
 * @return string
 *   A string representation of the object.
 */
public function __toString() {
    return "MigrateMongoDB Source Plugin"; 
  }
}
