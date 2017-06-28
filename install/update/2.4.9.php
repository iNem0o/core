<?php
try {
      $re = '/s:\d*:(.*?);s:\d*:"(.*?)";s/';
      $result = array();
      foreach (ls('/tmp/jeedom-cache') as $folder) {
          foreach (ls('/tmp/jeedom-cache/' . $folder) as $file) {
              $path = '/tmp/jeedom-cache/' . $folder . '/' . $file;
              $str = (string) str_replace("\n", '', file_get_contents($path));
              preg_match_all($re, $str, $matches);
              if (!isset($matches[2]) || !isset($matches[2][0]) || trim($matches[2][0]) == '') {
                  continue;
              }
              $result[] = $matches[2][0];
          }
      }

      $cleanCache = array(
          'cmdCacheAttr' => 'cmd',
          'cmd' => 'cmd',
          'eqLogicCacheAttr' => 'eqLogic',
          'eqLogicStatusAttr' => 'eqLogic',
          'scenarioCacheAttr' => 'scenario',
          'cronCacheAttr' => 'cron',
          'cron' => 'cron',
      );

      foreach ($result as $key) {
          $matches = null;
          if (strpos($key, '::lastCommunication') !== false) {
              cache::delete($key);
              continue;
          }
          if (strpos($key, '::state') !== false) {
              cache::delete($key);
              continue;
          }
          if (strpos($key, '::numberTryWithoutSuccess') !== false) {
              cache::delete($key);
              continue;
          }
          foreach ($cleanCache as $kClean => $value) {
              if (strpos($key, $kClean) !== false) {
                  $id = str_replace($kClean, '', $key);
                  if (!is_numeric($id)) {
                      continue;
                  }
                  $object = $value::byId($id);
                  if (!is_object($object)) {
                      cache::delete($key);
                  }
                  continue;
              }
          }
          preg_match_all('/widgetHtml(\d*)(.*?)/', $key, $matches);
          if (isset($matches[1]) && isset($matches[1][0])) {
              if (!is_numeric($matches[1][0])) {
                  continue;
              }
              $object = eqLogic::byId($matches[1][0]);
              if (!is_object($object)) {
                  cache::delete($key);
              }
          }
          preg_match_all('/camera(\d*)(.*?)/', $key, $matches);
          if (isset($matches[1]) && isset($matches[1][0])) {
              if (!is_numeric($matches[1][0])) {
                  continue;
              }
              $object = eqLogic::byId($matches[1][0]);
              if (!is_object($object)) {
                  cache::delete($key);
              }
          }
          preg_match_all('/scenarioHtml(.*?)(\d*)/', $key, $matches);
          if (isset($matches[1]) && isset($matches[1][0])) {
              if (!is_numeric($matches[1][0])) {
                  continue;
              }
              $object = scenario::byId($matches[1][0]);
              if (!is_object($object)) {
                  cache::delete($key);
              }
          }
          if (strpos($key, 'widgetHtmlmobile') !== false) {
              $id = str_replace('widgetHtmlmobile', '', $key);
              if (is_numeric($id)) {
                  cache::delete($key);
              }
              continue;
          }
          if (strpos($key, 'widgetHtmldashboard') !== false) {
              $id = str_replace('widgetHtmldashboard', '', $key);
              if (is_numeric($id)) {
                  cache::delete($key);
              }
              continue;
          }
          if (strpos($key, 'widgetHtmldplan') !== false) {
              $id = str_replace('widgetHtmldplan', '', $key);
              if (is_numeric($id)) {
                  cache::delete($key);
              }
              continue;
          }
          if (strpos($key, 'widgetHtml') !== false) {
              $id = str_replace('widgetHtml', '', $key);
              if (is_numeric($id)) {
                  cache::delete($key);
              }
              continue;
          }
          if (strpos($key, 'cmd') !== false) {
              $id = str_replace('cmd', '', $key);
              if (is_numeric($id)) {
                  cache::delete($key);
              }
              continue;
          }
          preg_match_all('/dependancy(.*)/', $key, $matches);
          if (isset($matches[1]) && isset($matches[1][0])) {
              try {
                  $plugin = plugin::byId($matches[1][0]);
                  if (!is_object($plugin)) {
                      cache::delete($key);
                  }
              } catch (Exception $e) {
                  cache::delete($key);
              }
          }
      }
  } catch (Exception $e) {

  }
shell_exec('sudo mkdir -p /home/jeedomtmp');
shell_exec('sudo mv /tmp /home/jeedomtmp');
jeedom::update();
die();
?>