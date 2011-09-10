<?php
class AppController extends Controller {

    var $components = array('Security');
    var $helpers = array('Html','Form','Session');    

    function beforeFilter() {
	
	parent::beforeFilter();
        
        // Enforce a login for admins
        if ($this->params['controller'] == 'admin' || $this->params['action'] == 'winner') {
            global $AdminUsers;
            $this->Security->loginOptions = array('type' => 'basic', 'realm' => 'Admin Area');
            $this->Security->loginUsers = $AdminUsers;
            $this->Security->requireLogin();
        }
        
    }
}