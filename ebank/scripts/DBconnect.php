<?php

        /* Τρέχουμε ερώτημα στη ΒΔ για να τραβήξουμε:
           a. τα στοιχεία του χρήστη από τη βάση
           β. τα στοιχεία του λογαριασμού του χρήστη 
           ώστε να μπορούμε να τα απεικονίσουμε δυναμικά στη σελίδα: */
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
            
?>
