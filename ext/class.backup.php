<?php

  class backup {
  
    function do_backup () {
    
      $extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['ahx_backup']);
    
      ahx_lib::writeLog(4, 0, 0, 0, '[ahx_backup] Datenbanksicherung beginnt.', 0);

//      exec('d:/profiles/aherbst/documents/programme/xampp/mysql/bin/mysqldump --host=localhost --user=root typo3 > d:/profiles/aherbst/documents/programme/xampp/htdocs/typo3temp/typo3_dump.sql');
      if (isset($output)) unset($output);
      exec('"' . $extConf['mysqlDumpPath'] . '" --host=' . TYPO3_db_host . ' --user=' . TYPO3_db_username . ' typo3 > ' . PATH_site . 'typo3temp/typo3_dump.sql', $output);

      $mail = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Mail\\MailMessage');
      $mail->setFrom(array('alexander.herbst@inapa-packaging.de' => 'Alexander Herbst'))
           ->setTo(array('alexander.herbst@inapa-packaging.de' => 'Alexander Herbst'))
           ->setSubject('backup')
           ->setBody(implode("\n", $output))
           ->send();
     
      ahx_lib::writeLog(4, 0, 0, 0, '[ahx_backup] Datenbanksicherung beendet.', 0);
      ahx_lib::writeLog(4, 0, 0, 0, '[ahx_backup] Datensicherung beginnt.', 0);

//      exec('"c:/program files/7-zip/7z.exe" u d:/profiles/aherbst/documents/programme/xampp/typo3_backup-%date%.zip d:/profiles/aherbst/documents/programme/xampp/htdocs/');
      if (isset($output)) unset($output);
      exec('"' . $extConf['zipperPath'] . '" u ' . $extConf['backupDir'] . '/typo3_backup.zip ' . PATH_site, $output);
    
      $mail = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Mail\\MailMessage');
      $mail->setFrom(array('alexander.herbst@inapa-packaging.de' => 'Alexander Herbst'))
           ->setTo(array('alexander.herbst@inapa-packaging.de' => 'Alexander Herbst'))
           ->setSubject('backup')
           ->setBody(implode("\n", $output))
           ->send();

      ahx_lib::writeLog(4, 0, 0, 0, '[ahx_backup] Datensicherung beendet.', 0);

      return true;
    
    } // eof backup()
    
  }

?>