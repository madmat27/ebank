<?php
        /* Ελέγχουμε αν ο χρήστης είναι πιστοποιημένος προτού του επιτρέψουμε πρόσβαση στη σελίδα.
           Επιπρόσθετα, θα έχουμε τη δυνατότητα να φέρνουμε εξατομικευμένα στοιχεία που αφορούν τον κάθε χρήστη,
           χωρίς να επιτρέπεται ο ένας χρήστης να έχει πρόσβαση στα στοιχεία του άλλου. */
        // Έναρξη session που επιτρέπει στον χρήστη να πλοηγείται στις προσωπικές του σελίδες, που απαιτούν πρόσβαση.
        session_start();
        
        $_SESSION['user_id'] = 2;
        $_SESSION['email'] = 'sdfgdfgsdfgd'; 
        $_SESSION['password'] = 'adfasdfasdfafad';
        
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
        
        if ( isset($_SESSION['user_id']) && isset($_SESSION['email']) && isset($_SESSION['password'])) {
            // Παίρνουμε το customerID από τη βάση και το αναθέτουμε στο 'user_id'.
            // Έτσι ξέρουμε ότι ο χρήστης μας είναι πιστοποιημένος και μπορεί να προσπελάσει μόνο τις σελίδες του,
            // οι οποίες χρειάζονται πρόσβαση. 
            
            $query  = "SELECT customerID, email, password  FROM `Customers` WHERE customerID = '".$_SESSION['user_id']."'";
            $result = mysqli_query($con,$query);
            
            if (mysqli_num_rows($result) > 0) {
                
                // Αν βρεθεί πελάτης με αυτό το email, τότε ελέγχουμε τον κωδικό του με το hash που έχουμε αποθηκευμένο.
                // Εφόσον είναι εντάξει, τον κατευθύνουμε στην σελίδα ebanking που είναι οι λογαριασμοί του.
                $row = mysqli_fetch_array($result);
                $password_hash = $row['password'];
                if (password_verify($_SESSION['password'],$password_hash)) {

                    header('Location: ./ebanking.php');

                } else {
                    // Αν ο χρήστης δεν είναι authenticated, τότε τον κατευθύνουμε στην αρχική σελίδα, για να κάνει login:
                    header("Location: ./index.php");
                }
            }
        } else {
            
            header("Location: ./index.php");
            
        }
        
        mysqli_close($con);
        //session_destroy();

?>