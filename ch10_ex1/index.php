<?php


//set default value
$message = '';

//get value from POST array
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action =  'start_app';
}

//process
switch ($action) {
    case 'start_app':

        // set default invoice date 1 month prior to current date
        $interval = new DateInterval('P1M');
        $default_date = new DateTime();
        $default_date->sub($interval);
        $invoice_date_s = $default_date->format('n/j/Y');

        // set default due date 2 months after current date
        $interval = new DateInterval('P2M');
        $default_date = new DateTime();
        $default_date->add($interval);
        $due_date_s = $default_date->format('n/j/Y');

        $message = 'Enter two dates and click on the Submit button.';
        break;
    case 'process_data':

        $invoice_date_s = filter_input(INPUT_POST, 'invoice_date');
        $due_date_s = filter_input(INPUT_POST, 'due_date');


        if (!empty($invoice_date_s) && !empty($due_date_s)) {

            try {
                $date_invoice = new DateTime($invoice_date_s);
                $date_due = new DateTime($due_date_s);
            } catch (\Throwable $th) {
                $message = 'Both dates must be in a valid format. Please check both dates and try again.';
                break;
            }
            if($date_invoice>$date_due){
                $message = 'The due date must come after the invoice date. Please try again.';
                break;
            }
        } else {
            $message = 'You must enter both dates. Please try again.';
            break;
        }

        $invoice_date_f = $date_invoice->format('F j, Y');
        $due_date_f = $date_due->format('F j, Y');

        // get the current date and time and format it
       
        
        $current_date_f_b = new DateTime();
        $current_date_f = $current_date_f_b->format('F j, Y');
        
     
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $current_time_f = date("H:i:s");


        $due_date_message = $date_due->diff($date_invoice);
        $due_date_message = "This invoice is due in ".$due_date_message->y." years, ".$due_date_message->m." months, and ". $due_date_message->d." days.";
        break;
}
include 'date_tester.php';
