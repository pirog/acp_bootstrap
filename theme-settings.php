<?php

/**
 * @file
 * Theme setting callbacks for acp_bootstrap.
 */

/**
 * Implements hook_form_FORM_ID_alter().
 */
function acp_bootstrap_form_system_theme_settings_alter(&$form, &$form_state) {
  // Need to pass this through to use list_allowed_values_string without errors.
  // Panels styles style plugin settings.
  $form['acp'] = array(
    '#type' => 'fieldset',
    '#title' => t('American Charities Config'),
    '#weight' => 43,
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
    '#description' => t('Some basic settings for ACP.'),
  );
  $form['acp']['phone_number'] = array(
    '#type' => 'textfield',
    '#title' => t('Phone Number'),
    '#default_value' => theme_get_setting('phone_number'),
  );
  $form['acp']['rss_url'] = array(
    '#type' => 'textfield',
    '#title' => t('RSS URL'),
    '#default_value' => theme_get_setting('rss_url'),
  );
  $form['acp']['fb_url'] = array(
    '#type' => 'textfield',
    '#title' => t('Facebook URL'),
    '#default_value' => theme_get_setting('fb_url'),
  );
  $form['acp']['twitter_url'] = array(
    '#type' => 'textfield',
    '#title' => t('Twitter URL'),
    '#default_value' => theme_get_setting('twitter_url'),
  );
  $form['acp']['linkedin_url'] = array(
    '#type' => 'textfield',
    '#title' => t('LinkedIn URL'),
    '#default_value' => theme_get_setting('linkedin_url'),
  );
}