jQuery(document).ready(function() {
  jQuery('.toggle-nav').click(function(e) {
      jQuery('nav.primary-navigation ul').slideToggle(500);

      e.preventDefault();
  });
   
});