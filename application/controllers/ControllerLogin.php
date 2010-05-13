<?php
class ControllerLogin extends ControllerBase { 

    public function actionDefault() {
        
        $this->getTemplate()->body->recoverUrl = $this->getRouter()->getNewUrl(false, 'recover');

        $urlPassReset = $this->getRouter()->getNewUrl(false, 'recover');
        $urlRegister = $this->getRouter()->getNewUrl('register');
        $noteSections = array(
          'user-portal' => 'Enter your logon credentials to enter the user
            portal.',
          'not-registered?' => 'To register an account, simply go to the
            user <a href="'.$urlRegister.'">registration</a> page.',
          'forgot-your-password?' => 'You can reset your password by going to
            the account <a href="'.$urlPassReset.'">recovery</a> page.'
        );
        
        $Form = new Form('logon', $this->getRouter(), $this->getRequest());
        $Form->attach(new FormFieldset('logonCredentials'));
        $Form->logonCredentials->setLegend('Logon Credentials');

        $FormNote2 = new FormNote('forgotpassword', FormNote::POSITIONRIGHT);
        $FormNote2->addSection('Registration', 
          'Don\'t have an account yet? Simply go to the user 
          <a href="'.$urlRegister.'">registration</a> page to create one.');
        $FormNote2->addSection('Password Reset', 
          'Having trouble logging on? You can reset your password by going to the account 
            <a href="'.$urlPassReset.'">recovery</a> page.');
        $Form->logonCredentials->attach($FormNote2);
        
        $FormNote1 = new FormNote('logonmessage', FormNote::POSITIONNORMAL);
        $FormNote1->addSection(false,
          'Enter the requested credentials to log onto the registered user portal.');
        $Form->logonCredentials->attach($FormNote1);

        
        $Form->logonCredentials->attach(new FormInput('username', 'E-Mail Address'));
        $Form->logonCredentials->username->restrict(new FormRestrictionNotEmpty());
        $Form->logonCredentials->username->restrict(new FormRestrictionEmail());
        $Form->logonCredentials->username->restrict(new FormRestrictionMaxLength(200));
        
        $Form->logonCredentials->attach(new FormInput('password', 'Password', 'password'));
        $Form->logonCredentials->password->restrict(new FormRestrictionNotEmpty());
        $Form->logonCredentials->password->restrict(new FormRestrictionMaxLength(255));
        
        $Form->logonCredentials->attach(new FormInputSubmit('Logon'));

        if($Form->ok()) 
        {
            $query = 'SELECT :T1.id, :T1.firstname, :T1.lastname, :T1.email
                      FROM :T1
                      WHERE :T1.email=:A1 AND :T1.password=:A2
                      LIMIT 1';
            $DbStmt = $this->getDatabase()->prepare($query, array(DB_NAME.'.user'))->execute(array($this->getRequest()->username, md5($this->getRequest()->password)));
            
            if($DbStmt->numRows() != 1)
            {
                $Form->logonCredentials->username->restrict(new FormRestrictionAlwaysTrue('The username or password was incorrect.'));
                $Form->logonCredentials->password->restrict(new FormRestrictionAlwaysTrue('The username or password was incorrect.'));
                $this->getTemplate()->body->form = $Form->fetchNew();
            }
            else
            {
                $DbStmt->first();
                
                $query2 = 'SELECT :T1.id
                          FROM :T1
                          WHERE :T1.user_id=:A1
                          LIMIT 1';
                $DbStmt2 = $this->getDatabase()->prepare($query2, array(DB_NAME.'.user_activate'))->execute(array($DbStmt->id));
                
                if($DbStmt2->numRows() == 1)
                {
                    $Message = new HtmlMessageError('Error!', 'Your account has not yet been activated. Check your e-mail for an activation message from us that has a link your must follow to verify you provided a valid e-mail and enable your account.');
                    $this->getTemplate()->body->form = $Message->fetch();      
                }
                else
                {
                    $_SESSION['auth'] = true;
                    $_SESSION['user'] = array(
                        'id' => $DbStmt->id,
                        'firstname' => $DbStmt->firstname,
                        'lastname' => $DbStmt->lastname,
                        'fullname' => $DbStmt->firstname.' '.$DbStmt->lastname,
                        'email' => $DbStmt->email
                    );
                    
                    $Message = new HtmlMessageSuccess('Logged On!', 'Welcome '.$_SESSION['user']['fullname'].'. <br />You are now logged onto the Creative Arts Guide.');
                    $this->getTemplate()->body->form = $Message->fetch();
                }
            }
        }
        else
        {
            $this->getTemplate()->body->form = $Form->fetch();
        }
        
    }
    
    public function actionRecover() {
      
      $Form = new Form('logon', $this->getRouter(), $this->getRequest());
      $Form->attach(new FormFieldset('logonCredentials'));
      $Form->logonCredentials->setLegend('Logon Credentials');
      
      $FormNote1 = new FormNote('logonmessage', FormNote::POSITIONNORMAL);
      $FormNote1->addSection(false,
        'Please provide the e-mail address registered with us to begin the password reset process.');
      $Form->logonCredentials->attach($FormNote1);
      
      $Form->logonCredentials->attach(new FormInput('username', 'E-Mail Address'));
      $Form->logonCredentials->username->restrict(new FormRestrictionNotEmpty());
      $Form->logonCredentials->username->restrict(new FormRestrictionEmail());
      $Form->logonCredentials->username->restrict(new FormRestrictionMaxLength(48));
      $Form->logonCredentials->attach(new FormInputSubmit('Recover Password'));

      if($Form->ok()) 
      {
      
      }
      else
      {
          $this->getTemplate()->body->form = $Form->fetch();
      }
      
    }

}
?>