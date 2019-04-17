<?php
        /* Ελέγχουμε αν ο χρήστης είναι πιστοποιημένος προτού του επιτρέψουμε πρόσβαση στη σελίδα.
           Επιπρόσθετα, θα έχουμε τη δυνατότητα να φέρνουμε εξατομικευμένα στοιχεία που αφορούν τον κάθε χρήστη,
           χωρίς να επιτρέπεται ο ένας χρήστης να έχει πρόσβαση στα στοιχεία του άλλου. */
        // Έναρξη session που επιτρέπει στον χρήστη να πλοηγείται στις προσωπικές του σελίδες, που απαιτούν πρόσβαση.
        session_start();
        include './functionlib.php'; // Eισάγουμε την σελίδα που έχουμε τη βιβλιοθήκη με τις μεθόδους
        require './DBconnect.php'; // Eισάγουμε την σελίδα που έχει db connection
        userValidate(); //Πιστοποίηση χρήστη με το session που έχουμε ανοιχτό
        
        /* Αν έχει πατηθεί το submit, ξεκινάμε τη διαδικασία καταχώρησης της μεταφοράς στη βάση */
        if (isset($_POST['trstion_submit'])) {
            
                
                /* Εκχώρηση στοιχείων φόρμας html σε μεταβλητές */
                $accountID = $_POST['accountname'];
                $iban = mysqli_real_escape_string($con,strtoupper($_POST['iban']));
                $amount = mysqli_real_escape_string($con,$_POST['amount']);
                $infos = mysqli_real_escape_string($con,$_POST['info']);
                $trDate = $_POST['tr_date'];
                 
                if ($_POST['date'] == "now") {
                    
                    $trsctionDate = date("Y-m-d H:i:s");
                    
                } else {
                    
                    $trsctionDate = date("Y-m-d H:i:s", strtotime($trDate));
                    echo $trsctionDate;
                }
                
                if ( $_POST['yesno'] == "yes") {
                    
                    $showRecent = 1;
                
                } else {
                    
                    $showRecent = 0;
                }

                /* Έλεγχος o λογαριασμός που επιλέξαμε έχει πιστωτικό υπόλοιπο. Αν όχι, ενημερώνει τον πελάτη */
                $query = "SELECT * FROM `Accounts` WHERE accountID = '".$accountID."' AND balance > '".$amount."'";
                $result = mysqli_query($con,$query);
                $row = mysqli_fetch_row($result);

                if (mysqli_num_rows($result) > 0) {
    
                    /*  Σε περίπτωση που βρεθούν παραπάνω από 0 εγγραφές στον πίνακα των πελατών με αυτές τις προδιαγραφές 
                        σημαίνει ότι η συναλλαγή μπορεί να εκτελεστεί. Άρα προχωράμε με τις απαιτούμενες ενέργειες.
                        Πρώτα παίρνουμε τα στοιχεία του λογαριασμού που κάνει την μεταφορά */

                        $query = "SELECT * FROM `Accounts` WHERE accountID = '".$accountID."'";
                        $result = mysqli_query($con,$query);
                        $row = mysqli_fetch_row($result);

                        $DBAccountID = $row[0];
                        $DBCusID = $row[1];
                        $DBFriendlyName = $row[2];
                        $IBAN = $row[3];
                        $DBdoc = $row[4];
                        $DBBalance = $row[5];
                        
                    /*  Έπειτα ελέγχουμε αν το IBAN που θα λάβει τα χρήματα ανήκει στην τράπεζά μας */
                    
                        $query = "SELECT * FROM `Accounts` WHERE iban = '".$iban."'";
                        $result = mysqli_query($con,$query);
                        $row = mysqli_fetch_row($result);

                        $benefAccountID = $row[0];
                        $benefCusID = $row[1];
                        $benefFriendlyName = $row[2];
                        $benefIBAN = $row[3];
                        $benefDoc = $row[4];
                        $benefBalance = $row[5];
                        
                        /*  Αν ανήκει, κάνουμε τις εξής ενέργειες:
                            α. Χρεώνουμε το λογαριασμό του πελάτη που κάνει τη μεταφορά με το ποσό της κατάθεσης
                            β. Πιστώνουμε το λογαριασμό του δικαιούχου που θα λάβει το ποσό της μεταφοράς
                            γ. Καταχωρούμε μια εγγραφή στον πίνακα "Μεταφορά Χρημάτων" για την εκτέλεση της συναλλαγής */ 
                        if (mysqli_num_rows($result) > 0) {

                            $query = "UPDATE `Accounts` SET balance = '".($DBBalance - $amount)."' where accountID = '".$accountID."'";
                            $result = mysqli_query($con,$query);
                            
                            $query = "UPDATE `Accounts` SET balance = '".($benefBalance + $amount)."' where iban = '".$iban."'";
                            $result = mysqli_query($con,$query);
                            
                            $query = "INSERT INTO `MoneyTransfer` (billingAccountID, creditAccountID, amount, dot, infos, showRecent) VALUES ('".$accountID."','".$benefAccountID."','".$amount."','".$trsctionDate."','".$infos."','".$showRecent."')";
                            $result = mysqli_query($con,$query);
                            
                        } else {
                            
                        /*  Αν δεν ανήκει, κάνουμε μόνο τις παρακάτω ενέργειες:
                            α. Χρεώνουμε το λογαριασμό του πελάτη που κάνει τη μεταφορά με το ποσό της κατάθεσης
                            β. Καταχωρούμε μια εγγραφή στον πίνακα "Μεταφορά Χρημάτων" για την εκτέλεση της συναλλαγής 
                            Παραδοχή: έχουμε δημιουργήσει μια ψευδοεγγραφή στη ΒΔ στους χρήστες, που αφορά συναλλαγές εκτός τράπεζας.
                            Ομοίως και στους λογαριασμούς. Οπότε, αν ο πελάτης είναι εκτός τράπεζας, τότε ενημερώνονται εκείνες οι εγγραφές*/     
                        
                            $query = "UPDATE `Accounts` SET balance = '".($DBBalance - $amount)."' where accountID = '".$accountID."'";
                            $result = mysqli_query($con,$query);
                            
                            $query = "SELECT * FROM `Accounts` WHERE accountID = '9999'";
                            $result = mysqli_query($con,$query);
                            $row = mysqli_fetch_row($result);
    
                            $benefBalance = $row[5];

                            $query = "UPDATE `Accounts` SET balance = '".($benefBalance + $amount)."' where accountID = '9999'";
                            $result = mysqli_query($con,$query);

                            $query = "INSERT INTO `MoneyTransfer` (billingAccountID, creditAccountID, amount, dot, infos, showRecent) VALUES ('".$accountID."','9999','".$amount."','".$trsctionDate."','".$infos."','".$showRecent."')";
                            $result = mysqli_query($con,$query);
                            
                        }
                        
                        echo "<script type='text/javascript'>alert('Η συναλλαγή ολοκληρώθηκε με επιτυχία!');window.location.href = \"../ebanking.php\";</script>";
    
                }  else {
                
                    // Αν δε βρεθούν εγγραφές, πρέπει ο πελάτης να επιλέξει έναν πιστωτικό λογαριασμό του οποίου το υπόλοιπο
                    // να είναι μεγαλύτερο από την μεταφορά που θέλει να πραγματοποιήσει: 
                    echo "<script type='text/javascript'>alert('Επιλέξτε έναν πιστωτικό λογαριασμό, του οποίου το υπόλοιπο να είναι μεγαλύτερο από την μεταφορά που θέλετε να πραγματοποιήσετε');window.location.href = \"../transfer.php\";</script>";
 
                }
                
        }
        
        mysqli_close($con);
        
?>