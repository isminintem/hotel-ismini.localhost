(function($){
  
    $(document).on('submit','form.reviewForm', function(e){
        //Stop default form behavior
        e.preventDefault();
        //Get form data
        const formData = $(this).serialize();
        
        
        console.log(formData);



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
