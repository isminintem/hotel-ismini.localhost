(function($){
  
    $(document).on('submit','form.favoriteForm', function(e){
        //Stop default form behavior
        e.preventDefault();
        //Get form data
        const formData = $(this).serialize();
        
        console.log(formData);



        //Ajax Request
        $.ajax({
                url:'http://hotel-ismini.localhost/public/ajax/room_Favorite.php',
                type:"POST",
                dataType:"json",
                data: formData
           }).done(function(result) {
            console.log(result);
            
           });    
 
    });
})(jQuery);

