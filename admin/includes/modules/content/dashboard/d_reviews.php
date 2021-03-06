<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2018 osCommerce

  Released under the GNU General Public License
*/

  class d_reviews {
    var $code;
    var $group;
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function __construct() {
      $this->code = get_class($this);
      $this->group = basename(dirname(__FILE__));
      $this->title = MODULE_ADMIN_DASHBOARD_REVIEWS_TITLE;
      $this->description = MODULE_ADMIN_DASHBOARD_REVIEWS_DESCRIPTION;
      $this->description .= '<div class="alert alert-info">' . MODULE_CONTENT_BOOTSTRAP_ROW_DESCRIPTION . '</div>';

      if ( defined('MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS') ) {
        $this->sort_order = MODULE_ADMIN_DASHBOARD_REVIEWS_SORT_ORDER;
        $this->enabled = (MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS == 'True');
      }
    }

    function execute() {
      global $oscTemplate, $languages_id;

      $content_width = MODULE_ADMIN_DASHBOARD_REVIEWS_CONTENT_WIDTH;
      $output = '';
      $output .= '<div class="col-sm-' . $content_width .' ' . strtr($this->code,'_','-') . '">';
      
      $output .= '<table class="table table-bordered table-striped table-hover">' .
                '   <thead>' .
                '       <tr class="dataTableHeadingRow">' .
                '           <th class="dataTableHeadingContent">' . MODULE_ADMIN_DASHBOARD_REVIEWS_TITLE . '</th>' .
                '           <th class="dataTableHeadingContent">' . MODULE_ADMIN_DASHBOARD_REVIEWS_DATE . '</th>' .
                '           <th class="dataTableHeadingContent">' . MODULE_ADMIN_DASHBOARD_REVIEWS_REVIEWER . '</th>' .
                '           <th class="dataTableHeadingContent">' . MODULE_ADMIN_DASHBOARD_REVIEWS_RATING . '</th>' .
                '           <th class="dataTableHeadingContent">' . MODULE_ADMIN_DASHBOARD_REVIEWS_REVIEW_STATUS . '</th>' .
                '       </tr>' . 
                '   </thead>';

      $reviews_query = tep_db_query("select r.reviews_id, r.date_added, pd.products_name, r.customers_name, r.reviews_rating, r.reviews_status from " . TABLE_REVIEWS . " r, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = r.products_id and pd.language_id = '" . (int)$languages_id . "' order by r.date_added desc limit 6");
      while ($reviews = tep_db_fetch_array($reviews_query)) {
        $status_icon = ($reviews['reviews_status'] == '1') ? tep_image('images/icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) : tep_image('images/icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
        $output .= '  <tr class="dataTableRow">' .
                   '    <td class="dataTableContent"><a href="' . tep_href_link('reviews.php', 'rID=' . (int)$reviews['reviews_id'] . '&action=edit') . '">' . $reviews['products_name'] . '</a></td>' .
                   '    <td class="dataTableContent">' . tep_date_short($reviews['date_added']) . '</td>' .
                   '    <td class="dataTableContent">' . tep_output_string_protected($reviews['customers_name']) . '</td>' .
                   '    <td class="dataTableContent">' . tep_image(HTTP_CATALOG_SERVER . DIR_WS_CATALOG_IMAGES . 'stars_' . $reviews['reviews_rating'] . '.gif') . '</td>' .
                   '    <td class="dataTableContent">' . $status_icon . '</td>' .
                   '  </tr>';
      }

      $output .= '</table>';

      $output .= '</div>';

      $oscTemplate->addContent($output, $this->group);
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Reviews Module', 'MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS', 'True', 'Do you want to show the latest reviews on the dashboard?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_ADMIN_DASHBOARD_REVIEWS_CONTENT_WIDTH', '12', 'What width container should the content be shown in? (12 = full width, 6 = half width).', '6', '2', 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_REVIEWS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS', 'MODULE_ADMIN_DASHBOARD_REVIEWS_CONTENT_WIDTH', 'MODULE_ADMIN_DASHBOARD_REVIEWS_SORT_ORDER');
    }
  }
?>