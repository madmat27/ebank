<?php
        /* Ελέγχουμε αν ο χρήστης είναι πιστοποιημένος προτού του επιτρέψουμε πρόσβαση στη σελίδα.
           Επιπρόσθετα, θα έχουμε τη δυνατότητα να φέρνουμε εξατομικευμένα στοιχεία που αφορούν τον κάθε χρήστη,
           χωρίς να επιτρέπεται ο ένας χρήστης να έχει πρόσβαση στα στοιχεία του άλλου. */
        // Έναρξη session που επιτρέπει στον χρήστη να πλοηγείται στις προσωπικές του σελίδες, που απαιτούν πρόσβαση.
        session_start();
        
        // Τρέχουμε ερώτημα στη ΒΔ για να εμφανίσουμε τα στοιχεία του χρήστη στη σελίδα:
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

        /* Διαγράφουμε τα στοιχεία του πελάτη από τη βάση. Μαζί διαγράφονται και οι λογαριασμοί, όπως έχουμε ενημερώσει τον 
           πελάτη, καθώς στη βάση έχουμε επιλέξει την παράμετρο "ON DELETE CASCADE". */
        $query  = "DELETE FROM `Customers` WHERE customerID = '".$_SESSION['user_id']."'";
        $result = mysqli_query($con,$query);
        echo "<script type='text/javascript'>alert('Ο λογαριασμός του χρήστη διαγράφηκε.');window.location.href = \"../index.php\";</script>";
        mysqli_close($con);

?>