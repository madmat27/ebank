<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="iBank: Η τράπεζά σας στις υπηρεσίες σας">
        <meta name="author" content="Mariana S. Mazi">
        <meta name="keywords" content="iBank, ebanking, ιδιώτες">

        <title>iBank | Φόρμα Εγγραφής Χρήστη</title>

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
                
                <!-- Στο παρακάτω div δημιουργούμε έναν πίνακα που να περιλαμβάνει τις 4 επιλογές που υπάρχουν στη σελίδα        μας: Τη "Βοήθεια", την "Αναζήτηση", την "Χρήστης" και την "Αποσύνδεση".  -->
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
                            
                            <td style="width: 100px;">
                                
                                <!-- Κρύβουμε τις επιλογές "Χρήστης" και "Αποσύνδεση" γιατί ακόμα δεν έχουμε κάνει εγγραφή. -->
                                <div id="user" style="display: none">
                                    <span style="font-size: 22px">
                                        <i class="fas fa-user"></i>
                                    </span>
                                
                                    
                                    &nbsp;<a href="#">Χρήστης</a>

                                </div>
                                
                            </td>
                            
                            <td>
                                
                                <div id="logout" style="display: none">

                                    <span style="font-size: 22px; ">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </span>

                                    <a href="#">Αποσύνδεση</a>

                                </div>
                                
                            </td>
                            
                        </tr>
                        
                    </table>
                    
                </div>

            </div>
            
            <!-- Το παρακάτω div αποτελεί το μενού που είναι εμφανές σε όλες τις σελίδες. Η μορφοποίηση γίνεται με τους css      selectors: τα ids & τις κλάσεις. Παρατηρούμε ότι στην παρούσα σελίδα, το μενού είναι το ίδιο όπως στην     
                 αρχική σελίδα του e-banking, καθώς ο χρήστης δεν έχει μπει ακόμα στη δική του προσωπική σελίδα. -->
            <div id="navigation">
                <div class="menu">
                    
                    <a href="./index.php">Αρχική</a>
                
                </div>
                
                <div class="menu">
                    
                    <a href="#">Ιδιώτες</a>
                
                </div>

                <div class="menu">
                    
                    <a href="#">Επιχειρήσεις</a>
                
                </div>
                
                <div class="menu">
                    
                    <a href="#">Private Banking</a>
                
                </div>
                
                <div class="menu">
                    
                    <a href="#">Όμιλος iBank</a>
                
                </div>
                
                <div class="menu">
                    
                    <a href="#">Mi-Bank</a> 
                
                </div>                

                <div class="menu">
                    
                    <a href="#">Ασφάλιση</a>
                
                </div>
                
            </div>
        
        </div>
        
        <!-- Εδώ ξεκινά το container. Για κάθε σελίδα της άσκησης είναι διαφορετικό & μας επιτρέπει να αλλάζουμε 
             περιεχόμενο χωρίς να αλλοιώνουμε το branding της ιστοσελίδας. Παρακάτω είναι το περιεχόμενο της φόρμας εγγραφής (έμμεση απαίτηση της ερώτησης 2 της εργασίας). -->
        <div id="container">
            
            <div id="style-container">
                
                <!-- Αυτό χρησιμοποιείται καθαρά για σχεδιαστικούς λόγους, για να αφήσει το απαιτούμενο κενό. -->
                <div class="smallspace">

                </div>
                
                <!-- Εδώ ξεκινά το πλαίσιο που περιλαμβάνει τη φόρμα εγγραφής. Γίνεται κάποια επιπλέον μορφοποίηση
                     με την ιδιότητα 'style', γιατί είναι μεμονωμένες περιπτώσεις κι εξυπηρετεί καλύτερα η άμεση εφαρμογή css κανόνων-->
                <div id="transfer-mainbox"> 

                    <p class="regtitle regtitle-extra">Φόρμα Εγγραφής Χρήστη</p>
                    
                    <!-- Ξεκινάει το div που περιέχει τη φόρμα εγγραφής: -->
                    <div id="regform" class="registration-form">
                        
                        <form name = "registration" action="./scripts/createuser.php" onsubmit="return validateForm()" method="post">

                            <table style="width: 100%"> 

                                <tr style="height: 35px;">

                                    <td style="text-align: right; width: 30%">

                                        <span class="personal-labels">Όνομα:</span>&nbsp;<span class="star">*</span>

                                    </td>

                                    <td style="text-align: left">

                                        <span class="personal-info">

                                            <input name="name" type="text" placeholder="Δώστε το όνομά σας" maxlength="255" style="width: 75%">

                                        </span>

                                    </td>

                                </tr>

                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="personal-labels">Επώνυμο:</span>&nbsp;<span class="star">*</span>

                                    </td>

                                    <td style="text-align: left">

                                        <span class="personal-info">

                                            <input name="lastname" type="text" placeholder="Δώστε το επώνυμό σας" maxlength="255" style="width: 75%">

                                        </span>

                                    </td>

                                </tr>
                                
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="personal-labels">Email:</span>&nbsp;<span class="star">*</span>

                                    </td>

                                    <td style="text-align: left">

                                        <span class="personal-info">

                                            <input name="email" type="text" placeholder="Δώστε το email σας" style="width: 75%">

                                        </span>

                                    </td>

                                </tr>
                                
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="personal-labels">Κωδικός: </span>&nbsp;<span class="star">*</span>

                                    </td>
                                    
                                    <td style="text-align: left">

                                        <span class="personal-info">

                                            <!-- πεδίο κωδικού: -->
                                            <input name="password" type="password" placeholder="Δώστε επιθυμητό κωδικό" style="width: 75%">

                                        </span>

                                    </td>

                                </tr>
                                
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="personal-labels">Επιβεβαίωση Κωδικού: </span>&nbsp;<span class="star">*</span>

                                    </td>
                                    
                                    <td style="text-align: left">

                                        <span class="personal-info">

                                            <!-- πεδίο επιβεβαίωσης του κωδικού: -->
                                            <input name="password2" type="password" placeholder="Εισάγετε ξανά τον κωδικό σας" style="width: 75%">

                                        </span>

                                    </td>

                                </tr>
                                
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="personal-labels">Φύλο:</span>&nbsp;

                                    </td>

                                    <td style="text-align: left">

                                        <!-- Επιλογή φύλου-->
                                        <input type="radio" name="sex" value="male"> Άντρας
                                        <input type="radio" name="sex" value="female"> Γυναίκα
                                        <input type="radio" name="sex" value="other"> Άλλο

                                    </td>

                                </tr>
                                
                            
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                        <span class="personal-labels">Ημερομηνία Γέννησης: </span>&nbsp;

                                    </td>

                                    <td style="text-align: left">
                                        
                                        <input type="date" name="dob">

                                    </td>                                    

                                </tr>
                                
                            
                                <tr style="height: 35px;">

                                    <td style="text-align: right">

                                    </td>

                                    <td style="text-align: left">
                                        
                                        <!-- Κουμπί υποβολής φόρμας --> 
                                        <p><input style="width: 215px; height: 35px;" name="submit" id="trstion_submit" type="submit" value="Εγγραφή"></p>

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
                
                /* Δήλωση μεταβλητών */
                var name = document.forms["registration"]["name"].value;
                var lname = document.forms["registration"]["lastname"].value;
                var email = document.forms["registration"]["email"].value;
                var password = document.forms["registration"]["password"].value;
                var password2 = document.forms["registration"]["password2"].value;
                
                
                /* Έλεγχος αν τα υποχρεωτικά πεδία είναι κενά: */ 
                if (name == "") {
                    alert("Παρακαλώ δώστε το όνομά σας");
                    return false;
                }
                
                if (lname == "") {
                    alert("Παρακαλώ δώστε το επώνυμό σας");
                    return false;
                }
                
                if (email == "") {
                    alert("Παρακαλώ δώστε το email σας");
                    return false;
                }
                
                if (password == "") {
                    alert("Παρακαλώ εισάγετε έναν κωδικό. Ο κωδικός πρέπει να αποτελείται από 8 τουλάχιστον χαρακτήρες");
                    return false;
                }
                
                if (password2 == "") {
                    alert("Παρακαλώ εισάγετε τον επιθυμητό κωδικό ξανά.");
                    return false;
                } 
                
                /* Έλεγχος αν το όνομα και το επώνυμο περιέχουν άλλους χαρακτήρες εκτός από γράμματα: */
                /* Δήλωση βοηθητικών μεταβλητών - προσθήκη ελληνικών χαρακτήρων στο Regex */
                var checkname = !/[^a-zα-ωάέίύήόώ-]/i.test(name);
                var checklname = !/[^a-zα-ωάέίύήόώ-]/i.test(lname);
                
                if (!checkname) {
                    alert("Το όνομα επιτρέπεται να έχει μόνο γράμματα. Παρακαλώ διορθώστε το όνομά σας.");
                    return false;
                }
                
                if (!checklname) {
                    alert("Το επίθετο επιτρέπεται να έχει μόνο γράμματα. Παρακαλώ διορθώστε το επώνυμό σας.");
                    return false;
                }
                
                /* Έλεγχος αν το email έχει τη μορφή που πρέπει: */
                /* Δήλωση βοηθητικών μεταβλητών  */  
                var mailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    
                if (!mailRegex.test(email)) {
                    alert("Το email δεν είναι σωστό. Παρακαλούμε εισάγετε ένα έγκυρο email.")
                    return false;
                }
                
                /* Έλεγχος αν ο κωδικός έχει τουλάχιστον 8 ψηφία: */
                /* Δήλωση βοηθητικών μεταβλητών */
                if (password.length < 8) {
                    alert("Ο κωδικός πρέπει να αποτελείται από τουλάχιστον 8 ψηφία")
                    return false;
                }
                
                /* Έλεγχος αν ο κωδικός και η επιβεβαίωση κωδικού συμφωνούν: */
                if (password != password2) {
                    alert("Οι κωδικοί δεν ταιριάζουν. Ελέγξτε τους κωδικούς που εισάγατε.")
                    return false;
                }
            
                
            }
        
        </script>
    
    
    </body>
</html>