$(document).ready(function() {
    // Κώδικας για την εμφάνιση/απόκρυψη του dropdown
    var dropdownTimer;

    $('#profile-link').mouseenter(function() {
        clearTimeout(dropdownTimer);
        $('.dropdown-content').slideDown();
    });

    $('#profile-link, .dropdown-content').mouseleave(function() {
        dropdownTimer = setTimeout(function() {
            $('.dropdown-content').slideUp();
        }, 800);
    });

    // Κώδικας για την αποσύνδεση χρήστη
    $('#logout-link').click(function(event) {
        event.preventDefault(); // Αποτρέπουμε την προεπιλεγμένη συμπεριφορά του συνδέσμου
        // Εδώ μπορείτε να προσθέσετε τον κώδικα που ανταποκρίνεται στο κλικ για να εκτελείται η αποσύνδεση του χρήστη
        // Παράδειγμα: window.location.href = 'logout.php';
    });
});