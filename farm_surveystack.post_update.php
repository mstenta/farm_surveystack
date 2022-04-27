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

/**
 * Add surveystack_id field to profiles.
 */
function farm_surveystack_post_update_surveystack_id_profile(&$sandbox = NULL) {
  $field_definition = \Drupal::service('farm_field.factory')->baseFieldDefinition([
    'type' => 'string',
    'label' => t('Surveystack ID'),
    'hidden' => TRUE,
  ]);
  \Drupal::entityDefinitionUpdateManager()->installFieldStorageDefinition('surveystack_id', 'profile', 'farm_surveystack', $field_definition);
}

/**
 * Install SurveyStack Conventions module.
 */
function farm_surveystack_post_update_enable_surveystack_convention(&$sandbox = NULL) {

  // First, delete all custom flags. This is safe to do because the flag field
  // stores the flag ID string, not a reference to the config entity itself.
  // So once farm_surveystack_convention is installed, these will be recreated.
  $flags = [
    'greenhouse',
    'hydroponic',
    'non_gmo',
    'organic_not_cert',
    'regenerative',
    'transitionalregen',
  ];
  foreach ($flags as $flag) {
    \Drupal::configFactory()->getEditable('farm_flag.flag.' . $flag)->delete();
  }

  // Install farm_surveystack_convention.
  if (!\Drupal::service('module_handler')->moduleExists('farm_surveystack_convention')) {
    \Drupal::service('module_installer')->install(['farm_surveystack_convention']);
  }
}
