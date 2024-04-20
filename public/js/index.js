document.getElementById("myForm").addEventListener("submit", function(event) {
  const selectedCity = document.getElementById("location").value;
  const selectedRoom = document.getElementById("room").value;
  const selectedCheckInDate = document.getElementById("datepicker-start").value;
  const selectedCheckOutDate = document.getElementById("datepicker-end").value;

  // Check if any required field is empty or if selected dates are invalid
  if (selectedCity === "" || selectedRoom === "" || selectedCheckInDate === "" || selectedCheckOutDate === "") {
      alert("Please fill out all required fields.");
      event.preventDefault(); // Prevent the form from submitting
      return;
  }

  // Convert selected dates to Date objects for comparison
  const checkInDate = new Date(selectedCheckInDate);
  const checkOutDate = new Date(selectedCheckOutDate);
  const currentDate = new Date();

  // Check if selected check-in date is before current date
  if (checkInDate < currentDate) {
      alert("Please select a check-in date that is not in the past.");
      event.preventDefault(); // Prevent the form from submitting
      return; // Exit the function
  }

  // Check if selected check-out date is before current date
  if (checkOutDate < currentDate) {
      alert("Please select a check-out date that is not in the past.");
      event.preventDefault(); // Prevent the form from submitting
      return; // Exit the function
  }

  // Check if selected check-out date is before selected check-in date
  if (checkOutDate < checkInDate) {
      alert("Check-out date must be after check-in date.");
      event.preventDefault(); // Prevent the form from submitting
      return; // Exit the function
  }

});

// Add event listeners to datepicker fields for validation
document.getElementById("datepicker-start").addEventListener("change", function() {
  const selectedCheckInDate = document.getElementById("datepicker-start").value;
  const checkInDate = new Date(selectedCheckInDate);
  const currentDate = new Date();
  
  if (checkInDate < currentDate) {
      alert("Please select a check-in date that is not in the past.");
      document.getElementById("datepicker-start").value = ""; // Clear the invalid date
  }
});

document.getElementById("datepicker-end").addEventListener("change", function() {
  const selectedCheckOutDate = document.getElementById("datepicker-end").value;
  const checkOutDate = new Date(selectedCheckOutDate);
  const currentDate = new Date();
  
  if (checkOutDate < currentDate) {
      alert("Please select a check-out date that is not in the past.");
      document.getElementById("datepicker-end").value = ""; // Clear the invalid date
  }

 

});
















