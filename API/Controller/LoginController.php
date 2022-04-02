<?php

use API\Model\Entity\Users;

if(isset($_POST['email'], $_POST['password'])){
    $user = new Users;
    $user->setEmail($_POST['email']);    
    $find_user = $user->GetUserByEmail();

    if($find_user === false){
        http_response_code(403);
        echo json_encode('Unknown user or password');
    }
    else{
        $verify = password_verify($_POST['password'], $find_user->password);
        if($verify === false){
            http_response_code(403);
            echo json_encode('Unknown user or password');            
        }
        else{
            http_response_code(200);
            $_SESSION['firstname'] = htmlspecialchars($find_user->firstname);
            $_SESSION['lastname'] = htmlspecialchars($find_user->lastname);
            $_SESSION['email'] = htmlspecialchars($find_user->email);
            $_SESSION['role'] = htmlspecialchars($find_user->role);
            
            $information = [
                'firstname' => htmlspecialchars($find_user->firstname),
                'lastname' => htmlspecialchars($find_user->lastname),
                'email' => htmlspecialchars($find_user->email),
                'role' => htmlspecialchars($find_user->role)
            ];
            echo json_encode($information);
        }
    }
}
 else{
     echo 'You can\'t do that thing LoginController';
 }
