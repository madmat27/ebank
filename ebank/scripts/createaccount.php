<?php

    /* Ελέγχουμε αν ο χρήστης είναι πιστοποιημένος προτού του επιτρέψουμε πρόσβαση στη σελίδα.
       Επιπρόσθετα, θα έχουμε τη δυνατότητα να φέρνουμε εξατομικευμένα στοιχεία που αφορούν τον κάθε χρήστη,
       χωρίς να επιτρέπεται ο ένας χρήστης να έχει πρόσβαση στα στοιχεία του άλλου. */
    // Έναρξη session που επιτρέπει στον χρήστη να πλοηγείται στις προσωπικές του σελίδες, που απαιτούν πρόσβαση.
    session_start();
    
    // Ξεκινάμε διαδισκασία σύνδεσης με τη ΒΔ:
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
    
    //print_r($_POST);
    
    /* Αν έχει πατηθεί το submit (εδώ 'addaccount', ξεκινάμε τη διαδικασία καταχώρησης των εγγραφών στη βάση */
    if (isset($_POST['addaccount'])) {
        
            
            /* Εκχώρηση στοιχείων φόρμας html σε μεταβλητές */
            $iban = mysqli_real_escape_string($con,strtoupper($_POST['iban']));
            $amount = mysqli_real_escape_string($con,$_POST['amount']);
            $friendlyName = mysqli_real_escape_string($con,$_POST['friendly-name']);
            $doc = date("Y-m-d");
            
            /* Βρίσκουμε το user_id, για να το χρησιμοποιήσουμε στο πεδίο cusID κατά την εισαγωγή
               του λογαριασμού στον πίνακα 'Accounts' */
            $query  = "SELECT *  FROM `Customers` WHERE customerID = '".$_SESSION['user_id']."'";
            $result = mysqli_query($con,$query);
            
            if (mysqli_num_rows($result) > 0) {
                
                $row = mysqli_fetch_array($result);
                $cusID = $row['customerID'];
                
            } else {
                    
                header('Location: ../index.php');
                    
            }

            /* Έλεγχος αν ο λογαριασμός είναι ήδη καταχωρημένος */
            $query  = "SELECT *  FROM `Accounts` WHERE IBAN = '".$iban."'";
            $result = mysqli_query($con,$query);
            
            if (mysqli_num_rows($result) > 0) {

                // Σε περίπτωση που βρεθούν παραπάνω από 0 εγγραφές στον πίνακα των λογαριασμών με αυτό το ΙΒΑΝ, 
                // δείξε το παρακάτω μήνυμα και στείλε τον χρήστη στην σελίδα προσθήκης λογαριασμού:
                echo "<script type='text/javascript'>alert('Υπάρχει ήδη λογαριασμός με αυτό το IBAN. Παρακαλώ ελέγξτε το IBAN που καταχωρείτε.');window.location.href = \"../addaccount.php\";</script>";

            }  else {
            
                /* Ειδάλλως, τρέξε τα παρακάτω insert queries: a) εισήγαγε το νέο λογαριασμό στη βάση, στον πίνακα 'Accounts', βάζοντας τα 
                   στοιχεία που μας έδωσε στη φόρμα και β) εισήγαγε στον πίνακα 'Money Transfer' μια εγγραφή, όπου ο λογαριασμός χρέωσης θα 
                   είναι ο λογαριασμός της τράπεζας που έχουμε δημιουργήσει και ο λογαριασμός πίστωσης, ο καινούριος λογαριασμός που μόλις 
                   εισάγαμε με ποσό το αρχικό κεφάλαιο που δηλώθηκε στη φόρμα (ρητή απαίτηση ερώτησης 3). Μόλις γίνει η εισαγωγή κι εκτελεστούν 
                   τα queries, κλείσε το connection με τη βάση. */
                
                // Εκτέλεση query εισαγωγής λογαριασμού στη βάση, στον πίνακα 'Accounts' 
                $query = "INSERT INTO `Accounts`(`cusID`, `friendlyName`, `IBAN`, `doc`, `balance`) VALUES ('$cusID','$friendlyName','$iban','$doc','$amount')";
                mysqli_query($con,$query);

                /* Για να εκτελέσουμε το (β) ερώτημα, χρειαζόμαστε πληροφορίες που θα τις χρησιμοποιήσουμε στο επόμενο insert, 
                   όπως το id του λογαριασμού που δημιουργήσαμε παραπάνω (-> creditAccountID), το ποσό (που μπορούμε να το πάρουμε 
                   από τη μεταβλητή $amount, την τρέχουσα ημερομηνία και ώρα συναλλαγής (για το πεδίο 'dot' του πίνακα) και προαιρετικά
                   μια standard πληροφορία που θα μας ενημερώνει τι είναι αυτή η συναλλαγή. */
                   
                $query  = "SELECT *  FROM `Accounts` WHERE IBAN = '".$iban."'";
                $result = mysqli_query($con,$query);
            
                if (mysqli_num_rows($result) > 0) {
                    
                    $row = mysqli_fetch_array($result);
                    $creditAccountID = $row['accountID'];
                    $dot = date("Y-m-d H:i:s");
                    $infos = "Αρχικοποίηση λογαριασμού";
                    
                }
                
                // Εκτέλεση query εισαγωγής εγγραφής στη βάση στον πίνακα 'Money Transfer' 
                $query = "INSERT INTO `MoneyTransfer`(`billingAccountID`, `creditAccountID`, `amount`, `dot`, `infos`) VALUES ('1','$creditAccountID','$amount','$dot','$infos')";
                mysqli_query($con,$query);
                
                // Αφαιρούμε το ποσό από τον λογαριασμό της τράπεζας κι ενημερώνουμε την εγγραφή στον πίνακα 'Accounts'
                $query  = "SELECT *  FROM `Accounts` WHERE accountID = '1'";
                $result = mysqli_query($con,$query);
                
                if (mysqli_num_rows($result) > 0) {
                    
                    $row = mysqli_fetch_array($result);
                    $dbAmount = $row['balance'];
                    $newDBAmount = $dbAmount - $amount;

                }
                
                $query = "UPDATE `Accounts` SET `balance`= $newDBAmount WHERE accountID = '1'";
                mysqli_query($con,$query);
                
                
                
                mysqli_close($con);
                // Εφόσον η εισαγωγή είναι επιτυχημένη, δείξε το παρακάτω μήνυμα και στείλε τον χρήστη στην αρχική σελίδα ebanking:
                echo "<script type='text/javascript'>alert('Ο λογαριασμός σας δημιουργήθηκε με επιτυχία!');window.location.href = \"../ebanking.php\";</script>";
                
            }

    }

?>