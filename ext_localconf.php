<?php

  if (!defined ("TYPO3_MODE"))   die ("Access denied.");
    
  $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['tx_ahx_backup_backup'] = array(
    'extension' => $_EXTKEY,    
    'title' => 'Typo3 sichern',    
    'description' => 'Dieser Task sichert die komplette Installation inklusive der Datenbank.'
  );    

?>