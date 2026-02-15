<?php

/**
 * @file
 * Post update functions for SurveyStack Conventions module.
 */

/**
 * Implements hook_removed_post_updates().
 */
function farm_log_removed_post_updates() {
  return [
    'farm_surveystack_convention_post_update_enable_termination' => '3.x',
    'farm_surveystack_convention_post_update_enable_convention' => '3.x',
  ];
}
