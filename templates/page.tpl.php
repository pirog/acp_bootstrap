<?php

/**
 * @file
 * Kalatheme's implementation to display a single Drupal page.
 *
 * The doctype, html, head, and body tags are not in this template. Instead
 * they can be found in the html.tpl.php template normally located in the
 * core/modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $main_menu_expanded (array): An array containing 2 depths of the Main
 *   menu links
 *   for the site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on
 *   the menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node entity, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Kalatheme:
 * - $no_panels: A boolean that is true if the current page is not a panels page
 *
 * Regions:
 * - $page['content']: The main content of the current page.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see bartik_process_page()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>

<!-- begin accesibility skip to nav skip content -->
<ul class="visuallyhidden" id="top">
  <li><a href="#nav" title="Skip to navigation" accesskey="n">Skip to
      navigation</a></li>
  <li><a href="#page" title="Skip to content" accesskey="c">Skip to
      content</a></li>
</ul>
<!-- end /.visuallyhidden accesibility-->

<!-- mobile navigation trigger-->
<h5 class="mobile_nav">
  <a href="javascript:void(0)">&nbsp;<span></span>
  </a>
</h5>
<!--end mobile navigation trigger-->

<section
  class="container preheader">

  <!--this is the login for the user-->
  <nav class="user clearfix">
    <a href="user"><i class="icon-user"></i> Login</a>
  </nav>
  <!--close user nav-->

  <div class="search-wrapper">
    <?php print $search_box; ?>
  </div>
  <div class="phone">
    <a href="tel:<?php print preg_replace("/[^0-9,.]/", "", $acp_phone); ?>" class="tele"><?php print $acp_phone; ?></a>
  </div>
  <ul class="social">
    <li><a class="socicon small rss" href="<?php print $acp_rss; ?>" data-placement="bottom"
      title="Subscribe to our RSS feed"></a></li>
    <li><a class="socicon small facebook" href="<?php print $acp_fb; ?>"
      data-placement="bottom" title="Follow us on Facebook"></a></li>
    <li><a class="socicon small twitterbird" href="<?php print $acp_twitter; ?>"
      data-placement="bottom" title="Follow us on Twitter"></a></li>
    <li><a class="socicon small linkedin" href="<?php print $acp_linkedin; ?>"
      data-placement="bottom" title="Follow us on LinkedIn"></a></li>
  </ul>

</section>

<!-- begin .header-->
<header class="header  clearfix">
  <img src="assets/images/print-logo.png" class="print logo"
    alt="<?php print $site_name; ?>" />
  <div class="container">

    <!-- begin #main_menu -->
    <nav id="main_menu" class="ddsmoothmenu">
      <?php if ($main_menu_expanded): ?>
      <?php print theme('links__system_main_menu', array(
        'links' => $main_menu_expanded,
        'attributes' => array('class' => array('accordmobile'),),
        'heading' => array(
          'text' => t('Main menu'),
          'level' => 'h2',
          'class' => array('element-invisible'),),
        )); ?>
      <?php endif; ?>
    </nav>
    <!-- close / #main_menu -->

    <!-- begin #logo -->
    <div id="logo">
      <a href="/"><img alt="<?php print $site_name; ?>" src="<?php print $logo; ?>" /><em>Crisp
          Responsive HTML Retina Ready Bootstrap Goodness</em> <!--effing ie7 support-->
      </a>
    </div>
    <!-- end #logo -->

  </div>
  <!-- close / .container-->
</header>
<!-- close /.header -->

<!-- begin #page - the container for everything but header -->
<div id="page">
  <?php if ($tabs): ?>
  <div id="tabs" class="container">
    <?php print render($tabs); ?>
  </div>
  <?php endif; ?>

  <?php if ($action_links): ?>
  <div id="action-links" class="container">
    <?php print render($action_links); ?>
  </div>
  <?php endif; ?>

  <?php if ($messages): ?>
  <div id="messages">
    <div class="section clearfix container">
      <?php print $messages; ?>
    </div>
  </div>
  <!-- /.section, /#messages -->
  <?php endif; ?>
  
  <div id="main">
    <div class="section clearfix main-content <?php $no_panels ? print ' container"' : ''; ?>">
      <?php print render($page['content']); ?>
    </div>
  </div>
</div>
<!-- close #page-->
