(function($){
  
    $(document).on('submit','form.reviewForm', function(e){
        //Stop default form behavior
        e.preventDefault();
        //Get form data
        const formData = $(this).serialize();

     // Check if comment and rating are provided
        const comment = $(this).find('textarea[name="comment"]').val();
        const rating = $(this).find('input[name="rating"]').val();
        
        if(comment.trim() === '' || rating.trim() === '') {
            alert('Please provide both a comment and a rating.');
            return; // Stop execution if comment or rating is missing
        }
        
        // console.log(formData);



        //Ajax Request
        $.ajax({
                url:'http://hotel-ismini.localhost/public/ajax/room_review.php',
                type:"POST",
                dataType:"html",
                data: formData
           }).done(function(result) {
            //Append review to list
            $('#room-reviews-container').html(result);

            //Reset review Form
            $('form.reviewForm').trigger('reset');
            
            }).error()
              .always();
 
    });
})(jQuery);
