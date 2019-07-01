jQuery(function($) {
	var	api_key = 's5Jz512hpDOsa3fKjIKxf3s4TgDdhT3uobadqv12';
	var url = "https://api.nasa.gov/planetary/apod?api_key=" + api_key + "&count=5";

	$.ajax({
	  url: url,
	  method: 'GET',
	}).done(function(data) {

	  // get DOM node to be parent of child list nodes
	  var $data = $('#nasaPostList');

	  // iterate through each object in JSON array
		  $.each(data, function (index, value) {

		    // create the container div node
		    //var $div = $('<div/>',{ "class": "nasa-images-flip-card" });

		    var $div = $('<div/>',{ "class": "nasa-images-flip-card-inner" });

		      // append list item node to list node
		      if (value) {
			
			      if(value.media_type = "image") {
			      	$div.append('<div class="nasa-images-flip-card-front"><img src="' + value.url + '" style="width:300px;height:300px;"/></div>');
			      }

			      if (value.title) {
			      	$div.append('<div class="nasa-images-info title">Title: ' + value.title + '</div>' );
			      }

			      if (value.date) {
			      	$div.append('<div class="nasa-images-info date">Date: ' + value.date + '</div>' );
			      }

			      if (value.copyright) {
			      	$div.append('<div class="nasa-images-info copyright">Image Credits: ' + value.copyright + '</div>' );
			      }
			      else {
			      	$div.append('<div class="nasa-images-info copyright">Image Credits: Public Domain</div>' );
  					}
		    }

		    // append node to parent node
		    $data.append($div);
		  });

		  $( ".nasa-images-flip-card-inner" ).wrap( '<div class="nasa-images-flip-card" />');

			$(".nasa-images-info").map(function() {
	    if (!$(this).prev().hasClass("nasa-images-info")) {
	        return $(this).nextUntil(":not(.nasa-images-info)").andSelf();
	    }
			}).wrap("<div class='nasa-images-flip-card-back' />");

	}).fail(function(error) {
	  console.error(error);
	});
});
