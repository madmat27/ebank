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
        
        /* Αν έχει πατηθεί το submit με το id change, ξεκινάμε τη διαδικασία ανανέωσης των εγγραφών στη βάση */
        if (isset($_POST['change'])) {
            
            /* Εξετάζουμε αν το email του πελάτη είναι διαφορετικό από αυτό που έχουμε αποθηκευμένο. 
               Αν ναι, ανανεώνουμε την εγγραφή στη βάση. */
            $email = mysqli_real_escape_string($con,$_POST['email']);
            
            $query  = "SELECT *  FROM `Customers` WHERE customerID = '".$_SESSION['user_id']."'";
            $result = mysqli_query($con,$query);
            
                if (mysqli_num_rows($result) > 0) {
                
                    $row = mysqli_fetch_array($result);
                    $emailDB = $row['email'];

                    if ($email != $emailDB) {
                        
                        $query = "UPDATE `Customers` SET email = '".$email."' WHERE customerID = '".$_SESSION['user_id']."'";
                        $result = mysqli_query($con,$query);
                        echo "<script type='text/javascript'>alert('Τα στοιχεία άλλαξαν');window.location.href = \"../user.php\";</script>";
                    }
                    
                } else {
                    
                    header('Location: ../index.php');
                    
                }
            
            /* Εξετάζουμε αν το password του πελάτη είναι διαφορετικό από αυτό που έχουμε αποθηκευμένο. Εδώ λειτουργούμε ως εξής: αν το πεδίο
               του παλαιού κωδικού είναι άδειο, σημαίνει ότι ο πελάτης δεν θέλει να αλλάξει τον κωδικό του. Αν ,όμως, το πεδίο έχει τιμή, τότε 
               προχωράμε στηγ αλλαγή του κωδικού. Για να πραγματοποιηθεί η αλλαγή, ο χρήστης επιβάλλεται να βάλει τον παλιό κωδικό, ώστε να γίνει 
               η πιστοποίηση ότι αυτός που ζητάει την αλλαγή είναι πράγματι ο νόμιμος ιδιοκτήτης κι όχι κάποιος που απέκτησε πρόσβαση κακόβουλα στο 
               λογαριασμό. Υπό αυτές τις συνθήκες, ανανεώνουμε την εγγραφή στη βάση. */
               if ($_POST['oldPassword'] != "") {
                    
                    $oldPassword = mysqli_real_escape_string($con,$_POST['oldPassword']);
                    $newPassword = password_hash(mysqli_real_escape_string($con,$_POST['newPassword']),PASSWORD_BCRYPT);
                   
                    $query  = "SELECT *  FROM `Customers` WHERE customerID = '".$_SESSION['user_id']."'";
                    $result = mysqli_query($con,$query);
            
                    if (mysqli_num_rows($result) > 0) {
                
                        $row = mysqli_fetch_array($result);
                        $passwordDB = $row['password'];
                        
                        if (password_verify($oldPassword,$passwordDB)) {
                            
                            $query = "UPDATE `Customers` SET password = '".$newPassword."' WHERE customerID = '".$_SESSION['user_id']."'";
                            $result = mysqli_query($con,$query);
                            echo "<script type='text/javascript'>alert('Τα στοιχεία άλλαξαν');window.location.href = \"../user.php\";</script>";
                        }
                    
                    } else {
                    
                        header('Location: ../index.php');
                    
                    }
               }
            
            /* Εξετάζουμε αν το φύλο του πελάτη είναι διαφορετικό από αυτό που έχουμε αποθηκευμένο. 
               Αν ναι, ανανεώνουμε την εγγραφή στη βάση. */
               switch ($_POST['sex']) {
                case "male":
                    $sex = "M";
                    echo $sex;
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

                $query  = "SELECT *  FROM `Customers` WHERE customerID = '".$_SESSION['user_id']."'";
                $result = mysqli_query($con,$query);
            
                if (mysqli_num_rows($result) > 0) {
                
                    $row = mysqli_fetch_array($result);
                    $sexDB = $row['sex'];
                    
                    if ($sex != $sexDB) {
                        
                        $query = "UPDATE `Customers` SET sex = '".$sex."' WHERE customerID = '".$_SESSION['user_id']."'";
                        $result = mysqli_query($con,$query);
                        echo "<script type='text/javascript'>alert('Τα στοιχεία άλλαξαν');window.location.href = \"../user.php\";</script>";
                    }
                    
                } else {
                    
                    header('Location: ../index.php');
                    
                }
                
                /*  Εξετάζουμε αν η ημερομηνία γέννησης του πελάτη είναι διαφορετική από αυτή που έχουμε αποθηκευμένη. 
                    Αν ναι, ανανεώνουμε την εγγραφή στη βάση. */
                    $dob = $_POST['dob'];
            
                    $query  = "SELECT *  FROM `Customers` WHERE customerID = '".$_SESSION['user_id']."'";
                    $result = mysqli_query($con,$query);
            
                    if (mysqli_num_rows($result) > 0) {
                
                        $row = mysqli_fetch_array($result);
                        $dobDB = $row['dob'];
                    
                        if ($dob != $dobDB) {
                        
                            $query = "UPDATE `Customers` SET dob = '".$dob."' WHERE customerID = '".$_SESSION['user_id']."'";
                            $result = mysqli_query($con,$query);
                            echo "<script type='text/javascript'>alert('Τα στοιχεία άλλαξαν');window.location.href = \"../user.php\";</script>";
                        }
                    
                    } else {
                    
                        header('Location: ../index.php');
                    
                    }
                    
                mysqli_close($con);
                
                } 
            

?>