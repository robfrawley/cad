 <?php
class ControllerRegister extends ControllerBase { 

    public function actionDefault() {
        
        $Form = $this->_buildRegistrationForm();        

        if($Form->ok()) 
        {
            $query = 'SELECT :T1.id
                      FROM :T1
                      WHERE :T1.email=:A1
                      LIMIT 1';
            $DbStmt = $this->getDatabase()->prepare($query, array(DB_NAME.'.user'))->execute(array($this->getRequest()->email));
            if($DbStmt->numRows() > 0)
            {
                $Form->personalInfo->email->restrict(new FormRestrictionAlwaysTrue('This e-mail is already associated with a user.'));
                $this->getTemplate()->body->form = $Form->fetchNew();
            }
            else
            {
                $query = 'INSERT INTO :T1
                          SET :T1.firstname=:A1,
                              :T1.lastname=:A2,
                              :T1.email=:A3,
                              :T1.password=:A4';
                $DbStmt = $this->getDatabase()->prepare($query, array(DB_NAME.'.user'))->execute(array($this->getRequest()->firstName, $this->getRequest()->lastName, $this->getRequest()->email, md5($this->getRequest()->password)));
                $insertId = $DbStmt->insertId();
                
                if(!$insertId > 0)
                {
                    $this->displayGeneralError();
                }
                else
                {
                    $userKey = md5($this->getRequest()->firstName . $this->getRequest()->lastName . $this->getRequest()->email . time());
                    
                    $query2 = 'INSERT INTO :T1
                               SET :T1.user_id=:A1,
                                   :T1.userKey=:A2';
                    $DbStmt2 = $this->getDatabase()->prepare($query2, array(DB_NAME.'.user_activate'))->execute(array($insertId, $userKey));
                    $insertId2 = $DbStmt2->insertId();
                    if(!$insertId2 > 0)
                    {
                        $this->displayGeneralError();
                    }
                    else
                    {
                        $this->_sendActivationEmail($userKey);
                        
                        $Message = new HtmlMessageSuccess('Registered!', 'You have been successfully registered! To activate your account, check your e-mail for a welcome message from us that will include an activation link. Please check your spam folder if you do not receive this e-mail within 10 minutes.');
                        $this->getTemplate()->body->form = $Message->fetch();                        
                    }
                }
            }
        }
        else
        {
            $this->getTemplate()->body->form = $Form->fetch();
        }
        
    }

    protected function _sendActivationEmail($userKey)
    {
        $activationUrl = $this->getRouter()->getNewUrl(false, 'activate', array($userKey));
        
        $to      = $this->getRequest()->email;
        $subject = 'Creative Arts Guide :: User Activation';
        $message = $this->getRequest()->firstName.' '.$this->getRequest()->lastName.": \n\n".
                   'Thanks for registering for the Creative Arts Guide; we are excited to have you as a new member!'."\n\n".
                   'To activate your account, either click the below link, or copy and paste the entire link in the URL bar in your preferred web browser.'."\n\n".
                   'Activation Link: <a href="'.$activationUrl.'">'.$activationUrl.'</a>';
        $headers = 'From: accounts@creativeartsguide.com' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();

        if(!mail($to, $subject, $message, $headers))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function actionActivate()
    {
        $userKey = $this->getRouter()->getArgumentById(0);
        
        $query = 'DELETE FROM :T1
                  WHERE userKey=:A1
                  LIMIT 1';
        $DbStmt = $this->getDatabase()->prepare($query, array(DB_NAME.'.user_activate'))->execute(array($userKey));
        $affectedRows = $DbStmt->affectedRows();
        
        if($affectedRows == 1)
        {
            $Message = new HtmlMessageSuccess('Activated!', 'Your e-mail has been confirmed and your account has been successfully activated. You can now use the Logon link on the top right side of the page to log in to the user portal.');
            $this->getTemplate()->body->form = $Message->fetch();
        }
        else
        {
            $Message = new HtmlMessageError('Error!', 'Your account could not be activated at this time. Either you have followed an incorrect URL or there has been a system error. Contact an administrator via the Contact page if you require assistance.');
            $this->getTemplate()->body->form = $Message->fetch();
        }
    }

    protected function displayGeneralError()
    {
        $Message = new HtmlMessageError('Error!', 'Your information could not be registered at this time. If this error persists, please seek assistance from an administrator by using the Contact page');
        $this->getTemplate()->body->form = $Message->fetch();
    }

    protected function _buildRegistrationForm() 
    {
      
      $Form = new Form('logon', $this->getRouter(), $this->getRequest());
      $Form->attach(new FormFieldset('personalInfo'));
      $Form->personalInfo->setLegend('Personal Info');

      $FormNoteInfo = new FormNote('info', FormNote::POSITIONRIGHT);
      $FormNoteInfo->addSection('First and Last Name',
        'Enter your first and last name separately into the labeled text input boxes.');
      $FormNoteInfo->addSection('E-Mail Address',
        array('Enter a valid e-mail address into the labeled text input box; this value will also be your username to log onto this website.', 'Also note that to activate your account you will need to follow a link in an activation e-mail sent to this address. Make sure this is a valid e-mail.'));
      $FormNoteInfo->addSection('Password',
        'You must enter a strong password that is at least six characters and contains at least one letter, one number, and one symbol.');
      $Form->personalInfo->attach($FormNoteInfo);
      
      $FormNoteUsage = new FormNote('logonmessage', FormNote::POSITIONNORMAL);
      $FormNoteUsage->addSection(false,
        'Please completely fill out the below information. All fields are required.');
      $Form->personalInfo->attach($FormNoteUsage);
      
      $Form->personalInfo->attach(new FormInput('firstName', 'First Name'));
      $Form->personalInfo->firstName->restrict(new FormRestrictionNotEmpty());
      $Form->personalInfo->firstName->restrict(new FormRestrictionAlphanumeric());
      $Form->personalInfo->firstName->restrict(new FormRestrictionMaxLength(48));

      $Form->personalInfo->attach(new FormInput('lastName', 'Last Name'));
      $Form->personalInfo->lastName->restrict(new FormRestrictionNotEmpty());
      $Form->personalInfo->lastName->restrict(new FormRestrictionAlphanumeric());
      $Form->personalInfo->lastName->restrict(new FormRestrictionMaxLength(48));
      
      $Form->personalInfo->attach(new FormInput('email', 'E-Mail Address'));
      $Form->personalInfo->email->restrict(new FormRestrictionNotEmpty());
      $Form->personalInfo->email->restrict(new FormRestrictionEmail());
      $Form->personalInfo->email->restrict(new FormRestrictionMaxLength(48));
      
      $Form->personalInfo->attach(new FormInput('password', 'Password', 'password'));
      $Form->personalInfo->password->restrict(new FormRestrictionNotEmpty());
      $Form->personalInfo->password->restrict(new FormRestrictionMinLength(6));
      $Form->personalInfo->password->restrict(new FormRestrictionGoodPassword());
      
      $Form->personalInfo->attach(new FormInput('passwordc', 'Password (Confirm)', 'password'));
      $Form->personalInfo->passwordc->restrict(new FormRestrictionSameAsField($Form->personalInfo->password));
      
      $Form->personalInfo->attach(new FormInputSubmit('Register'));
      
      return $Form;
    }

}
?>
