<?php

            session_start(); // Ανοίγουμε session για να μένει συνδεδεμένος ο authenticated χρήστης
            include './scripts/functionlib.php'; // Eισάγουμε την σελίδα που έχουμε τη βιβλιοθήκη με τις μεθόδους
            require './scripts/DBconnect.php'; // Eισάγουμε την σελίδα που έχει db connection
            userValidate(); //Πιστοποίηση χρήστη με το session που έχουμε ανοιχτό
            
            // Εύρεση στοιχείων πελάτη κι εκχώρηση μεταβλητών
            $cusID = $_SESSION['user_id'];
            $name = customerName();
            $lastname = customerLNAME();
            $email = customerEmail();

?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="iBank: Η τράπεζά σας στις υπηρεσίες σας">
        <meta name="author" content="Mariana S. Mazi">
        <meta name="keywords" content="iBank, ebanking, ιδιώτες">

        <title>iBank e-banking</title>

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
                <div class="menu menu-selected">
                    
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
                
                <div class="menu">
                    
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

                    <p class="regtitle regtitle-extra">Οι Λογαριασμοί μου</p>

                    <div id="accounts" class="infobox">
                        
                        <?php
    
                            // Εύρεση στοιχείων λογαριασμού του συγκεκριμένου πελάτη 
                            $query  = "SELECT *  FROM `Accounts` WHERE cusID = '".$cusID."'";
                            $result = mysqli_query($con,$query);
                            
                            while ($row = mysqli_fetch_row($result)) {
                                
                                $accountID = $row[0];
                                $friendlyName = $row[2];
                                $iban = $row[3];
                                $doc = $row[4];
                                $balance = $row[5];
                                
                                echo "<table style=\"width: 100%\">"; 
                                echo "<tr>";
                                echo "<td>";
                                echo "<span class=\"accard-name\"><a href=\"#\">$friendlyName</a></span>";
                                echo "</td>";
                                echo "<td style=\"text-align: right\">";
                                echo "<span class=\"accard-amount\">Διαθέσιμο Υπόλοιπο: ".number_format($balance,2,",",".")." Ευρώ</span>";
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>";
                                echo "<span class=\"accard-text\">$iban</span>";
                                echo "</td>";
                                echo "<td style=\"text-align: right\">";
                                
                                // Έλεγχος πιστώσεων στο λογαριασμό για τον τρέχοντα μήνα:
                                $creditQuery = "SELECT SUM(amount) FROM `MoneyTransfer` where creditAccountID = '".$accountID."' \n"
                                             . "and (dot >= LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH \n"
                                             . "AND dot < LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY)";
                                $creditResults = mysqli_query($con,$creditQuery);
                                $creditRow = mysqli_fetch_row($creditResults);
                                
                                if ($creditRow > 0) {
                                    
                                    $credit = $creditRow[0];
                                    
                                }
                                
                                echo "<span class=\"accard-amount accard-credit\">Πιστώσεις μήνα: ".number_format($credit,2,",",".")." Ευρώ</span>";
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>";
                                echo "<span class=\"accard-name\">Ημερομηνία δημιουργίας: ".date("d/m/Y", strtotime($doc))."</span>";
                                echo "</td>";
                                echo "<td style=\"text-align: right\">";
                                
                                // Έλεγχος χρεώσεων του λογαριασμού & έλεγχος πληρωμών για να πάρουμε το συνολικό χρεωστικό υπόλοιπο:
                                // Χρεώσεις λογαριασμού:
                                $billQuery = "SELECT SUM(amount) FROM `MoneyTransfer` where billingAccountID = '".$accountID."' \n"
                                           . " AND (dot >= LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH \n"
                                           . " AND dot < LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY)";
                                $billResults = mysqli_query($con,$billQuery);
                                $billRow = mysqli_fetch_row($billResults);
                                
                                if ($billRow > 0) {
                                    
                                    $bill = $billRow[0];
                                    
                                }
                                
                                // Πληρωμές λογαριασμού:
                                $payQuery = "SELECT SUM(amount) FROM `Payments` where accountID = '".$accountID."'";
                                $payResults = mysqli_query($con,$payQuery);
                                $payRow = mysqli_fetch_row($payResults);
                                
                                if ($payRow > 0) {
                                    
                                    $pay = $payRow[0];
                                    
                                }
                                
                                $billingTTL = $bill + $pay;
                                
                                echo "<span class=\"accard-amount accard-debit\">Χρεώσεις μήνα: ".number_format($billingTTL,2,",",".")." Ευρώ</span>";
                                echo "</td>";
                                echo "</tr>";
                                echo "</table>";
                                echo "<hr>";

                            }
                        
                        ?> 

                    </div>

                    <p class="acctitle">Οι Κάρτες μου</p>

                    <div id="cards" class="infobox">

                        <table style="width: 100%"> 

                            <tr>

                                <td>

                                    <span class="accard-name"><a href="#">VISA Μισθοδοσίας</a></span>

                                </td>

                                <td style="text-align: right">

                                    <span class="accard-amount">Διαθέσιμο Υπόλοιπο: 55,00 Ευρώ</span>

                                </td>

                            </tr>

                            <tr>

                                <td>

                                    <span class="accard-text">Αριθμός Κάρτας 4321 5678 1234 5678</span>

                                </td>

                                <td style="text-align: right">

                                    <span class="accard-amount accard-credit ">Πιστώσεις μήνα: 100,00 Ευρώ</span>

                                </td>

                            </tr>

                            <tr>

                                <td>

                                    <span class="accard-name">Ημερομηνία λήξης: 31/12/2020</span>

                                </td>

                                <td style="text-align: right">

                                    <span class="accard-amount accard-debit">Χρεώσεις μήνα: 155,00 Ευρώ</span>

                                </td>

                            </tr>

                        </table>

                        <hr>

                        <table style="width: 100%"> 

                            <tr>

                                <td>

                                    <span class="accard-name"><a href="#">MasterCard Prepaid</a></span>

                                </td>

                                <td style="text-align: right">

                                    <span class="accard-amount">Διαθέσιμο Υπόλοιπο: 0,00 Ευρώ</span>

                                </td>

                            </tr>

                            <tr>

                                <td>

                                    <span class="accard-text">5123 4567 8901 2345</span>

                                </td>

                                <td style="text-align: right">

                                    <span class="accard-amount accard-credit ">Πιστώσεις μήνα: 300,00 Ευρώ</span>

                                </td>

                            </tr>

                            <tr>

                                <td>

                                    <span class="accard-name">Ημερομηνία λήξης: 31/12/2019</span>

                                </td>

                                <td style="text-align: right">

                                    <span class="accard-amount accard-debit">Χρεώσεις μήνα: 300,00 Ευρώ</span>

                                </td>

                            </tr>

                        </table>

                    </div>

                </div>
                
                <!-- Εδώ ξεκινά το πλαίσιο που περιλαμβάνει τις Πρόσφατες Συναλλαγές. Γίνεται κάποια επιπλέον μορφοποίηση
                     με την ιδιότητα 'style' στους πίνακες, για να πετύχουμε την απόδοση εμφανισιακά στο mockup της εκφώνησης.
                     Επιπρόσθετα, σε περιπτώσεις σαν κι αυτές, εξυπηρετεί καλύτερα η άμεση εφαρμογή css κανόνων. -->
                <div id="recenttrans"> 

                    <p class="regtitle regtitle-extra">Πρόσφατες Συναλλαγές</p>
                    
                    <div class="infobox2">
                        
                        <?php
                        
                            // Εύρεση τελευταίων 2 κινήσεων του πίνακα "Μεταφορά Χρημάτων" του συγκεκριμένου πελάτη - Υλοποίηση εναλλακτικής (α) 
                            $query = "SELECT * FROM `MoneyTransfer` WHERE dot < now() AND showRecent = 1 AND (billingAccountID IN (SELECT accountID FROM Accounts WHERE cusID='".$cusID."') \n"
                                   . "OR creditAccountID IN (SELECT accountID FROM Accounts WHERE cusID='".$cusID."')) ORDER BY dot DESC LIMIT 2";
                            $result = mysqli_query($con,$query);
                            
                            while ($row = mysqli_fetch_row($result)) {
                                
                                $amount = $row[3];
                                $dot = $row[4];
                                $infos = $row[5];
                                
                                echo "<table style=\"width: 100%; height: 27%\">";
                                echo "<tr>";
                                echo "<td colspan=\"2\">";
                                echo "<span class=\"accard-name\"><span style=\"font-weight: bolder; text-decoration: underline; color: #08b4c3\">Μεταφορά:</span>&nbsp&nbsp<span style=\"font-weight: bolder\">".$infos."</span>";
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td colspan=\"2\">";
                                echo "<span>".number_format($amount,2,",",".")." Ευρώ</span>";
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td colspan=\"2\">";
                                echo "<span>Ημερομηνία εκτέλεσης: ".date("d/m/Y", strtotime($dot))."</span>";
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td style=\"width: 42%\">";
                                echo "<span><a href=\"#\">Λεπτομέρειες ></a></span>";
                                echo "</td>";
                                echo "<td>";
                                echo "<span><a href=\"#\">Νέα όμοια ></a></span>";
                                echo "</td>";
                                echo "</tr>";
                                echo "</table>";
                                echo "<hr>";

                            }
                            
                            // Εύρεση τελευταίων 2 κινήσεων του πίνακα "Πληρωμή του συγκεκριμένου πελάτη - Υλοποίηση εναλλακτικής (α)
                            $query =  "SELECT P.paymentTypeID, PT.paymentType, P.amount, P.dot, P.showRecent FROM Payments P INNER JOIN PaymentType PT ON P.paymentTypeID = PT.paymentTypeID \n"
                                    . "WHERE P.customerID = '".$cusID."' AND P.showRecent = 1 AND P.dot < now() order by dot desc limit 2";
                            $result = mysqli_query($con,$query);

                            while ($row = mysqli_fetch_row($result)) {
                                
                                $ptype = $row[1];
                                $amount = $row[2];
                                $dot = $row[3];
                                
                                echo "<table style=\"width: 100%; height: 27%\">";
                                echo "<tr>";
                                echo "<td colspan=\"2\">";
                                echo "<span class=\"accard-name\"><span style=\"font-weight: bolder; text-decoration: underline; color: #ff0000\">Πληρωμή:</span>&nbsp&nbsp<span style=\"font-weight: bolder\">".$ptype."</span>";
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td colspan=\"2\">";
                                echo "<span>".number_format($amount,2,",",".")." Ευρώ</span>";
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td colspan=\"2\">";
                                echo "<span>Ημερομηνία εκτέλεσης: ".date("d/m/Y", strtotime($dot))."</span>";
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td style=\"width: 42%\">";
                                echo "<span><a href=\"#\">Λεπτομέρειες ></a></span>";
                                echo "</td>";
                                echo "<td>";
                                echo "<span><a href=\"#\">Νέα όμοια ></a></span>";
                                echo "</td>";
                                echo "</tr>";
                                echo "</table>";
                                echo "<hr>";

                            }
                            mysqli_close($con);
                        
                        ?>
                        
                        <table style="width: 100%; height: 12%">
                            
                            <tr>
                                
                                <td>
                                    
                                    <button id="history" type="button" onclick="location.href='./history.php'" style="width: 100%; height: 35px;">ΙΣΤΟΡΙΚΟ ΣΥΝΑΛΛΑΓΩΝ</button>
                                                                        
                                </td>
                                
                            </tr>
                            
                        </table>
                        
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