<?php
//set default values
$name = '';
$email = '';
$phone = '';
$message = 'Enter some data and click on the Submit button.';

//process
$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'process_data':
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');

        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        $phone = htmlspecialchars($phone);

        if(!empty($name)){
            if(!empty($email)){
               
                if (strpos($email, '@') !== false) {
                    if (strpos($email, '.') === false) {
                        $message = "The email address must contain a dot character.";
                        break;
                    } 
                } else {
                    $message =  "The email address must contain an @ sign";
                    break;
                }
                if(!empty($phone)){
                    if(strlen($phone)>=7){
                        $name = ucfirst($name);

                        $phone = str_replace('-','',$phone);
                        $phone = str_replace(' ','',$phone);
                        $phone = str_replace('(','',$phone);
                        $phone = str_replace(')','',$phone);
                        $phone = str_replace('@','',$phone);

                        // for($i = 0;$i< strlen($phone);$i++){
                        //     echo $phone[$i];
                        // };
                        // Tách chuỗi thành mảng các ký tự
                        $array = str_split($phone);

                        // Chèn số 5 vào vị trí thứ 2
                        array_splice($array, 3, 0, array("-"));
                        array_splice($array, 7, 0, array("-"));

                        // Ghép lại chuỗi từ mảng các ký tự
                        $phone = implode("", $array);

                        $message = 'Hello '. $name.'

                        Thank you for entering this data:
                            
                        Name: '.$name.'
                        Email: '.$email.'
                        Phone: '.$phone;
                        break;
                    }else{
                        $message = 'The phone number must contain at least seven digits.';
                        break;
                    }

                }else{
                    $message = "You must enter a number phone.";
                    break;
                }


                
            }else{
                $message = "You must enter an email address.";
                break;
            }
           
        }else{
            $message = "You must enter a name.";
            break;
        }

        

        
}
include 'string_tester.php';
?>