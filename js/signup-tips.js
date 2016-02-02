// JavaScript Document

var $username=$('#signup-username');
var $password=$('#signup-password');
var $confirm_pw=$('#confirm-password');

function checkUsername(){
	
}
function usernameTips(){
	
}

$username.on('focus',usernameTips());
$username.on('blur',checkUsername());