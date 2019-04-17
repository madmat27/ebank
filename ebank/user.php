<?php

        session_start(); // Ανοίγουμε session για να μένει συνδεδεμένος ο authenticated χρήστης
        include './scripts/functionlib.php'; // Eισάγουμε την σελίδα που έχουμε τη βιβλιοθήκη με τις μεθόδους
        userValidate(); //Πιστοποίηση χρήστη με το session που έχουμε ανοιχτό
        
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
                    $sex = $row['sex'];
                    $dob = $row['dob'];
                    
                    switch ($row['sex']) {
                    case "M":
                        $sex = "male";
                        break;
                    case "F":
                        $sex = "female";
                        break;
                    case "O":
                        $sex = "other";
                        break;
                    default:
                        $sex = "";
                }
                    
                    mysqli_close($con);
                
                }

?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="iBank: Η τράπεζά σας στις υπηρεσίες σας">
        <meta name="author" content="Mariana S. Mazi">
        <meta name="keywords" content="iBank, ebanking, ιδιώτες">

        <title>iBank | Στοιχεία Χρήστη</title>

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
                
                <!-- Στο παρακάτω div δημιουργούμε έναν πίνακα που να περιλαμβάνει τις 4 επιλογές που υπάρχουν στη σελίδα        
                μας: Τη "Βοήθεια", την "Αναζήτηση", την "Χρήστης" και την "Αποσύνδεση".  -->
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
            
            <!-- Το παρακάτω div αποτελεί το μενού που είναι εμφανές σε όλες τις σελίδες. Η μορφοποίηση γίνεται με τους css 
                 selectors: τα ids & τις κλάσεις. Παρατηρούμε ότι στην παρούσα σελίδα, το μενού είναι το ίδιο όπως στην     
                 σελίδα ebanking.php, αφού πλέον ο χρήστης είναι στη δική του προσωπική σελίδα. -->
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
                
                <div class="menu">
                    
                    <a href="./history.php">Ιστορικό</a> 
                
                </div>                

                <div class="menu menu-selected">
                    
                    <a href="./user.php">Προφίλ Χρήστη</a>
                
                </div>

                <div class="menu">
                    
                    <a href="./statistics.php">Στατιστικά</a>
                
                </div>   
                
            </div>
        
        </div>
        
        <!-- Εδώ ξεκινά το container. Για κάθε σελίδα της άσκησης είναι διαφορετικό & μας επιτρέπει να αλλάζουμε 
             περιεχόμενο χωρίς να αλλοιώνουμε το branding της ιστοσελίδας. Παρακάτω είναι η σελίδα με τα στοιχεία 
             του χρήστη (έμμεση απαίτηση του 2ου ερωτήματος, ώστε να μπορεί ο χρήστης να αλλάξει τα στοιχεία του 
             ή και να διαγράψει το λογαριασμό του). -->
        <div id="container">
            
            <div id="style-container">
                
                <!-- Αυτό χρησιμοποιείται καθαρά για σχεδιαστικούς λόγους, για να αφήσει το απαιτούμενο κενό. -->
                <div class="smallspace">

                </div>
                
                <!-- Εδώ ξεκινά το πλαίσιο που περιλαμβάνει τα στοιχεία. Γίνεται κάποια επιπλέον μορφοποίηση
                     με την ιδιότητα 'style', γιατί είναι μεμονωμένες περιπτώσεις κι εξυπηρετεί καλύτερα η 
                     άμεση εφαρμογή css κανόνων-->
                <div id="transfer-mainbox"> 

                    <p class="regtitle regtitle-extra">Προφίλ Χρήστη</p>
                    
                    <!-- Ξεκινάει το div που περιέχει τη φόρμα με τα στοιχεία του πελάτη: -->
                    <div id="regform" class="registration-form">
                        
                        <form name="registration" action="./scripts/changedata.php" onsubmit="return validateForm()" method="post">

                            <table style="width: 100%"> 

                                <tr style="height: 35px;">

                                    <td style="text-align: right; width: 30%">

                                        <span class="personal-labels">Όνομα:</span>&nbsp;</span>

                                    </td>

                                    <td style="text-align: left">

                                        <span class="personal-info">

                                            <input class="input-readonly" name="name" type="text" value="<?php echo $name; ?>" maxlength="255" style="width: 75%" readonly>

                                        </span>

                                    </td>

                                </tr>

                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="personal-labels">Επώνυμο:</span>&nbsp;</span>

                                    </td>

                                    <td style="text-align: left">

                                        <span class="personal-info">

                                            <input class="input-readonly" name="lastname" type="text" value="<?php echo $lastname; ?>" maxlength="255" style="width: 75%" readonly>

                                        </span>

                                    </td>

                                </tr>
                                
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="personal-labels">Email:</span>&nbsp;</span>

                                    </td>

                                    <td style="text-align: left">

                                        <span class="personal-info">

                                            <input name="email" type="text" value="<?php echo $email; ?>" style="width: 75%">

                                        </span>

                                    </td>

                                </tr>
                                
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="personal-labels"> Παλαιός Κωδικός: </span>&nbsp;</span>

                                    </td>
                                    
                                    <td style="text-align: left">

                                        <span class="personal-info">

                                            <!-- πεδίο παλαιού κωδικού: -->
                                            <input name="oldPassword" type="password" placeholder="Εισάγετε τον παλαιό σας κωδικό" style="width: 75%">

                                        </span>

                                    </td>

                                </tr>
                                
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="personal-labels"> Νέος Κωδικός: </span>&nbsp;</span>

                                    </td>
                                    
                                    <td style="text-align: left">

                                        <span class="personal-info">

                                            <!-- πεδίο νέου κωδικού: -->
                                            <input name="newPassword" type="password" placeholder="Δώστε νέο κωδικό" style="width: 75%">

                                        </span>

                                    </td>

                                </tr>
                                
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="personal-labels">Επιβεβαίωση Νέου Κωδικού: </span>&nbsp;</span>

                                    </td>
                                    
                                    <td style="text-align: left">

                                        <span class="personal-info">

                                            <!-- πεδίο επιβεβαίωσης του νέου κωδικού: -->
                                            <input name="newPassword2" type="password" placeholder="Εισάγετε ξανά τον κωδικό σας" style="width: 75%">

                                        </span>

                                    </td>

                                </tr>
                                
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="personal-labels">Φύλο:</span>&nbsp;

                                    </td>

                                    <td style="text-align: left">

                                        <!-- Επιλογή φύλου-->
                                        <input type="radio" name="sex" value="male" <?php if($sex == "male") { echo "checked"; } ?>> Άντρας
                                        <input type="radio" name="sex" value="female" <?php if($sex == "female") { echo "checked"; } ?>> Γυναίκα
                                        <input type="radio" name="sex" value="other" <?php if($sex == "other") { echo "checked"; } ?>> Άλλο

                                    </td>

                                </tr>
                                
                            
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="personal-labels">Ημερομηνία Γέννησης: </span>&nbsp;

                                    </td>

                                    <td style="text-align: left">
                                        
                                        <input type="date" name="dob" value="<?php echo $dob; ?>">

                                    </td>                                    

                                </tr>
                                
                            
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                    </td>

                                    <td style="text-align: left">
                                        
                                        <!-- Κουμπί υποβολής φόρμας αλλαγής στοιχείων --> 
                                        <p><input name="change" id="change_submit" type="submit" value="Αλλαγή Στοιχείων">
                                        <!-- Κουμπί υποβολής φόρμας διαγραφής χρήστη -->
                                        <input name="delete" id="delete_submit" type="button" value="Διαγραφή Χρήστη">
                                        </p>
            
                                        <!-- Modal Παράθυρο για Προειδοποίηση Διαγραφής Χρήστη: -->
                                        <div id="warning_modal" class="modal">
                                        
                                            <!-- Modal content -->
                                            <div class="modal-content">
                                                
                                                <span class="close">&times;</span>
                                                
                                                <p style="color:red; text-align: center; font-size: 2em; font-weight: bolder">ΠΡΟΣΟΧΗ!</p>
                                                <p style="text-align: center; font-size: 1.5em; font-weight: bolder">Το προφίλ του χρήστη θα διαγραφεί! </p>
                                                <p style="text-align: center;">Σε περίπτωση που έχετε ενεργούς λογαριασμούς, θα διαγραφούν. Παρακαλώ επικοινωνήστε με την τράπεζά μας, 
                                                για διευθέτηση του υπολοίπου του / των λογαριασμού / -ων σας.</p>
                                                
                                            </div>
                                        
                                        </div>
                                        
                                    </td>                                    

                                </tr>

                            </table>
                            
                        </form>
                        
                    </div>

                </div>
             
            </div>            
            
        </div>

        <!-- Εδώ ξεκινάει το υποσέλιδο. Χρησιμοποιώ 3 divs για να περιλάβω το email, τα τηλέφωνα και τα links για τους 
             όρους χρήσης και την πολιτική απορρήτου. Εδώ αξίζει να προσέξουμε ότι τα divs δεν είναι όμοια, αλλά κάθε ένα έχει το δικό του πλάτος. Εδώ εξυπηρετεί να χρησιμοποιήσουμε το style αντί για css, γιατί οι διαφορές είναι πιο πολλές απ' όσες οι ομοιότητες, ώστε να μας επιτρέπει να δημιουργήσουμε κλάσεις. -->
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
        <!-- Να σημειωθεί ότι όταν βάζουμε τον κώδικα μέσα στη σελίδα, προτιμούμε να τον βάζουμε στο τέλος του body, ώστε να μην καθυστερεί το φόρτωμα της σελίδας, για να γίνει compile το js. -->
        <script>
            
            function validateForm() {
                
                /* Δήλωση μεταβλητών  - Εδώ δεν επιτρέπεται να αλλάξουμε όνομα κι επώνυμο, 
                   καθώς οι λογαριασμοί είναι ονομαστικοί */
                var email = document.forms["registration"]["email"].value;
                var oldPassword = document.forms["registration"]["oldPassword"].value;
                var newPassword = document.forms["registration"]["newPassword"].value;
                var newPassword2 = document.forms["registration"]["newPassword2"].value;
                
                /* Έλεγχος αν το email έχει τη μορφή που πρέπει: */
                /* Δήλωση βοηθητικών μεταβλητών  */  
                var mailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    
                if (!mailRegex.test(email)) {
                    alert("Το email δεν είναι σωστό. Παρακαλούμε εισάγετε ένα έγκυρο email.")
                    return false;
                }
                
                if (oldPassword != "") {
                    
                        /* Έλεγχος αν ο κωδικός έχει τουλάχιστον 8 ψηφία: */
                        if (newPassword.length < 8) {
                            alert("Ο κωδικός πρέπει να αποτελείται από τουλάχιστον 8 ψηφία")
                            return false;
                        }
                        
                        /* Έλεγχος αν ο κωδικός και η επιβεβαίωση κωδικού συμφωνούν: */
                        if (newPassword != newPassword2) {
                            alert("Οι κωδικοί δεν ταιριάζουν. Ελέγξτε τους κωδικούς που εισάγατε.")
                            return false;
                        }
                }
            
                
            }
            
            /* Κώδικας διαχείρισης Modal παραθύρου διαγραφής χρήστη: */
            var warningModal = document.getElementById('warning_modal');
            var btn = document.getElementById('delete_submit');
            var close = document.getElementsByClassName('close')[0];
            
            btn.onclick = function() {
                
                warningModal.style.display = "block";
                
            }
            
            close.onclick = function() {
                
                warningModal.style.display = "none";
                location.href = "./scripts/deleteuser.php";
                
            }
            
            window.onclick = function(event) {
                
                if (event.target == warningModal) {
                    
                    warningModal.style.display = "none";
                    location.href = "./scripts/deleteuser.php";
                }
            }
        
        </script>
    
    
    </body>
</html>