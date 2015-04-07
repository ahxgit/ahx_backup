<?php

  if (!class_exists('tx_scheduler_Task')) {
    require_once(dirname(__FILE__) . '/../../../../typo3/sysext/scheduler/class.tx_scheduler_task.php');
  }

  class tx_ahx_backup_backup extends tx_scheduler_Task {  
  
    public function execute() {    
      
      $extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['ahx_backup']);
      $GLOBALS['TYPO3_CONF_VARS']['LOG']['writerConfiguration'] = array(
        $extConf['extLog'] => array('TYPO3\\CMS\\Core\\Log\\Writer\\DatabaseWriter' => array())
      );

      return backup::do_backup();  
    
    }
    
  }
  
?>