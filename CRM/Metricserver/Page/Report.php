<?php

require_once 'CRM/Core/Page.php';

class CRM_Metricserver_Page_Report extends CRM_Core_Page {
  function run() {


    $sql = "SELECT * FROM civicrm_metrics_server ORDER BY site_name, timestamp";
    $dao =& CRM_Core_DAO::executeQuery($sql);
    $rows = array();
    while($dao->fetch()) {
      $row = array();
      $row['id'] = $dao->id;
      $row['site_name'] = $dao->site_name;
      $row['site_url'] = $dao->site_url;
      $row['timestamp'] = $dao->timestamp;
      $row['type'] = $dao->type;
      $row['data'] = $dao->data;
      $rows[] = $row;
    }

    if (array_key_exists("export", $_REQUEST) && $_REQUEST['export'] == 'csv') {
      header('Content-type: text/csv');
      header('Content-disposition: attachment;filename=metrics_data_'.date("Ymd_HiO").'.csv');
      $output = fopen('php://output', 'w');

      $headers = array("Id","Site Name","Site URL","Timestamp","Metric Type","Metric Data");
      fputcsv($output, $headers);

      foreach($rows as $row) {
        fputcsv($output, $row);
      }

      fclose($output);
      die();

    } else {

      CRM_Utils_System::setTitle(ts('Metrics Report'));
      if (count($rows)) {
        $this->assign('data', $rows);
        $this->assign('headers', array_keys($rows[0]));
      }
      parent::run();
    }
  }
}
