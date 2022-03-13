<?php

/**
 * @file
 * Post update functions for SurveyStack module.
 */

/**
 * Add hidden surveystack_id field to assets and logs.
 */
function farm_surveystack_post_update_surveystack_id(&$sandbox) {
  $field_id = 'surveystack_id';
  $field_definition = \Drupal::service('farm_field.factory')->baseFieldDefinition([
    'type' => 'string',
    'label' => t('Surveystack ID'),
    'hidden' => TRUE,
  ]);
  foreach (['asset', 'log'] as $entity_type) {
    \Drupal::entityDefinitionUpdateManager()->installFieldStorageDefinition($field_id, $entity_type, 'farm_surveystack', $field_definition);
  }
}

/**
 * Install Common profile module.
 */
function farm_surveystack_post_update_enable_profile_common(&$sandbox = NULL) {
  if (!\Drupal::service('module_handler')->moduleExists('farm_profile_common')) {
    \Drupal::service('module_installer')->install(['farm_profile_common']);
  }
}
