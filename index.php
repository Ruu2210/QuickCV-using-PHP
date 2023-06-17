<?php
require('dnlib/load.php');

$action -> helper -> route('/',function(){
 //echo "This is HomePage";
 global $action;
 $data['title']='Make & share Resume Online';

 $action->view->load('header',$data);
 $action->view->load('content');
 $action->view->load('footer');

});

$action -> helper -> route('signup',function(){
    global $action;
    $data['title']='Signup-Resume Manager';
    $action->view->load('header',$data);
}); 
