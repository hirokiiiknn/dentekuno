<?php
class SettingsFormProvider {

    public function createUserDetailsForm($firstName , $lastName, $email) {
        $firstNameInput = $this->createFirstNameInput($firstName);
        $lastNameInput = $this->createLastNameInput($lastName);
        $emailInput = $this->createEmailInput($email);
        $saveButton = $this->createSaveUserDetailsButton();


        return "<form action='processing.php' method='POST' enctype='multipart/form-data'>
                  <span class='title'>User Details</span>
                    $firstNameInput
                    $lastNameInput
                    $emailInput
                    $saveButton
                </form>";
    }

    public function createPasswordForm() {
      $oldPasswordInput = $this->createPasswordInput("oldPassword", "Old pasword");
      $newPasswordInput = $this->createPasswordInput("newPassword", "New pasword");
      $newPasswordInput2 = $this->createPasswordInput("newPassword2", "Comfirm new pasword");

      $saveButton = $this->createSavePasswordButton();


      return "<form action='processing.php' method='POST' enctype='multipart/form-data'>
                <span class='title'>Update Password</span>
                  $oldPasswordInput
                  $newPasswordInput
                  $newPasswordInput2
                  $saveButton
              </form>";
  }

    private function createFirstNameInput($value) {
        if($value == null) $value = "";
        return "<div class='form-group'>
                    <input class='form-control' type='text' placeholder='Last name' name='lastName' value='$value' require>
                </div>";
    }
    
    private function createLastNameInput($value) {
      if($value == null) $value = "";
      return "<div class='form-group'>
                  <input class='form-control' type='text' placeholder='First name' name='firstName' value='$value' require>
              </div>";
  }

    private function createEmailInput($value) {
      if($value == null) $value = "";
      return "<div class='form-group'>
                  <input class='form-control' type='email' placeholder='Email' name='email' value='$value' require>
              </div>";
  }

    private function createSaveUserDetailsButton() {
        return "<button type='submit' class='btn btn-primary' name='saveDetailsButton'>SAVE</button>";
    }

    private function createSavePasswordButton() {
      return "<button type='submit' class='btn btn-primary' name='savePasswordButton'>SAVE</button>";
  }

    private function createPasswordInput($name, $placeholder) {
      return "<div class='form-group'>
                  <input class='form-control' type='password' placeholder='$placeholder' name='$name' require>
              </div>";
  }
}
?>