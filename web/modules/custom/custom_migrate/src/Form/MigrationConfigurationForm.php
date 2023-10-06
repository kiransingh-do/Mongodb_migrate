<?php

namespace Drupal\custom_migrate\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\Yaml\Yaml;

class MigrationConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_migration_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['custom_migration.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $module_handler = \Drupal::moduleHandler();
    $module_path = $module_handler->getModule('custom_migrate')->getPath();
    $config_path = $module_path . '/migrations/custom_migration.yml';  
    $config_data = Yaml::parseFile($config_path);
    $process_keys = array_keys($config_data['process']);
    
    
    $form['city'] = [
        '#type' => 'select',
        '#title' => $this->t('Label'),
        '#options' => array_combine($process_keys, $process_keys),
      ];
    
    $form['state'] = [
        '#type' => 'select',
        '#title' => $this->t('State'),
        '#options' => array_combine($process_keys, $process_keys),
      ];

    $form['pop'] = [
        '#type' => 'select',
        '#title' => $this->t('Pop'),
        '#options' => array_combine($process_keys, $process_keys),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
 
    $pop = $form_state->getValue('pop');
    $city = $form_state->getValue('city');
    $state = $form_state->getValue('state');

    $config = \Drupal::service('config.factory')->getEditable('custom_migration.custom_migrate');
    //Set and save new key value of pop fields.
    $config->set('pop', $pop)->save();
    $config->set('label', $city)->save();
    $config->set('state', $state)->save();

    parent::submitForm($form, $form_state);
  }

}
