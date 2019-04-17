<?php

            session_start(); // Ανοίγουμε session για να μένει συνδεδεμένος ο authenticated χρήστης
            include './scripts/functionlib.php'; // Eισάγουμε την σελίδα που έχουμε τη βιβλιοθήκη με τις μεθόδους
            require './scripts/DBconnect.php'; // Eισάγουμε την σελίδα που έχει db connection
            userValidate(); //Πιστοποίηση χρήστη με το session που έχουμε ανοιχτό
            
            // Εύρεση στοιχείων πελάτη κι εκχώρηση μεταβλητών
            $name = customerName();
            $lastname = customerLNAME();
            $email = customerEmail();
            $cusID = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="iBank: Η τράπεζά σας στις υπηρεσίες σας">
        <meta name="author" content="Mariana S. Mazi">
        <meta name="keywords" content="iBank, ebanking, ιδιώτες">

        <title>iBank | Ιστορικό Συναλλαγών</title>

        <!-- Custom fonts for this template -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet" type="text/css"> 
        
        <!-- Favicon! :-) -->
        <link rel="icon" type="image/png" href="./icons/favicon.png">
        
        <!-- CSS Stylesheet -->
        <link rel = "stylesheet" type = "text/css" href = "./styles/mainstyle.css" />
        

    </head>

    <body>
        <!-- Χώρισα τη σελίδα σε 3 κεντρικά κομμάτια και δημιούργησα τα αντίστοιχα divs.
             Έχουμε λοιπόν την κεφαλίδα, που ορίζεται από το div με id="header", το υποσέλιδο που ορίζεται από 
             το div με id="footer" & το κυρίως κομμάτι που ορίζεται από το div container. 
             Εδώ να σημειώσουμε ότι τα header & footer θα είναι κοινά σε όλες τις σελίδες (με κάποιες ίσως μικρές αλλαγές), 
             ενώ το περιεχόμενο του container αλλάζει ανάλογα με τη σελίδα (εξού και το όνομα).
             Παρακάτω ξεκινά το header: -->
        <div id="header">
            
            <div>
                <a href="./ebanking.php"><img id="logo" src="./images/logo.png"></a>
                
                <!-- Στο παρακάτω div δημιουργούμε έναν πίνακα που να περιλαμβάνει τις 4 επιλογές που υπάρχουν στη σελίδα μας:
                     Τη "Βοήθεια", την "Αναζήτηση", την "Χρήστης" και την "Αποσύνδεση".  -->
                <div id="header-container">
                    
                    <table>
                        
                        <tr>
                            
                            <td style="width: 100px;">
                                
                                <div id="help">
                                    <span style="font-size: 22px">
                                    <i class="far fa-question-circle"></i>
                                </span>

                                <a href="#">Βοήθεια</a>

                                </div>
                                
                            </td>
                            
                            <td>
                                
                                <div id="search">

                                    <span style="font-size: 22px; ">
                                        <i class="fas fa-search"></i>
                                    </span>

                                    <input id="searchbox" type="text" placeholder="Αναζήτηση">

                                </div>
                                
                            </td>
                            
                        </tr>
                        
                        <tr>
                            
                            <td style="width: 200px;">
                                
                                <div id="user">
                                    <span style="font-size: 22px">
                                        <i class="fas fa-user"></i>
                                    </span>
                                
                                    
                                    &nbsp;<a href="./user.php">Γεια σου, <?php echo $name; ?></a>

                                </div>
                                
                            </td>
                            
                            <td>
                                
                                <div id="logout">

                                    <span style="font-size: 22px; ">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </span>

                                    <a href="./scripts/logout.php">Αποσύνδεση</a>

                                </div>
                                
                            </td>
                            
                        </tr>
                        
                    </table>
                    
                </div>

            </div>
            
            <!-- Το παρακάτω div αποτελεί το μενού που είναι εμφανές σε όλες τις σελίδες. Η μορφοποίηση γίνεται με τους css selectors: 
                 τα ids & τις κλάσεις. Παρατηρούμε ότι στην παρούσα σελίδα, το μενού αλλάζει για να προσαρμοστεί με την σελίδα του 
                 e-banking. -->
            <div id="navigation">
                <div class="menu">
                    
                    <a href="./ebanking.php">Αρχική</a>
                
                </div>
                
                <div class="menu">
                    
                    <a href="./accounts.php">Λογαριασμοί</a>
                
                </div>

                <div class="menu">
                    
                    <a href="#">Κάρτες</a>
                
                </div>

                <div class="menu">
                    
                    <a href="./transfer.php">Μεταφορές</a>
                
                </div>
                
                <div class="menu">
                    
                    <a href="./payments.php">Πληρωμές</a>
                
                </div>
                
                <div class="menu menu-selected">
                    
                    <a href="./history.php">Ιστορικό</a> 
                
                </div>                

                <div class="menu">
                    
                    <a href="./user.php">Προφίλ Χρήστη</a>
                
                </div>

                <div class="menu">
                    
                    <a href="./statistics.php">Στατιστικά</a>
                
                </div>   
                
            </div>
        
        </div>
        
        <!-- Εδώ ξεκινά το container. Για κάθε σελίδα της άσκησης είναι διαφορετικό & μας επιτρέπει να αλλάζουμε περιεχόμενο
             χωρίς να αλλοιώνουμε το branding της ιστοσελίδας. Παρακάτω είναι το περιεχόμενο της ebanking (Εικόνα 2 της εκφώνησης). -->
        <div id="container">
            
            <div id="style-container">
                
                <!-- Αυτό χρησιμοποιείται καθαρά για σχεδιαστικούς λόγους, για να αφήσει το απαιτούμενο κενό. -->
                <div class="smallspace">

                </div>
                
                <!-- Εδώ ξεκινούν τα πλαίσια που περιλαμβάνουν τους λογαριασμούς & τις κάρτες. Γίνεται κάποια επιπλέον μορφοποίηση
                     με την ιδιότητα 'style', γιατί είναι μεμονωμένες περιπτώσεις κι εξυπηρετεί καλύτερα η άμεση εφαρμογή css κανόνων-->
                <div id="accards"> 

                    <p class="regtitle regtitle-extra">Ιστορικό συναλλαγών: Μεταφορές & Πληρωμές</p>

                    <div id="accounts" class="infogrid">
                        
                        <?php

                            /* Κατασκευή pagination */
                            $query ="SELECT COUNT(M.dot) AS \"DATE\",\n"
                                    . " A.cusID AS \"CUSTOMERID\",\n"
                                    . " (SELECT CONCAT(C.name,' ',C.lastname)\n"
                                    . " FROM Customers C INNER JOIN Accounts A ON C.customerID = A.cusID WHERE A.accountID = M.creditAccountID) AS \"PAY FROM\",\n"
                                    . " A.friendlyName AS \"FROM (Name)\",\n" 
                                    . " A.IBAN AS \"FROM (IBAN)\",\n" 
                                    . " (SELECT CONCAT(C.name,' ',C.lastname)\n"
                                    . " FROM Customers C INNER JOIN Accounts A ON C.customerID = A.cusID WHERE A.accountID = M.creditAccountID) AS \"PAY TO\",\n" 
                                    . " B.IBAN AS \"To (IBAN)\",\n" 
                                    . " M.amount AS \"VALUE\",\n" 
                                    . " M.INfos AS \"INFO\",\n" 
                                    . " \"Μ\" AS \"TYPE OF PAYMENT\"\n"
                                    . " FROM MoneyTransfer M\n"
                                    . " INNER JOIN Accounts A ON M.billingAccountID = A.accountID\n"
                                    . " INNER JOIN Accounts B ON M.creditAccountID = B.accountID\n"
                                    . " WHERE billingAccountID IN (SELECT accountID FROM Accounts WHERE cusID='".$cusID."')\n"
                                    . " OR creditAccountID IN (SELECT accountID FROM Accounts WHERE cusID='".$cusID."')\n";
                            $result = mysqli_query($con,$query);
                            $row = mysqli_fetch_row($result);
                            $numOfRows = $row[0];
                                    
                            $query ="SELECT COUNT(P.dot) AS \"DATE\",\n" 
                                    . " P.customerID AS \"CUSTOMERID\",\n"
                                    . " (SELECT DISTINCT CONCAT(C.name,' ',C.lastname)\n"
                                    . " FROM Customers C INNER JOIN Payments P ON C.customerID = P.customerID WHERE P.customerID = '".$cusID."') AS \"PAY FROM\",\n"
                                    . " A.friendlyName AS \"FROM (Name)\",\n" 
                                    . " A.IBAN AS \"FROM (IBAN)\",\n" 
                                    . " PT.paymentType AS \"PAY TO\",\n" 
                                    . " NULL AS \"To (IBAN)\",\n" 
                                    . " P.amount AS \"VALUE\",\n" 
                                    . " P.paymentCode AS \"INFO\",\n" 
                                    . " \"Π\" AS \"TYPE OF PAYMENT\"\n"
                                    . " FROM Payments P\n"
                                    . " INNER JOIN Accounts A ON P.accountID = A.accountID\n"
                                    . " INNER JOIN PaymentType PT ON P.paymentTypeID = PT.paymentTypeID\n"
                                    . " WHERE customerID='".$cusID."'\n"
                                    . " ORDER BY DATE DESC\n";
                            $result = mysqli_query($con,$query);
                            $row = mysqli_fetch_row($result);
                            $numOfRows = $numOfRows + $row[0];
                            
                            $rowsPerPage = 10;
                            // Βρίσκουμε τις συνολικές σελίδες 
                            $totalPages = ceil($numOfRows / $rowsPerPage);
                            
                            // Ορίζουμε την τρέχουσα σελίδα
                            if (isset($_GET['currentPage']) && is_numeric($_GET['currentPage'])) {
                               $currentPage = (int) $_GET['currentPage'];
                            } else {
                               $currentPage = 1;
                            }
                            
                            // Αν η τρέχουσα σελίδα είναι μεγαλύτερη από τις συνολικές σελίδες, όρισε ως τρέχουσα την τελευταία
                            if ($currentPage > $totalPages) {
                               $currentPage = $totalPages;
                            }
                            
                            // Αλλιώς αν είναι μικρότερη, όρισε ως τρέχουσα την πρώτη
                            if ($currentPage < 1) {
                               $currentPage = 1;
                            }
                            
                            // Ορίζουμε το offset σύμφωνα με την τρέχουσα σελίδα
                            $offset = ($currentPage - 1) * $rowsPerPage;
                            
                            // Εύρεση στοιχείων λογαριασμού του συγκεκριμένου πελάτη 
                            $query ="SELECT M.dot AS \"DATE\",\n"
                                    . " A.cusID AS \"CUSTOMERID\",\n"
                                    . " (SELECT CONCAT(C.name,' ',C.lastname)\n"
                                    . " FROM Customers C INNER JOIN Accounts A ON C.customerID = A.cusID WHERE A.accountID = M.creditAccountID) AS \"PAY FROM\",\n"
                                    . " A.friendlyName AS \"FROM (Name)\",\n" 
                                    . " A.IBAN AS \"FROM (IBAN)\",\n" 
                                    . " (SELECT CONCAT(C.name,' ',C.lastname)\n"
                                    . " FROM Customers C INNER JOIN Accounts A ON C.customerID = A.cusID WHERE A.accountID = M.creditAccountID) AS \"PAY TO\",\n" 
                                    . " B.IBAN AS \"To (IBAN)\",\n" 
                                    . " M.amount AS \"VALUE\",\n" 
                                    . " M.INfos AS \"INFO\",\n" 
                                    . " \"Μ\" AS \"TYPE OF PAYMENT\"\n"
                                    . " FROM MoneyTransfer M\n"
                                    . " INNER JOIN Accounts A ON M.billingAccountID = A.accountID\n"
                                    . " INNER JOIN Accounts B ON M.creditAccountID = B.accountID\n"
                                    . " WHERE billingAccountID IN (SELECT accountID FROM Accounts WHERE cusID='".$cusID."')\n"
                                    . " OR creditAccountID IN (SELECT accountID FROM Accounts WHERE cusID='".$cusID."')\n"
                                    . " UNION ALL\n"
                                    . " SELECT P.dot AS \"DATE\",\n" 
                                    . " P.customerID AS \"CUSTOMERID\",\n"
                                    . " (SELECT DISTINCT CONCAT(C.name,' ',C.lastname)\n"
                                    . " FROM Customers C INNER JOIN Payments P ON C.customerID = P.customerID WHERE P.customerID = '".$cusID."') AS \"PAY FROM\",\n"
                                    . " A.friendlyName AS \"FROM (Name)\",\n" 
                                    . " A.IBAN AS \"FROM (IBAN)\",\n" 
                                    . " PT.paymentType AS \"PAY TO\",\n" 
                                    . " NULL AS \"To (IBAN)\",\n" 
                                    . " P.amount AS \"VALUE\",\n" 
                                    . " P.paymentCode AS \"INFO\",\n" 
                                    . " \"Π\" AS \"TYPE OF PAYMENT\"\n"
                                    . " FROM Payments P\n"
                                    . " INNER JOIN Accounts A ON P.accountID = A.accountID\n"
                                    . " INNER JOIN PaymentType PT ON P.paymentTypeID = PT.paymentTypeID\n"
                                    . " WHERE customerID='".$cusID."'\n"
                                    . " ORDER BY DATE DESC\n"
                                    . " LIMIT $offset, $rowsPerPage";
                            
                            
                            $result = mysqli_query($con,$query);
                            $i = 0;
                            
                            echo "<table class=\"payments-table\">";
                            echo "<tr class=\"payments-table-header\">";
                            echo "<th>Ημ/νία Συναλλαγής</th>";
                            echo "<th>Δικαιούχος</th>";
                            echo "<th>Από λογαριασμό</th>";
                            echo "<th>IBAN</th>";
                            echo "<th>Προς δικαιούχο</th>";
                            echo "<th>IBAN</th>";
                            echo "<th>Ποσό</th>";
                            echo "<th>Σχόλια</th>";
                            echo "<th>Συναλλαγή</th>";
                            echo "</tr>";
                            
                            
                            while ($row = mysqli_fetch_row($result)) {

                                $transactionDate = $row[0];
                                $payer = $row[2];
                                $friendlyName = $row[3];
                                $myIBAN = $row[4];
                                $beneficiary = $row[5];
                                $befIBAN = $row[6];
                                $amount = $row[7];
                                $rems = $row[8];
                                $transactionType = $row[9];
                                
                                echo ($i % 2)?'<tr class="payments-table-oddlines">':'<tr class="payments-table-evenlines">';
                                echo "<td>";
                                echo "<span>".date("d/m/Y h:m:s", strtotime($transactionDate))."</span>";
                                echo "</td>";
                                echo "<td>";
                                echo "<span>".$payer."</span>";
                                echo "</td>";
                                echo "<td>";
                                echo "<span>".$friendlyName."</span>";
                                echo "</td>";
                                echo "<td>";
                                echo "<span>".$myIBAN."</span>";
                                echo "</td>";
                                echo "<td>";
                                echo "<span>".$beneficiary."</span>";
                                echo "</td>";
                                echo "<td>";
                                
                                if ($befIBAN) {
                                    
                                    echo "<span>".$befIBAN."</span>";
                                
                                } else {
                                    
                                    echo "<span>---</span>";
                                    
                                }
                                
                                echo "</td>";
                                echo "<td>";
                                echo "<span>".number_format($amount,2,",",".")."</span>";
                                echo "</td>";
                                echo "<td>";
                                echo "<span>".$rems."</span>";
                                echo "</td>";
                                echo "<td>";
                                
                                if ($transactionType == 'Μ') {
                                    
                                    echo "<span>Μεταφορά</span>";
                                    
                                } else {
                                    
                                    echo "<span>Πληρωμή</span>";
                                }
                                
                                echo "</td>";
                                echo "</tr>";
                                $i++;
                                
                            }

                            echo "</table>";
                            
                            echo "<div class=\"space\"></div>";
                            
                            /******  Φτιάχνουμε τα pagination links ******/
                            // Αριθμός των links που θέλουμε να εμφανίζονται στο κάτω μέρος της σελίδας
                            $range = 3;
                            
                            echo "<table style=\"margin-left: auto; margin-right: auto; font-size: 20px;\">";
                            echo "<tr>";
                            
                            // Αν δεν είμαστε στην πρώτη σελίδα, δείξε τα προηγούμενα links
                            if ($currentPage > 1) {
                               echo "<td> <a style=\"text-decoration:none; color: #444444\" href='{$_SERVER['PHP_SELF']}?currentPage=1'><<</a> </td>";
                               $prevPage = $currentPage - 1;
                               echo "<td> <a style=\"text-decoration:none; color: #444444\" href='{$_SERVER['PHP_SELF']}?currentPage=$prevPage'><</a> </td>";
                            } 
                            
                            // Βρόγχος εμφάνισης links σύμφωνα με το εύρος των σελίδων, σε σχέση με την τρέχουσα
                            for ($x = ($currentPage - $range); $x < (($currentPage + $range) + 1); $x++) {
                               if (($x > 0) && ($x <= $totalPages)) {
                                  if ($x == $currentPage) {
                                     echo "<td style=\"color: #08b4c3\"> [<b>$x</b>] </td>";
                                  } else {
                                     echo "<td> <a style=\"text-decoration:none; color: #444444\" href='{$_SERVER['PHP_SELF']}?currentPage=$x'>$x</a> </td>";
                                  }
                               } 
                            }
                            
                            // Αν δεν είμαστε στην τελευταία σελιδα, εμφάνισε τα links επόμενης και τελευταίας σελίδας        
                            if ($currentPage != $totalPages) {
                               $nextPage = $currentPage + 1;
                               echo "<td> <a style=\"text-decoration:none; color: #444444\" href='{$_SERVER['PHP_SELF']}?currentPage=$nextPage'>></a> </td>";
                               echo "<td> <a style=\"text-decoration:none; color: #444444\" href='{$_SERVER['PHP_SELF']}?currentPage=$totalPages'>>></a> </td>";
                            }
                            /****** Τέλος pagination links ******/
                            
                            echo "</tr>";
                            echo "</table>";
                        ?>

                    </div>
                    
                    <!-- Αυτό χρησιμοποιείται καθαρά για σχεδιαστικούς λόγους, για να αφήσει το απαιτούμενο κενό. -->
                    <div class="space">
    
                    </div>

                </div>

            </div>            
            
        </div>

        <!-- Εδώ ξεκινάει το υποσέλιδο. Χρησιμοποιώ 3 divs για να περιλάβω το email, τα τηλέφωνα και τα links για τους 
             όρους χρήσης και την πολιτική απορρήτου. Εδώ αξίζει να προσέξουμε ότι τα divs δεν είναι όμοια, αλλά κάθε ένα έχει το δικό
             του πλάτος. Εδώ εξυπηρετεί να χρησιμοποιήσουμε το style αντί για css, γιατί οι διαφορές είναι πιο πολλές απ' όσες οι ομοιότητες, 
             ώστε να μας επιτρέπει να δημιουργήσουμε κλάσεις. -->
        <div id="footer">
            
            <div id="mail">
                
                <table> 
                    
                    <tr>
                        
                        <td>
                            
                            <span style="font-size: 48px; ">

                                <i class="far fa-envelope"></i>

                            </span>
                            
                        </td>
                        
                        <td class="seperator" style="width: 250px;">
                            
                            <a href="mailto:support@ibank.gr">support@ibank.gr</a><br>
                            <span style="font-size: 14px;">Email Επικοινωνίας</span>
                            
                        </td>
                        
                    </tr>
                    
                </table>
                
            
            </div>
                        
            <div id="phones">
                
                <table>
                    
                    <tr style="width: 450px;">
                        
                        <td style="padding-right: 10px;">
                            
                            <span style="font-size: 48px; ">
                            
                                <i class="fas fa-phone"></i>
                            
                            </span>
                        
                        </td>
                        
                        <td style="padding-right: 10px;">                           
                            
                            123456 <br>
                            <span style="font-size: 14px;">Κλήση από Ελλάδα</span>
                            
                        </td>
                        
                        <td>                           
                            
                            +30 2101234567 <br>
                            <span style="font-size: 14px;">Κλήση από Εξωτερικό</span>
                            
                        </td>
                        
                    </tr>
                </table>
            
            </div>
            
            <div id="terms-of-use">
                
                <a href="#">Όροι Χρήσης</a> | <a href="#"> Πολιτική απορρήτου </a>
                
            </div>
        
        </div>
        
        <!-- Javascript κώδικας -->
        <!-- Να σημειωθεί ότι όταν βάζουμε τον κώδικα μέσα στη σελίδα, προτιμούμε να τον βάζουμε στο τέλος του body, ώστε να μην καθυστερεί
             το φόρτωμα της σελίδας, για να γίνει compile το js. -->
        <script>
 
        </script>
    
    
    </body>
</html>