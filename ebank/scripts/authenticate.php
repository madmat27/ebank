<?php

    // Έναρξη session που επιτρέπει στον χρήστη να πλοηγείται στις προσωπικές του σελίδες, που απαιτούν πρόσβαση.
    session_start();
    
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
    
    /* Αν έχει πατηθεί το submit, ξεκινάμε τη διαδικασία αναζήτησης του χρήστη στη βάση */
    if (isset($_POST['submit'])) {
        
            
            /* Εκχώρηση στοιχείων φόρμας login σε μεταβλητές */
            $email = mysqli_real_escape_string($con,$_POST['username']);
            $password = mysqli_real_escape_string($con,$_POST['password']);
            

            /* Έλεγχος αν ο πελάτης είναι ήδη εγγεγραμμένος */
            $query  = "SELECT customerID, email, password  FROM `Customers` WHERE email = '".$email."'";
            $result = mysqli_query($con,$query);
            
            if (mysqli_num_rows($result) > 0) {
                
                /* Αν βρεθεί πελάτης με αυτό το email, τότε ελέγχουμε τον κωδικό του με το hash που έχουμε αποθηκευμένο.
                   Εφόσον είναι εντάξει, τον κατευθύνουμε στην σελίδα ebanking που είναι οι λογαριασμοί του. */
                $row = mysqli_fetch_array($result);
                $password_hash = $row['password'];
                if (password_verify($password,$password_hash)) {
                    
                    /* Αποθήκευουμε στις μεταβλητές $_SESSION, τα στοιχεία πιστοποίησης, για να τα χρησιμοποιούμε 
                       στον έλεγχο του session σε κάθε προστατευμένη σελίδα. */
                    $_SESSION['user_id'] = $row['customerID'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['password'] = $row['password'];

                    header('Location: ../ebanking.php');

                } else {
                    
                    /* Αλλιώς, πρώτα κλείνουμε τη σύνδεση με τη βάση, αφού πλέον δεν την χρειαζόμαστε κι ενημερώνουμε τον 
                       χρήστη ότι έχει βάλει εσφαλμένο κωδικό, ενώ τον κατευθύνουμε πάλι στην αρχική σελίδα, για να κάνει login. */
                    mysqli_close($con);

                    echo "<script type='text/javascript'>alert('Εσφαλμένος κωδικός.');window.location.href = \"../index.php\";</script>";
                }

            } else {
                
                /* Αν στο πρώτο if που ελέγχει αν υπάρχει πελάτης με αυτό το email, δε βρούμε εγγραφές, σημαίνει ότι πελάτης με 
                   αυτό το email δεν υπάρχει. Πάλι τον κατευθύνουμε πάλι στην αρχική σελίδα, για να κάνει login. */
                echo "<script type='text/javascript'>alert('Εσφαλμένο όνομα χρήστη.');window.location.href = \"../index.php\";</script>";

            }
        
    }

?>