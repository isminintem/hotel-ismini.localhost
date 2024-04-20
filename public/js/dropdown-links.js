$(document).ready(function() {
    var dropdownTimer; // Ορίζουμε μια μεταβλητή για τον χρονοδιακόπτη

    // Εμφανίζουμε το dropdown όταν το ποντίκι βρίσκεται εντός του "Προφίλ"
    $('#profile-link').mouseenter(function() {
        clearTimeout(dropdownTimer); // Εξαφανίζουμε τον χρονοδιακόπτη αν υπάρχει
        $('.dropdown-content').slideDown();
    });

    // Κρύβουμε το dropdown όταν ο χρήστης βγαίνει από το "Προφίλ" ή το dropdown
    $('#profile-link, .dropdown-content').mouseleave(function() {
        // Χρησιμοποιούμε έναν χρονοδιακόπτη για να καθυστερήσουμε το κλείσιμο του dropdown
        dropdownTimer = setTimeout(function() {
            $('.dropdown-content').slideUp();
        }, 800); // Καθορίζουμε την καθυστέρηση σε 500 milliseconds
    });

    // Επιτρέπουμε την επιλογή του "Logout" με click
    $('#logout-link').click(function(event) {
        // Προσθέστε εδώ τον κώδικα που ανταποκρίνεται στο κλικ για να εκτελείται η αποσύνδεση του χρήστη
    });
});