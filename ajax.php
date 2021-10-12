<?php
$action = $_REQUEST['action'];

if(!empty($action)){
    require_once 'incluides/Player.php';
    $obj = new Player();
}
if($action =='adduser' && !empty($_POST)){
    $pname = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $photo = $_FILES['photo'];
    $pId = (!empty($_POST['userid'])) ? $_POST['userid'] : '';

    //validations
    //file (photo) upload

    $imagename = '';
    if(!empty($photo['name'])){
        $imagename = $obj->uploadPhoto($photo);
        $playerDat = [
          'pname' => $pname,
          'email' => $email,
          'phone' => $phone,
          'photo' => $imagename,
        ];
    }

}
