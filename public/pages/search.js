(function($){
  
    $(document).on('submit','form.searchForm', function(e){
        //Stop default form behavior
        e.preventDefault();
        //Get form data
        const formData=$(this).serialize();
      



        //Ajax Request
        $.ajax(
           'http://hotel-ismini.localhost/public/ajax/search_results.php',
           {
                type:"GET",
                dataType:"html",
                data: formData
           }).done(function(result) {
            //clear results container
            $('#searchResults').html('');
            //append results container
            $('#searchResults').append(result);
           // Push url State
           history.pushState({},'','http://hotel-ismini.localhost/public/html/search.php?'+formData);
            
           });    
 
    });
})(jQuery);