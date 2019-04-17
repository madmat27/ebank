<?php

    /* Με το φόρτωμα της σελίδας, κλείνουμε οποιοδήποτε παλαιότερο session υπάρχει ανοιχτό,
       αναγκάζοντας τον χρήστη να ξανακάνει login, διασφαλίζοντας καλύτερα το λογαριασμό του 
       χρήστη. */

       session_start();
       
    if (isset($_SESSION['user_id'])) {
    
        session_unset();
        session_destroy();
        
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

        <title>iBank: My Bank!</title>

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
                <a href="./index.php"><img id="logo" src="./images/logo.png"></a>
                
                <!-- Στο παρακάτω div δημιουργούμε έναν πίνακα που να περιλαμβάνει τις 4 επιλογές που υπάρχουν στη σελίδα μας:
                     Τη "Βοήθεια", την "Αναζήτηση", την "Χρήστης" και την "Αποσύνδεση". Οι 2 πρώτες εμφανίζονται σε όλες τις σελίδες,
                     ενώ οι 2 τελευταίες πρέπει να εμφανίζονται μόνο στις σελίδες ebanking & μεταφοράς χρημάτων. Στην τρέχουσα σελίδα, 
                     εφόσον δεν πρέπει να φαίνονται, τις έχουμε κρύψει με την ιδιότητα "display: none". -->
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
            
            <!-- Το παρακάτω div αποτελεί το μενού που είναι εμφανές σε όλες τις σελίδες. Η μορφοποίηση γίνεται με τους css selectors: 
                 τα ids & τις κλάσεις. -->
            <div id="navigation">
                <div class="menu menu-selected">
                    
                    <a href="index.php">Αρχική</a>
                
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
        
        <!-- Εδώ ξεκινά το container. Για κάθε σελίδα της άσκησης είναι διαφορετικό & μας επιτρέπει να αλλάζουμε περιεχόμενο
             χωρίς να αλλοιώνουμε το branding της ιστοσελίδας. Παρακάτω είναι το περιεχόμενο της index (Αρχικής). -->
        <div id="container">
            
            <!-- Αυτό χρησιμοποιείται καθαρά για σχεδιαστικούς λόγους, για να αφήσει το απαιτούμενο κενό. -->
            <div class="space">
            
            </div>
            
            <!-- Το κομμάτι αυτό είναι ένα μικρό slideshow που εναλλάσει 3 φωτογραφίες. Έχει το δικό του css, ενώ το animation 
                 γίνεται με javascript. -->
            <div id="ads" style="max-width: 475px;">
                
                <img class="slideshow" src="./images/reward.jpg" style="width:100%">
                <img class="slideshow" src="./images/family.jpg" style="width:100%">
                <img class="slideshow" src="./images/business.jpg" style="width:100%">            
                
            </div>
            
            <!-- Ξεκινά η φόρμα σύνδεσης του πελάτη στο σύστημα e-banking -->
            <div id="login" style="padding-left: 30px; padding-right: 30px; ">
                
                <form name="login" action="./scripts/authenticate.php" method="post">
                    
                    <p style="font-weight: 900; font-size: 30px; margin-top: 5px; margin-bottom: 0px;">Είσοδος στο ebanking</p>

                    <p><input style="width: 415px; height: 25px;" name="username" id="username" type="text" placeholder="Όνομα χρήστη (Email)" required></p>

                    <p><input style="width: 415px; height: 25px;" name="password" id="password" type="password" placeholder="Κωδικός χρήστη" required></p>

                    <p><input style="width: 418px; height: 35px;" name="submit" id="submit" type="submit" value="ΕΙΣΟΔΟΣ ΣΤΟ EBANKING"></p>

                    <p><span id="forgot"><a href="#">Ξεχάσατε τα στοιχεία σύνδεσης;</a> </span></p>
                
                </form>
                
            </div>
            
            <div id="online-reg" style="padding-left: 30px; padding-right: 30px;">
            
                <p style="font-size: 26px; margin-top: 2px; margin-bottom: 0px; text-align: center"><a href="./register.php">Οnline Εγγραφή στο E-Banking</a></p>
            
            </div>
            
            <!-- Αυτό χρησιμοποιείται καθαρά για σχεδιαστικούς λόγους, για να αφήσει το απαιτούμενο κενό. -->
            <div class="largespace"></div>
            
            <!-- Eδώ έχουμε το κομμάτι των ανακοινώσεων. -->
            <div id="announce-head">
                
                <p>Ανακοινώσεις</p>
                
            </div>
                
            <!-- Είναι ένα κεντρικό div για τις φωτογραφίες και τα κείμενα των ανακοινώσεων που τριχοτομείται σε μικρότερα κομμάτια. -->
            <div id="announcements">
                
                <!-- Κάθε κομμάτι από τα παρακάτω φιλοξενεί μια φωτογραφία κι ένα κείμενο. Επειδή και τα 3 έχουν κοινά χαρακτηριστικά, 
                     χρησιμοποιηούμε την κλάση "announbox", για να εφαρμόσουμε κοινό στυλ σε όλα. Αντίστοιχα, αν κι εφόσον χρειάζεται 
                     κάποιο κομμάτι επιμέρους τροποποίηση, τότε επεμβαίνουμε με το id selector. -->
                <div id="announ1" class="announbox">
                    
                    <img id="announ1-img" class="announ-img" src=./images/selfemployeed.jpg>
                    
                    <div id="announ1-text" class="announ-txt"> 
                        
                        <span id="title1"><a href="#">Για ελεύθερους επαγγελματίες <br></a> </span>
                        
                        <span id="text1" class="textbox">Με το e-Banking της iBank διαχειρίζεστε τις συναλλαγές της επιχείρησής σας online. Διαχειριστείτε την επιχείρησή σας αποδοτικά. </span>
                        
                    </div>
                                
                </div>
                
                <div id="announ2" class="announbox">
                   
                    <img id="announ2-img" class="announ-img" src="./images/creditcard.jpg">
                    
                    <div id="announ2-text" class="announ-txt">
                    
                        <span id="title2"><a href="#">e-Banking &amp; Κάρτες <br></a> </span>
                        
                        <span id="text2" class="textbox">Με e-Banking κάνετε πάνω από 400 συναλλαγές γρήγορα, με ασφάλεια και μικρότερο κόστος. Διαχειρίζεστε τα προϊόντα σας 24 ώρες το 24ωρο από παντού.</span>
                        
                    </div>
                                
                </div>
                
                <div id="announ3" class="announbox">
                   
                    <img id="announ3-img" class="announ-img" src="./images/graduate.jpg">
                    
                    <div id="announ3-text" class="announ-txt">
                    
                        <span id="title3"><a href="#">Για φοιτητές &amp; σπουδαστές<br></a> </span>
                        
                        <span id="text3" class="textbox">Σπουδάζετε, αρχίζετε την πρακτική σας, μετακομίζετε σε άλλη πόλη, μένετε μόνοι για πρώτη φορά ή όλα μαζί. Για τη φοιτητική ζωή έχουμε τη λύση που σας κάνει. </span>
                        
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
            
            <div style="display:none"><img src="./index.php"></img></div>
        
        </div>
        
        <!-- Javascript για την εναλλαγή του Slideshow -->
        <!-- Ορίζουμε μια μεταβλητή με το όνομα myIndex που της αναθέτουμε την τιμή 0 και δημιουργούμε μια μέθοδο που λέγεται carousel 
             κι αναλαμβάνει την εναλλαγή. 
             Η μέθοδος λέει ότι για κάθε εικόνα που υπάρχει με το class "slideshow", θα αλλάζει το display από none (που σημαίνει ότι 
             δεν εμφανίζεται) σε block (που σημαίνει ότι είναι ορατή) και θα αυξάνει έναν δείκτη κατά 1, ώστε να μην είναι όλες
             οι φωτογραφίες εμφανείς ή κρυμμένες. Ο βρόγχος που κάνει την αλλαγή, την εκτελεί 4000 ms / 4 δευτερόλεπτα. -->
        <!-- Να σημειωθεί ότι όταν βάζουμε τον κώδικα μέσα στη σελίδα, προτιμούμε να τον βάζουμε στο τέλος του body, ώστε να μην καθυστερεί
             το φόρτωμα της σελίδας, για να γίνει compile το js. -->
        <script>
        var myIndex = 0;
        carousel();

        function carousel() {
          var i;
          var x = document.getElementsByClassName("slideshow");
          for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
          }
          myIndex++;
          if (myIndex > x.length) {myIndex = 1}    
          x[myIndex-1].style.display = "block";  
          setTimeout(carousel, 4000); // Αλλαγή κάθε 4 δευτερόλεπτα
        }
        </script>
    
    
    </body>
</html>