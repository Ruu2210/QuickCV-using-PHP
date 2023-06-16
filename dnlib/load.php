<?php
session_start();

require('config.php');
require('class/database.class.php');
require('class/custom.class.php');
require('class/helper.class.php');
require('class/session.class.php');
require('class/view.class.php');
require('class/action.class.php');

$action = new Action;
//$action->db->insert("demo","name,age",['Amey',21]);
//print_r($action->db->read("demo","name,age,email"));
//$action->db->update("demo","email",['AMU@GMAIL.COM'],"id=5");
//$action->db->update("demo","email",['rutu@GMAIL.COM'],"id=4");
//print_r($action->db->delete("demo","id=4"));
