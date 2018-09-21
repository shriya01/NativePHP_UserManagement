<?php session_start(); include('CoreModel.php'); ?>
<?php 
if (isset($_SESSION['email'])) {
    if (isset($_POST['btnChangePwd']) && $_POST['btnChangePwd']=='changepassword' && isset($_POST['oldpwd']) && isset($_POST['newpwd']) && strlen($_POST['newpwd']) >=8 && strlen($_POST['newpwd']) < 15 && isset($_POST['newpwd2']) && strlen($_POST['newpwd2']) >=8 && strlen($_POST['newpwd2']) < 15 && strcmp($_POST['newpwd'], $_POST['newpwd2'])==0) {
        $obj1 = new CoreModel;
        $result =  $obj1->select('users', 'password', ['email'=>$_SESSION['email'],'password'=>sha1($_POST['oldpwd']),'is_deleted'=>1]);
        if ($result) {
            $result1 = $obj1->update('users', ['password'=>sha1($_POST['newpwd'])], ['email'=>$_SESSION['email'],'password'=>sha1($_POST['oldpwd'])]);
            if ($result1) {
                echo json_encode("password-changed");
            }
        } else {
            echo json_encode('3');
        }
    }

    if (isset($_POST['btnUpdate']) && $_POST['btnUpdate']=='Update' && isset($_POST['fname']) && $_POST['fname']!='' && isset($_POST['lname']) && $_POST['lname']!='') {
        $obj1 = new CoreModel;
        $result =  $obj1->select('users', 'firstname', ['email'=>$_SESSION['email'],'is_deleted'=>1]);
        if ($result) {
            $result1 = $obj1->update('users', ['firstname'=>$_POST['fname'], 'lastname'=>$_POST['lname'] ], ['email'=>$_SESSION['email']]);
            if ($result1) {
                echo json_encode("profile-updated");
            } else {
                echo json_encode('4');
            }
        }
    }
} else {
    if (isset($_POST['btnSubmit']) && $_POST['btnSubmit']=='REGISTER' && isset($_POST['fname']) && $_POST['fname']!='' && isset($_POST['lname']) && $_POST['lname']!='' && isset($_POST['email']) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) !== false) && isset($_POST['pwd']) && strlen($_POST['pwd']) >=8 && strlen($_POST['pwd']) < 15 && isset($_POST['pwd2']) && strlen($_POST['pwd2']) >=8 && strlen($_POST['pwd2']) < 15 && strcmp($_POST['pwd'], $_POST['pwd2'])==0) {
        $insert_array = array('firstname'=>$_POST['fname'],'lastname'=>$_POST['lname'],'email'=>$_POST['email'],'password'=>sha1($_POST['pwd']));
        $table_name = 'users';
        $obj1 = new CoreModel;
        if ($obj1->insert($table_name, $insert_array)) {
            $_SESSION['email'] = $_POST['email'];
            echo json_encode("registered");
        } else {
            echo json_encode('1');
        }
    }

    if (isset($_POST['btnLogin']) && $_POST['btnLogin']=='LOGIN' && isset($_POST['email']) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) !== false) && $_POST['pwd'] != '') {
        $obj1 = new CoreModel;
        $table_name = 'users';
        $select_data = 'firstname,lastname,email';
        $where_array = array('email'=>$_POST['email'],'password'=>sha1($_POST['pwd']),'is_deleted'=>1);
        if ($obj1->select($table_name, $select_data, $where_array)) {
            $_SESSION['email'] = $_POST['email'];
            echo json_encode("logged-in");
        } else {
            echo json_encode('2');
        }
    }
}
?>