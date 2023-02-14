$.fn.extend({
 trackChanges: function() {
   $(":input",this).on('keyup', function() {
      $(this.form).data("changed", true);
   });
 }
 ,
 isChanged: function() { 
   return this.data("changed"); 
 }
});