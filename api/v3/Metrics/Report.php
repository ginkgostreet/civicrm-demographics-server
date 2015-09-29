<?php

/**
 * Metrics.report API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRM/API+Architecture+Standards
 */
function _civicrm_api3_metrics_report_spec(&$spec) {
  $spec['site_name']['api.required'] = 1;
  $spec['site_url']['api.required'] = 1;
  $spec['data']['api.required'] = 1;
}

/**
 * Metrics.report API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_metrics_report($params) {
  if (
    !array_key_exists('site_name', $params) || !$params['site_name'] ||
    !array_key_exists('site_url', $params) || !$params['site_url'] ||
    !array_key_exists('data', $params) || !$params['data'] ||
    !is_array($params['data']) || empty($params['data'])
  ) {
    throw new API_Exception(ts('site_name, site_url and data are all required parameters'), 1);
  }

  foreach($params['data'] as $row) {
    $sql = "INSERT INTO `civicrm_metrics_server` (`site_name`, `site_url`, `timestamp`, `type`, `data`) VALUES (%1, %2, NOW(), %3, %4)";
    $values = array();
    $values[1] = array($params['site_name'], "String");
    $values[2] = array($params['site_url'], "String");
    $values[3] = array($row['type'], "String");
    if(is_array($row['data'])) {
      if ((PHP_MAJOR_VERSION == 5 && PHP_MINOR_VERSION >= 4) || PHP_MAJOR_VERSION > 5) {
        $values[4] = array(json_encode($row['data'], JSON_UNESCAPED_UNICODE), "String");
      } else {
        $values[4] = array(json_encode($row['data']), "String");
      }
    } else {
      $values[4] = array($row['data'], "String");
    }
    
    $dao =& CRM_Core_DAO::executeQuery($sql, $values);
  }

  return civicrm_api3_create_success(count($params['data']), $params, 'Metrics', 'report');
}
