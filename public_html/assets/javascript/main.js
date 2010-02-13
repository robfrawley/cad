window.addEvent('domready', function() {

  nbForm = $('nbForm');
  //console.log(nbForm);

  fV = new FormValidator.Inline('nbForm', {
    
    errorPrefix: "&uarr; ",
    onFormValidate: function(passed, form, event) {
      if(passed) {

        //formC = $('form');
        
        $('form').addClass('ajax-loading');
        //form.empty().addClass('ajax-loading');

    		$('nbForm').set('send', {onComplete: function(response) { 
    			$('form').fade('out');
    			showCompletedTxt = function() { 
      			$('form').empty().set('html', '<p class="completed-text">You have been signed up for the Creative Arts Guide Newsletter and entered into our Website Early Access program. Please check your e-mail address for a verification e-mail to complete this process.</p>');
    			  $('form').fade('in'); 
    			}
          showCompletedTxt.delay(750, this);
    		}});
    		$('nbForm').send();

        
      } else {
        return;
      }
    }
    
  });

	$('nbForm').addEvent('submit', function(e) {
    e.stop();
	});

});