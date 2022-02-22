<?php
/**
 * This where you can set if you want to put the error in the database or show it
 */
function customError($errno, $errstr, $errfile, $errline) {
    echo "<b>Custom error:</b> [$errno] $errstr<br>";
}

class customException extends Exception {
    public function errorMessage() {
      //error message
      $errorMsg = $this->getMessage();
      return $errorMsg;
    }
    public function errorCode() {
      //error code
      $errorCode = $this->getCode();
      return $errorCode;
    }
  }
 

?>