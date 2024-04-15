(function($){
  
    $(document).on('submit','form.reviewForm', function(e){
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
            if (result.status){
                $('input[name=is_favorite]').val(result.is_favorite ? 1 : 0);
            }else{
                $('.fav_star.star').toggleClass('selected',!result.is_favorite);
            }
            
           });    
 
    });
})(jQuery);
