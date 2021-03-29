
<?php 



// define variables and set to empty values
// $name = $email = $phone = "";

// $allowSend = true;

// $errors = [];
// $resp = [];

// function test_input($data) {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
//   }

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
//     if ( empty($_POST["email"]) ) {
//         $errors['error']['email'] = 'שדה  ריק'; 
//         $allowSend = false;
//     } 
//     else if (filter_var($email, FILTER_VALIDATE_EMAIL) ) {
//         $errors['error']['email'] = 'אימייל לא תקין'; 
//         $allowSend = false;
//     } 
//     else {
//         $email = test_input($_POST["email"]);
//         $allowSend = true;
//     }

//     if ( empty($_POST["name"]) ) {
//         $errors['error']['name'] = 'שדה ריק'; 
//         $allowSend = false;
//     }
//     else {
//         $name = test_input($_POST["name"]);
//         $allowSend = true;
//     }

//     if ( !is_numeric($phone) ) {
//         $errors['error']['phone'] = 'מספר טלפון ריק'; 
//         $allowSend = false;
//     }
//     else if( strlen($phone) > 10 ) {
//         $errors['error']['phone'] = 'מספר ארוך מדי'; 
//         $allowSend = false;
//     } 
//     else {
//         $phone = test_input($_POST["phone"]);
//         $allowSend = true;
//     }


//     if ($allowSend) {
//         $to = "pavel@interjet.co.il";
//         $subject = "Purezone new message";
//         $message .= "<h1> PUREZONE.</h1>";
//         $message .= "<span> שם: </span>" . $name . '<br/>';
//         $message .= "<span> מייל: </span>" . $email . '<br/>';
//         $message .= "<span> טלפון: </span>" . $phone . '<br/>';
//         $header = "From:serv@interjet.co.il \r\n";
//         $header .= "MIME-Version: 1.0\r\n";
//         $header .= "Content-type: text/html\r\n";
        
//         $retval = mail ($to,$subject,$message,$header);
        
//         if( $retval == true ) {
//            $resp['success'] = "הודעה נשלחה בהצלחה!" . ' <br/> ניצור קשר בהקדם!';
//         }else {
//            $resp['fail'] = "Message could not be sent..." ;
//         }

//     } else {
//         // echo 'dissallow send';
//     }

//     if( !empty($errors) ) {
//         echo json_encode($errors);
//     }

//     if( !empty($resp) ) {
//         echo json_encode($resp);
//     }

// die;
// }
?>


<?php $templ_path = get_stylesheet_directory_uri(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php wp_title(); ?> </title>


    <!-- <link rel="icon" type="image/png"  href="fav.png"> -->


    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo $templ_path;?>/style.css">
    <link rel="stylesheet" href="<?php echo $templ_path;?>/mobile.css">
    <link rel="stylesheet" href="<?php echo $templ_path;?>/assets/slick-1.8.1/slick/slick.css">
    
    <?php wp_head(); ?>
</head>
<body>




<header>
    <div class="container flex_container flex__just_left flex__align_center">


        <div class="logo">
            <img src="<?php echo $templ_path; ?>/assets/img/FIAT-LOGO.svg" alt="">
        </div>

        <div class="head-logo is_mobile">
            <img src="<?php echo $templ_path; ?>/assets/img/Image7.png" alt="">
        </div>
    </div>
</header>
