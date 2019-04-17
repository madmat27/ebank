<?php
        // Σελίδα Bιβλιοθήκης συναρτήσεων
        session_start();
        
        /* Συνάρτηση που πιστοποιεί το χρήστη για να είναι έγκυρο το session σε κάθε σελίδα
           που πρέπει να μπορεί να την προσπελάσει μόνο ο συγκεκριμένος χρήστης, ώστε να 
           μπορεί να δει τα δεδομένα του αυστηρά και μόνο. */
        function userValidate() {
        
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
            
            /* Παίρνουμε τα πεδία customerID από τη βάση και το αναθέτουμε στο 'user_id'. Παρακάτω θα χρησιμοποιήσουμε 
               το 'user_id', για να επαληθεύσουμε τον κωδικό του χρήστη, ώστε να του επιτρέψουμε πρόσβαση στις 
               προστατευμένες σελίδες. Έτσι εφόσον ο χρήστης μας είναι πιστοποιημένος, θα μπορεί να προσπελάσει μόνο τις 
               σελίδες του, οι οποίες χρειάζονται πρόσβαση, αποκλείοντας έτσι μη πιστοποιημένη πρόσβαση ή πρόσβαση στις 
               σελίδες άλλων χρηστών. */

            $query  = "SELECT customerID, email, password  FROM `Customers` WHERE customerID = '".$_SESSION['user_id']."'";
            $result = mysqli_query($con,$query);
            
            if (mysqli_num_rows($result) > 0) {
                
                // Αν βρεθεί πελάτης με αυτό το customerID, τότε ελέγχουμε τον κωδικό του με το hash που έχουμε αποθηκευμένο.
                // Εφόσον είναι εντάξει, του επιτρέπουμε πρόσβαση στην σελίδα ebanking που είναι οι λογαριασμοί του.
                $row = mysqli_fetch_array($result);
                $password_hash = $row['password'];
              
                if ($_SESSION['password'] == $password_hash) {
                    

                } else {
                    
                    /* Αν ο χρήστης δεν είναι authenticated, τότε τον κατευθύνουμε στην αρχική σελίδα, για να κάνει login
                       και για επιπρόσθετη ασφάλεια, κλείνουμε & καταστρέφουμε, όποιο session μπορεί να είναι ανοιχτό ή 
                       να τοποθετήθηκε κακόβουλα: */
                    header("Location: ./index.php");
                    session_unset();
                    session_destroy();
                }
            } else {
            
                /* Αν δε βρεθεί πελάτης με αυτό το customerID, σημαίνει ότι  δεν είναι authenticated, τότε τον κατευθύνουμε 
                   στην αρχική σελίδα, για να κάνει login και για επιπρόσθετη ασφάλεια, κλείνουμε & καταστρέφουμε, όποιο 
                   session μπορεί να είναι ανοιχτό ή να τοποθετήθηκε κακόβουλα: */
                header("Location: ./index.php");
                session_unset();
                session_destroy(); 
            }
        
            mysqli_close($con); // Κλείνουμε τη σύνδεση με τη βάση
            
        }
        
        function customerName() {
            
            global $con;
            /* Εύρεση στοιχείων πελάτη */
            $query  = "SELECT *  FROM `Customers` WHERE customerID = '".$_SESSION['user_id']."'";
            $result = mysqli_query($con,$query);
            
            if (mysqli_num_rows($result) > 0) {
            
                // Αν βρεθεί πελάτης με αυτό το email, τότε ελέγχουμε τον κωδικό του με το hash που έχουμε αποθηκευμένο.
                // Εφόσον είναι εντάξει, τον κατευθύνουμε στην σελίδα ebanking που είναι οι λογαριασμοί του.
                $row = mysqli_fetch_array($result);
                $name = $row['name'];
                
                return $name; // Επιστρέφει το όνομα του πελάτη με το συγκεκριμένο $_SESSION['user_id']
                
            }
            
        }

        function customerLNAME() {
            
            global $con;
            /* Εύρεση στοιχείων πελάτη */
            $query  = "SELECT *  FROM `Customers` WHERE customerID = '".$_SESSION['user_id']."'";
            $result = mysqli_query($con,$query);
            
            if (mysqli_num_rows($result) > 0) {
            
                // Αν βρεθεί πελάτης με αυτό το email, τότε ελέγχουμε τον κωδικό του με το hash που έχουμε αποθηκευμένο.
                // Εφόσον είναι εντάξει, τον κατευθύνουμε στην σελίδα ebanking που είναι οι λογαριασμοί του.
                $row = mysqli_fetch_array($result);
                $name = $row['name'];
                $lastname = $row['lastname'];
                $email = $row['email'];
                
                return $lastname;
                
            }
            
        }
        
        function customerEmail() {
            
            global $con;
            /* Εύρεση στοιχείων πελάτη */
            $query  = "SELECT *  FROM `Customers` WHERE customerID = '".$_SESSION['user_id']."'";
            $result = mysqli_query($con,$query);
            
            if (mysqli_num_rows($result) > 0) {
            
                // Αν βρεθεί πελάτης με αυτό το email, τότε ελέγχουμε τον κωδικό του με το hash που έχουμε αποθηκευμένο.
                // Εφόσον είναι εντάξει, τον κατευθύνουμε στην σελίδα ebanking που είναι οι λογαριασμοί του.
                $row = mysqli_fetch_array($result);
                $name = $row['name'];
                $lastname = $row['lastname'];
                $email = $row['email'];
                
                return $email;
                
            }
            
        }

?>