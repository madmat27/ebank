<?php

            session_start(); // Ανοίγουμε session για να μένει συνδεδεμένος ο authenticated χρήστης
            include './scripts/functionlib.php'; // Eισάγουμε την σελίδα που έχουμε τη βιβλιοθήκη με τις μεθόδους
            require './scripts/DBconnect.php'; // Eισάγουμε την σελίδα που έχει db connection
            userValidate(); //Πιστοποίηση χρήστη με το session που έχουμε ανοιχτό
            
            // Εύρεση στοιχείων πελάτη κι εκχώρηση μεταβλητών
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

        <title>iBank | Μεταφορά Χρημάτων</title>

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

                <div class="menu menu-selected">
                    
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
             χωρίς να αλλοιώνουμε το branding της ιστοσελίδας. Παρακάτω είναι το περιεχόμενο της σελίδας transfer (Μεταφοράς 
             χρημάτων - Εικόνα 3 της εκφώνησης). -->
        <div id="container">
            
            <div id="style-container">
                
                <!-- Αυτό χρησιμοποιείται καθαρά για σχεδιαστικούς λόγους, για να αφήσει το απαιτούμενο κενό. -->
                <div class="smallspace">

                </div>
                
                <!-- Εδώ ξεκινούν τα πλαίσια που περιλαμβάνουν τους λογαριασμούς & τις κάρτες. Γίνεται κάποια επιπλέον μορφοποίηση
                     με την ιδιότητα 'style', γιατί είναι μεμονωμένες περιπτώσεις κι εξυπηρετεί καλύτερα η άμεση εφαρμογή css κανόνων-->
                <div id="transfer-mainbox"> 

                    <p class="regtitle regtitle-extra">Μεταφορά χρημάτων</p>
                    
                    <!-- Ξεκινάει το div που περιέχει τη φόρμα για τη μεταφορά χρημάτων: -->
                    <div id="accounts" class="transfer-form">
                        
                        <form name="money-transfer" action="./scripts/money_transfer.php" onsubmit="return validateForm()" method="post">

                            <table style="width: 100%"> 

                                <tr style="height: 35px;">

                                    <td style="text-align: right; width: 30%">

                                        <span class="transfer-labels">Από λογαριασμό</span>&nbsp;<span class="star">*</span>

                                    </td>

                                    <td style="text-align: left">
                                        
                                        <!-- Στοιχείο επιλογών: περιλαμβάνει όλους τους λογαριασμούς που έχουμε διαθέσιμους στην σελίδα ebanking: -->
                                        <select name="accountname" required class="transfer-inputs" style="width: 100%">
                                            
                                            <?php
            
                                                // Εύρεση στοιχείων λογαριασμού του συγκεκριμένου πελάτη 
                                                $query  = "SELECT *  FROM `Accounts` WHERE cusID = '".$_SESSION['user_id']."'";
                                                $result = mysqli_query($con,$query);
                                                
                                                while ($row = mysqli_fetch_row($result)) {

                                                    $accountID = $row[0];
                                                    $friendlyName = $row[2];
                                                    $iban = $row[3];
                                                    $doc = $row[4];
                                                    $balance = $row[5];

                                                    if ($balance < 0) {
                                                        
                                                        echo "<div class=\"card-amount-debit\">".number_format($balance,2,",",".")." Ευρώ</div>";
                                                    
                                                    } else {
                                                        echo "<div class=\"card-amount-credit\">".number_format($balance,2,",",".")." Ευρώ</div>";
                                                        
                                                    }
                                                    
                                                    echo "<option value=".$accountID.">".$friendlyName." (".number_format($balance,2,",",".").") - ".$iban."</option>";

                                                }

                                            ?> 

                                            

                                        </select>

                                    </td>

                                </tr>

                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="transfer-labels">Προς λογαριασμό</span>&nbsp;<span class="star">*</span>

                                    </td>

                                    <td style="text-align: left">

                                        <span class="transfer-inputs">

                                            <input name="iban" type="text" placeholder="Εισάγετε το IBAN του λογαριασμού" required style="width: 100%">

                                        </span>

                                    </td>

                                </tr>
                                
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="transfer-labels">Ποσό</span>&nbsp;<span class="star">*</span>

                                    </td>
                                    
                                    <td style="text-align: left">

                                        <span class="transfer-inputs">

                                            <!-- ποσό που επιθυμούμε να μεταφέρουμε: -->
                                            <input name="amount" type="text" placeholder="Σε μορφή XX,YY Ευρώ" required style="width: 30%">

                                        </span>

                                    </td>

                                </tr>
                                
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="transfer-labels">Πληροφορίες για &nbsp;<br> δικαιούχο</span>&nbsp;

                                    </td>

                                    <td style="text-align: left">

                                        <span class="transfer-inputs">

                                            <!-- Textbox 2 σειρών για πληροφοριακό κείμενο -->
                                            <textarea name="info" rows="2" cols="10" style="width: 100%"></textarea>

                                        </span>

                                    </td>

                                </tr>
                            
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="transfer-labels">Να εκτελεστεί</span>&nbsp;

                                    </td>

                                    <td style="text-align: left">
                                        
                                        <!-- Επιλογή ημερομηνίας εκτέλεσης: τώρα ή σε μελλοντική ημερομηνία -->
                                        <input type="radio" name="date" value="now" checked> Άμεσα
                                        <input type="radio" name="date" value="later"> Στις 
                                        <input type="date" name="tr_date">

                                    </td>                                    

                                </tr>
                                
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="transfer-labels">Εμφάνιση στις &nbsp;<br> πρόσφατες συναλλαγές:</span>&nbsp;

                                    </td>

                                    <td style="text-align: left">
                                        
                                        <!-- Checkbox εμφάνισης στις πρόσφατες συναλλαγές: -->
                                        <input type="checkbox" name="yesno" value="yes" checked> 

                                    </td>                                    

                                </tr>
                                
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                    </td>

                                    <td style="text-align: left">
                                        
                                        <!-- Κουμπί υποβολής φόρμας --> 
                                        <p><input style="width: 215px; height: 35px;" name="trstion_submit" id="trstion_submit" type="submit" value="ΜΕΤΑΦΟΡΑ"></p>

                                    </td>                                    

                                </tr>

                            </table>
                            
                        </form>

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
        
            function validateForm() {
                
                /* Δήλωση μεταβλητών */
                var iban = (document.forms["money-transfer"]["iban"].value).toUpperCase();
                var amount = document.forms["money-transfer"]["amount"].value;
                var inputDate = new Date(document.forms["money-transfer"]["tr_date"].value);
                var displayDate = document.forms["money-transfer"]["tr_date"].value;
                var todaysDate = new Date();
                
                /* Έλεγχος αν το IBAN παίρνει τους σωστούς χαρακτήρες και το σωστό μήκος */
                /* Δήλωση βοηθητικών μεταβλητών */
                var checkIBAN = /^([A-Z]{2}[ \-]?[0-9]{2})(?=(?:[ \-]?[A-Z0-9]){9,30}$)((?:[ \-]?[A-Z0-9]{3,5}){2,7})([ \-]?[A-Z0-9]{1,3})?$/.test(iban);
                
                if (!checkIBAN) {
                    
                    alert("Προσοχή! Το IBAN πρέπει να περιέχει 27 χαρακτήρες και να είναι της μορφής: GR00 0000 0000 0000 0000 0000 000");
                    return false;
                
                }
                
                /* Έλεγχος αν το ποσό είναι της μορφής ΧΧ,ΥΥ όπως ορίζει το πεδίο */
                /* Δήλωση βοηθητικών μεταβλητών */
                var checkAmount = /^\d+(?:\,\d{0,2})$/.test(amount);

                if (!checkAmount) {
                    
                    alert("Το ποσό πρέπει να είναι της μορφής ΧΧ,ΥΥ");
                    return false;

                }
                
                /* Έλεγχος της ημερομηνίας εκτέλεσης: Αν αναφέρεται στο παρελθόν, σταματά την υποβολή, ενώ
                   αν αναφέρεται στο μέλλον, ενημερώνει τον χρήστη ότι θα πρέπει να υπάρχει υπόλοιπο στο λογαριασμό 
                   για να εκτελεστεί η συναλλαγή: */

                if (inputDate < todaysDate) {
                    
                    alert("Η ημερομηνία εκτέλεσης της συναλλαγής αναφέρεται στο παρελθόν! Παρακαλώ διορθώστε την ημερομηνία.");
                    return false;
                    
                } else if (inputDate > todaysDate) {
                    
                    alert("Η συναλλαγή θα εκτελεστεί στις " + displayDate + ". Σας ενημερώνουμε ότι ο λογαριασμός σας πρέπει να έχει πιστωτικό υπόλοιπο για να γίνει η μεταφορά.");
                    
                }  
                
            }
            
         </script>
    
    
    </body>
</html>