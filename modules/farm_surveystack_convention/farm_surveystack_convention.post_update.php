<?php

/**
 * @file
 * Post update functions for SurveyStack Conventions module.
 */

/**
 * Install Asset Termination module.
 */
function farm_surveystack_convention_post_update_enable_termination(&$sandbox = NULL) {
  $module = 'farm_asset_termination';
  if (!\Drupal::service('module_handler')->moduleExists('farm_asset_termination')) {
    \Drupal::service('module_installer')->install(['farm_asset_termination']);
  }
}
