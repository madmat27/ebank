<?php
        /* Ελέγχουμε αν ο χρήστης είναι πιστοποιημένος προτού του επιτρέψουμε πρόσβαση στη σελίδα.
           Επιπρόσθετα, θα έχουμε τη δυνατότητα να φέρνουμε εξατομικευμένα στοιχεία που αφορούν τον κάθε χρήστη,
           χωρίς να επιτρέπεται ο ένας χρήστης να έχει πρόσβαση στα στοιχεία του άλλου. */
        // Έναρξη session που επιτρέπει στον χρήστη να πλοηγείται στις προσωπικές του σελίδες, που απαιτούν πρόσβαση.
        session_start();
        include './functionlib.php'; // Eισάγουμε την σελίδα που έχουμε τη βιβλιοθήκη με τις μεθόδους
        require './DBconnect.php'; // Eισάγουμε την σελίδα που έχει db connection
        userValidate(); //Πιστοποίηση χρήστη με το session που έχουμε ανοιχτό

        if ($_POST['amount'] > 0) {
            
            echo "<script type='text/javascript'>alert('Προσοχή, ο λογαριασμός είναι πιστωτικός. Παρακαλώ επικοινωνήστε με την τράπεζα για τη διευθέτηση του υπολοίπου');</script>";
            /* Διαγράφουμε τα στοιχεία του πελάτη από τη βάση. Μαζί διαγράφονται και οι λογαριασμοί, όπως έχουμε ενημερώσει τον 
               πελάτη, καθώς στη βάση έχουμε επιλέξει την παράμετρο "ON DELETE CASCADE".*/
               $query  = "DELETE FROM `Accounts` WHERE IBAN = '".$_POST['iban']."'";
               $result = mysqli_query($con,$query);
               echo "<script type='text/javascript'>alert('Ο τραπεζικός λογαριασμός διαγράφηκε.');window.location.href = \"../accounts.php\";</script>";
        
               mysqli_close($con); // Kλείνουμε τη σύνδεση με τη βάση
            
        } else if ($_POST['amount'] < 0) {
            
            echo "<script type='text/javascript'>alert('Προσοχή, ο λογαριασμός είναι χρεωστικός. Παρακαλώ επικοινωνήστε με την τράπεζα για την τακτοποίηση του υπολοίπου');</script>";
            /* Διαγράφουμε τα στοιχεία του πελάτη από τη βάση. Μαζί διαγράφονται και οι λογαριασμοί, όπως έχουμε ενημερώσει τον 
               πελάτη, καθώς στη βάση έχουμε επιλέξει την παράμετρο "ON DELETE CASCADE".*/
               $query  = "DELETE FROM `Accounts` WHERE IBAN = '".$_POST['iban']."'";
               $result = mysqli_query($con,$query);
               echo "<script type='text/javascript'>alert('Ο τραπεζικός λογαριασμός διαγράφηκε.');window.location.href = \"../accounts.php\";</script>";
        
               mysqli_close($con); // Kλείνουμε τη σύνδεση με τη βάση
            
        } else {
            
            /* Διαγράφουμε τα στοιχεία του πελάτη από τη βάση. Μαζί διαγράφονται και οι λογαριασμοί, όπως έχουμε ενημερώσει τον 
               πελάτη, καθώς στη βάση έχουμε επιλέξει την παράμετρο "ON DELETE CASCADE".*/
               $query  = "DELETE FROM `Accounts` WHERE IBAN = '".$_POST['iban']."'";
               $result = mysqli_query($con,$query);
               echo "<script type='text/javascript'>alert('Ο τραπεζικός λογαριασμός διαγράφηκε.');window.location.href = \"../accounts.php\";</script>";
        
               mysqli_close($con); // Kλείνουμε τη σύνδεση με τη βάση
            
        }

?>