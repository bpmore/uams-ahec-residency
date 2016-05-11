jQuery(document).ready(function($) { 


// Show/hide Search Box
    
    jQuery(".toggle-search").click(function() {
        $(".search-wrap").slideToggle('fast', function(){
            $(".toggle-search").toggleClass('active');
        });
    
    });

});