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

        <title>iBank Λογαριασμοί</title>

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
                
                <div class="menu menu-selected">
                    
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
                    
                    <a href="history.php">Ιστορικό</a> 
                
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
                    
                <div class="add-account">
                    
                    <span id="nolink">
                    
                        <a href="./addaccount.php">
                            
                            <table class="add-account-title">
                                
                                <tr>
                                    
                                    <td>Προσθήκη λογαριασμού</td>
                                    <td> <i class="fas fa-plus-circle lg"></i> </td>
                                    
                                </tr>
                                
                            </table>
                            
                        </a>
                    
                    </span>

                </div>

                <div class="remove-account">
                    
                    <span id="nolink">
                    
                        <a href="./removeaccount.php">
                            
                            <table class="remove-account-title">
                                
                                <tr>
                                    
                                    <td>Διαγραφή λογαριασμού</td>
                                    <td> <i class="fas fa-minus-circle lg"></i> </td>
                                    
                                </tr>
                                
                            </table>

                        </a>
                    
                    </span>

                </div>
                
            </div>
  
            <?php
            
                // Εύρεση στοιχείων λογαριασμού του συγκεκριμένου πελάτη 
                $query  = "SELECT *  FROM `Accounts` WHERE cusID = '".$_SESSION['user_id']."'";
                $result = mysqli_query($con,$query);
                $count = 1;
                
                while ($row = mysqli_fetch_row($result)) {
                    
                    if ($count%4 == 1)
                    {  
                         echo "<div id=\"style-container\">";
                         echo "<div class=\"smallspace\"></div>";
                    }
                    
                    $accountID = $row[0];
                    $friendlyName = $row[2];
                    $iban = $row[3];
                    $doc = $row[4];
                    $balance = $row[5];
                    
                    echo "<div class=\"account-card\">";
                    echo "<div class=\"card-title\">".$friendlyName."</div>";
                    echo "<div class=\"card-descr\">Διαθέσιμο Υπόλοιπο:</div>";
                    
                    if ($balance < 0) {
                        
                        echo "<div class=\"card-amount-debit\">".number_format($balance,2,",",".")." Ευρώ</div>";
                    
                    } else {
                        echo "<div class=\"card-amount-credit\">".number_format($balance,2,",",".")." Ευρώ</div>";
                        
                    }
                    
                    echo "<div class=\"card-iban\">".$iban."</div>";
                    echo "</div>";
                    
                    if ($count%4 == 0)
                    {
                        echo "</div>";
                    }
                    $count++;
    
                }
                
                if ($count%4 != 1) echo "</div>";
                mysqli_close($con);
            
            ?> 

        </div>

        <!-- Εδώ ξεκινάει το υποσέλιδο. Χρησιμοποιώ 3 divs για να περιλάβω το email, τα τηλέφωνα και τα links για τους 
             όρους χρήσης και την πολιτική απορρήτου. Εδώ αξίζει να προσέξουμε ότι τα divs δεν είναι όμοια, αλλά κάθε ένα έχει το δικό
             του πλάτος. Εδώ εξυπηρετεί να χρησιμοποιήσουμε το style αντί για css, γιατί οι διαφορές είναι πιο πολλές απ' όσες οι ομοιότητες, 
             ώστε να μας επιτρέπει να δημιουργήσου��ε κλάσεις. -->
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