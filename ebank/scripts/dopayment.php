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
                $paymentTypeID = $_POST['paymentorg'];
                $amount = mysqli_real_escape_string($con,$_POST['amount']);
                $paymentCode = strtoupper(mysqli_real_escape_string($con,$_POST['info']));
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
    
                    /*  Σε περίπτωση που βρεθούν παραπάνω από 0 εγγραφές στον πίνακα των πελατών με αυτό το email, 
                        σημαίνει ότι η συναλλαγή μπορεί να εκτελεστεί. Άρα προχωράμε με τις απαιτούμενες ενέργειες.
                        Πρώτα παίρνουμε τα στοιχεία του λογαριασμού που κάνει την πληρωμή */

                        $query = "SELECT * FROM `Accounts` WHERE accountID = '".$accountID."'";
                        $result = mysqli_query($con,$query);
                        $row = mysqli_fetch_row($result);

                        $DBAccountID = $row[0];
                        $DBCusID = $row[1];
                        $DBFriendlyName = $row[2];
                        $IBAN = $row[3];
                        $DBdoc = $row[4];
                        $DBBalance = $row[5];
                        
                    /* Κατόπιν καταχωρούμε την εγγραφή της πληρωμής στον πίνακα "Payments" */
                        
                        $query = "INSERT INTO `Payments`(`paymentTypeID`, `paymentCode`, `amount`, `dot`, `accountID`, `customerID`, `showRecent`) VALUES ('".$paymentTypeID."','".$paymentCode."','".$amount."','".$trsctionDate."','".$accountID."','".$DBCusID."','".$showRecent."')";
                        $result = mysqli_query($con,$query);
                        
                    /* Και αφαιρούμε το ποσό από το λογαριασμό που έκανε την πληρωμή */
                    
                        $query = "UPDATE `Accounts` SET balance = '".($DBBalance - $amount)."' WHERE accountID = '".$DBAccountID."'";
                        $result = mysqli_query($con,$query);
                        
                    echo "<script type='text/javascript'>alert('Η πληρωμή ολοκληρώθηκε με επιτυχία!');window.location.href = \"../ebanking.php\";</script>";
    
                }  else {
                
                    // Αν δε βρεθούν εγγραφές, πρέπει ο πελάτης να επιλέξει έναν πιστωτικό λογαριασμό του οποίου το υπόλοιπο
                    // να είναι μεγαλύτερο από την μεταφορά που θέλει να πραγματοποιήσει: 
                    echo "<script type='text/javascript'>alert('Επιλέξτε έναν πιστωτικό λογαριασμό, του οποίου το υπόλοιπο να είναι μεγαλύτερο από την πληρωμή που θέλετε να πραγματοποιήσετε');window.location.href = \"../payments.php\";</script>";
 
                }
                
        }
        
        mysqli_close($con);
        
?>