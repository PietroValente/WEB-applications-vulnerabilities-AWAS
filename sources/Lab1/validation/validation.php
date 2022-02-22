<?php

// Registration Validation
define("EMAIL", "/\S+@\S+\.\S+/"); // Basic Email Format

define("NAME", "/^[a-z A-Z,.\-\ñ\Ñ]{3,16}$/i"); // No Special Characters. Accepts . , -Cers(Additional Regex A-Z for accepting capetilize and 3 min - 16 max for input)

define("PASSWORD", "/^(?![^a-zA-Z0-9])(?=\P{Ll}*\p{Ll})(?=\P{Lu}*\p{Lu})(?=\P{N}*\p{N})(?=[\p{L}\p{N}]*[^\p{L}\p{N}])[\s\S]{8,19}$/"); 

define("SUBJECT", "/^(?![\s])[\w,.!\-\s]{4,15}$/i");

define("BODY", "/^[\s\S\w\W]{1,280}$/");



// Validation
function isFirstNameValid($name) {
    return preg_match(NAME, $name);
}

function isLastNameValid($name) {
    return preg_match(NAME, $name);
}

function isEmailValid($email) {
    return preg_match(EMAIL, $email);
}

function isPasswordValid($password) {
    return preg_match(PASSWORD, $password);
}

function isSubjectValid($subject) {
    return preg_match(SUBJECT, $subject);
}

function isBodyValid($body) {
    return preg_match(BODY, $body);
}
function formValidate($data) {
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

function SQLvalid($mysql,$str) {
    $str = @trim($str);
    return mysqli_real_escape_string ($mysql ,$str);
}
?>