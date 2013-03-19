<?php
/**
 * @file
 * acp_bootstrap's primary theme functions and alterations.
 */

/**
 * Override or insert variables into the page template.
 *
 * Implements template_process_page().
 */
function acp_bootstrap_preprocess_page(&$variables) {
  // Get theme settings
  $variables['acp_phone'] = theme_get_setting('phone_number', 'acp_bootstrap');
  $variables['acp_rss'] = theme_get_setting('rss_url', 'acp_bootstrap');
  $variables['acp_fb'] = theme_get_setting('fb_url', 'acp_bootstrap');
  $variables['acp_twitter'] = theme_get_setting('twitter_url', 'acp_bootstrap');
  $variables['acp_linkedin'] = theme_get_setting('linkedin_url', 'acp_bootstrap');
  
  // Build the search form
  $search_box = drupal_get_form('search_form');
  unset($search_box['#attributes']['class']);
  $search_box['#attributes']['class'][] = 'search';
  $search_box['basic']['keys']['#title'] = '<div id="search-trigger">Search:</div>';
  $search_box['basic']['keys']['#prefix'] = '';
  $search_box['basic']['keys']['#attributes']['class'][] = 'search-box';
  $search_box['basic']['keys']['#attributes']['placeholder'][] = 'search + enter';
  $search_box['basic']['keys']['#attributes']['style'][] = 'search + enter';
  $search_box['basic']['submit']['#attributes']['class'][] = 'element-invisible';
  $variables['search_box'] = drupal_render($search_box);
}

/**
 * Implements theme_links__system_main_menu.
 */
function acp_bootstrap_links__system_main_menu($variables) {
  $links = $variables['links'];
  $attributes = $variables['attributes'];
  $heading = $variables['heading'];
  unset($links['#sorted']);
  unset($links['#theme_wrappers']);
  global $language_url;
  $output = '';

  if (count($links) > 0) {
    $output = '';

    // Treat the heading first if it is present to prepend it to the
    // list of links.
    if (!empty($heading)) {
      if (is_string($heading)) {
        // Prepare the array that will be used when the passed heading
        // is a string.
        $heading = array(
          'text' => $heading,
          // Set the default level of the heading.
          'level' => 'h2',
        );
      }
      $output .= '<' . $heading['level'];
      if (!empty($heading['class'])) {
        $output .= drupal_attributes(array('class' => $heading['class']));
      }
      $output .= '>' . check_plain($heading['text']) . '</' . $heading['level'] . '>';
    }

    $output .= '<ul' . drupal_attributes($attributes) . '>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = array($key);

      // Add first/last/active classes to help out themers.
      if ($i == 1) {
        $class[] = 'first';
      }
      if ($i == $num_links) {
        $class[] = 'last';
      }
      if (isset($link['#href']) && ($link['#href'] == $_GET['q'] || ($link['#href'] == '<front>' && drupal_is_front_page()))
        && (empty($link['#language']) || $link['#language']->language == $language_url->language)) {
        $class[] = 'active';
      }
      if (!empty($link['#below'])) {
        $class[] = 'dropdown parent';
        $link['#attributes']['data-toggle'] = 'dropdown';
        $link['#attributes']['class'][] = 'dropdown-toggle';
        $link['#href'] = NULL;
      }
      $options['attributes'] = $link['#attributes'];

      $output .= '<li' . drupal_attributes(array('class' => $class)) . '>';

      if (isset($link['#href'])) {
        // Pass in $link as $options, they share the same keys.
        $output .= l($link['#title'], $link['#href'], array('attributes' => $link['#attributes']));
      }
      // Put in empty anchor for dropdown.
      elseif ($link['#attributes']['data-toggle'] && !isset($link['#href'])) {
        $output .= str_replace('href="/"', 'href="#"', l(check_plain($link['#title']) . "<i></i>", $link['#href'], array('attributes' => $link['#attributes'], 'html' => TRUE)));
      }
      elseif (!empty($link['#title'])) {
        // Wrap non-<a> links in <span> for adding title and class attributes.
        if (empty($link['#html'])) {
          $link['#title'] = check_plain($link['#title']);
        }
        $span_attributes = '';
        if (isset($link['#attributes'])) {
          $span_attributes = drupal_attributes($link['#attributes']);
        }
        $output .= '<span' . $span_attributes . '>' . $link['#title'] . '</span>';
      }

      if (!empty($link['#below'])) {
        $output .= theme('links__system_main_menu', array(
          'links' => $link['#below'],
          'attributes' => array(
            'class' => array(''),
          ),
        ));
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}

/**
 * Implements hook_ctools_plugin_post_alter()
 */
function acp_bootstrap_ctools_plugin_post_alter(&$plugin, &$info) {
  if ($info['type'] == 'styles') {
    if ($plugin['name'] == 'kalacustomize') {
      $plugin['title'] = 'American Charities for Palestine';
    }
  }
}

/**
 * Implements hook_form_FORM_ID_alter().
 */
function acp_bootstrap_form_panels_edit_style_settings_form_alter(&$form, &$form_state) {
  // Add some extra ASU styles if extra styles are on
  if (isset($form['general_settings']['settings']['title'])) {
    $styles = array('title', 'content');
    foreach ($styles as $style) {
      $form['general_settings']['settings'][$style]['attributes']['#options'] += array(
        'short-headline' => 'SHORT HEADLINE',
      );
    }
  }
  // Add some more default pane styles
  if (isset($form['general_settings']['settings']['pane_style'])) {
    $form['general_settings']['settings']['pane_style']['#options'] += array(
      'call-to-action' => 'CALL TO ACTION',
    );
  }
}
