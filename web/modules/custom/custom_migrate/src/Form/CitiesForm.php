<?php

namespace Drupal\custom_migrate\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the cities entity edit forms.
 */
class CitiesForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $result = parent::save($form, $form_state);

    $entity = $this->getEntity();

    $message_arguments = ['%label' => $entity->toLink()->toString()];
    $logger_arguments = [
      '%label' => $entity->label(),
      'link' => $entity->toLink($this->t('View'))->toString(),
    ];

    switch ($result) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('New cities %label has been created.', $message_arguments));
        $this->logger('custom_migrate')->notice('Created new cities %label', $logger_arguments);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The cities %label has been updated.', $message_arguments));
        $this->logger('custom_migrate')->notice('Updated cities %label.', $logger_arguments);
        break;
    }

    $form_state->setRedirect('entity.cities.canonical', ['cities' => $entity->id()]);

    return $result;
  }

}
