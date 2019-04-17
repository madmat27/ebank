<?php

    header('Content-Type: text/html; charset=utf-8');
    $dbhost = "127.0.0.1";
    $dbuser = "mscmazi";
    $dbpass = "";
    $dbname = "mazi";
    
    /* Έναρξη σύνδεσης */
    $con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    
    /* Έλεγχος Σύνδεσης */
    if (mysqli_connect_error()) {
        
        die ("There was an error connecting to the database<br>");
        
    } else {
        
        mysqli_set_charset($con,"utf8"); //Βάλε το Charset σε utf8, για να γράφει σωστά τους ελληνικούς χαρακτήρες στη ΒΔ
        
    }
    
    /* Αν έχει πατηθεί το submit, ξεκινάμε τη διαδικασία καταχώρησης των εγγραφών στη βάση */
    if (isset($_POST['submit'])) {
        
            
            /* Εκχώρηση στοιχείων φόρμας html σε μεταβλητές */
            $name = mysqli_real_escape_string($con,$_POST['name']);
            $lastname = mysqli_real_escape_string($con,$_POST['lastname']);
            $email = mysqli_real_escape_string($con,$_POST['email']);
            $password = password_hash(mysqli_real_escape_string($con,$_POST['password']),PASSWORD_BCRYPT);
            
            switch ($_POST['sex']) {
                case "male":
                    $sex = "M";
                    break;
                case "female":
                    $sex = "F";
                    break;
                case "other":
                    $sex = "O";
                    break;
                default:
                    $sex = "";
            } 
            
            $dob = $_POST['dob'];

            /* Έλεγχος αν ο πελάτης είναι ήδη εγγεγραμμένος */
            $query  = "SELECT email  FROM `Customers` WHERE email = '".$email."'";
            $result = mysqli_query($con,$query);
            
            if (mysqli_num_rows($result) > 0) {

                // Σε περίπτωση που βρεθούν παραπάνω από 0 εγγραφές στον πίνακα των πελατών με αυτό το email, 
                // δείξε το παρακάτω μήνυμα και στείλε τον χρήστη στην αρχική σελίδα:
                echo "<script type='text/javascript'>alert('Υπάρχει ήδη εγγεγραμμένος χρήστης με αυτό το email. Παρακαλώ δοκιμάστε να συνδεθείτε από την αρχική οθόνη.');window.location.href = \"../index.php\";</script>";

            }  else {
            
                // Ειδάλλως, τρέξε το παρακάτω insert query και εισήγαγε το νέο χρήστη στη βάση, βάζοντας τα στοιχεία που μας έδωσε στη φόρμα.
                // Μόλις γίνει η εισαγωγή κι εκτελεστεί το query, κλείσε το connection με τη βάση.
                /* Εκτέλεση query εισαγωγής χρήστη στη βάση*/
                $query = "INSERT INTO `Customers`(`name`, `lastname`, `email`, `password`, `dob`, `sex`) VALUES ('$name','$lastname','$email','$password','$dob','$sex')";
                
                mysqli_query($con,$query);
                
                mysqli_close($con);
                // Εφόσον η εισαγωγή είναι επιτυχημένη, δείξε το παρακάτω μήνυμα και στείλε τον χρήστη στην αρχική σελίδα:
                echo "<script type='text/javascript'>alert('Η εγγραφή σας ολοκληρώθηκε με επιτυχία! Παρακαλούμε συνδεθείτε από την αρχική οθόνη.');window.location.href = \"../index.php\";</script>";
                
            }
            
    }

?>