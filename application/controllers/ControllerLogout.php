<?php
class ControllerLogout extends ControllerBase { 

    public function actionDefault() {
        
        unset($_SESSION['auth']);
        unset($_SESSION['user']);
        
        $Message = new HtmlMessageSuccess('Logged Out!', 'You have logged out of the Creative Arts Guide. If you would like to log back in, use the Login link on the top right navigation bar.');
        $this->getTemplate()->body->msg = $Message->fetch();
        
    }

}
?>