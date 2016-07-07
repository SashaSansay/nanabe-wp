jQuery(function($) {
	
	// the upload image button, saves the id and outputs a preview of the image
	var imageFrame;
	$('.meta_box_upload_image_button').click(function(event) {
		event.preventDefault();
		
		var options, attachment;
		
		$self = $(event.target);
		$div = $self.closest('div.meta_box_image');
		
		// if the frame already exists, open it
		if ( imageFrame ) {
			imageFrame.open();
			return;
		}
		
		// set our settings
		imageFrame = wp.media({
			title: 'Choose Image',
			multiple: false,
			library: {
		 		type: 'image'
			},
			button: {
		  		text: 'Выбрать'
			}
		});
		
		// set up our select handler
		imageFrame.on( 'select', function() {
			selection = imageFrame.state().get('selection');
			
			if ( ! selection )
			return;
			
			// loop through the selected files
			selection.each( function( attachment ) {
				console.log(attachment);
				var src = attachment.attributes.sizes.full.url;
				var id = attachment.id;
				
				$div.find('.meta_box_preview_image').attr('src', src);
				$div.find('.meta_box_upload_image').val(id);
			} );
		});
		
		// open the frame
		imageFrame.open();
	});
	
	// the remove image link, removes the image id from the hidden field and replaces the image preview
	$('.meta_box_clear_image_button').click(function() {
		var defaultImage = $(this).parent().siblings('.meta_box_default_image').text();
		$(this).parent().siblings('.meta_box_upload_image').val('');
		$(this).parent().siblings('.meta_box_preview_image').attr('src', defaultImage);
		return false;
	});
	
	// the file image button, saves the id and outputs the file name
	var fileFrame;
	$('.meta_box_upload_file_button').click(function(e) {
		e.preventDefault();
		
		var options, attachment;
		
		$self = $(event.target);
		$div = $self.closest('div.meta_box_file_stuff');
		
		// if the frame already exists, open it
		if ( fileFrame ) {
			fileFrame.open();
			return;
		}
		
		// set our settings
		fileFrame = wp.media({
			title: 'Choose File',
			multiple: false,
			library: {
		 		type: 'file'
			},
			button: {
		  		text: 'Выбрать'
			}
		});
		
		// set up our select handler
		fileFrame.on( 'select', function() {
			selection = fileFrame.state().get('selection');
			
			if ( ! selection )
			return;
			
			// loop through the selected files
			selection.each( function( attachment ) {
				console.log(attachment);
				var src = attachment.attributes.url;
				var id = attachment.id;
				
				$div.find('.meta_box_filename').text(src);
				$div.find('.meta_box_upload_file').val(src);
				$div.find('.meta_box_file').addClass('checked');
			} );
		});
		
		// open the frame
		fileFrame.open();
	});
	
	// the remove image link, removes the image id from the hidden field and replaces the image preview
	$('.meta_box_clear_file_button').click(function() {
		$(this).parent().siblings('.meta_box_upload_file').val('');
		$(this).parent().siblings('.meta_box_filename').text('');
		$(this).parent().siblings('.meta_box_file').removeClass('checked');
		return false;
	});
	
	// function to create an array of input values
	function ids(inputs) {
		var a = [];
		for (var i = 0; i < inputs.length; i++) {
			a.push(inputs[i].val);
		}
		//$("span").text(a.join(" "));
    }
	// repeatable fields
	$('.meta_box_repeatable_add').live('click', function() {
		// clone
		var row = $(this).closest('.meta_box_repeatable').find('tbody tr:last-child');
		var clone = row.clone();
		clone.find('select.chosen').removeAttr('style', '').removeAttr('id', '').removeClass('chzn-done').data('chosen', null).next().remove();
		clone.find('input.regular-text, textarea, select').val('');
		clone.find('input[type=checkbox], input[type=radio]').attr('checked', false);
		row.after(clone);
		// increment name and id
		clone.find('input, textarea, select')
			.attr('name', function(index, name) {
				return name.replace(/(\d+)/, function(fullMatch, n) {
					return Number(n) + 1;
				});
			});
		var arr = [];
		$('input.repeatable_id:text').each(function(){ arr.push($(this).val()); }); 
		clone.find('input.repeatable_id')
			.val(Number(Math.max.apply( Math, arr )) + 1);
		if (!!$.prototype.chosen) {
			clone.find('select.chosen')
				.chosen({allow_single_deselect: true});
		}
		//
		return false;
	});
	
	$('.meta_box_repeatable_remove').live('click', function(){
		$(this).closest('tr').remove();
		return false;
	});
		
	$('.meta_box_repeatable tbody').sortable({
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		handle: '.hndle'
	});
	
	// post_drop_sort	
	$('.sort_list').sortable({
		connectWith: '.sort_list',
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		cancel: '.post_drop_sort_area_name',
		items: 'li:not(.post_drop_sort_area_name)',
        update: function(event, ui) {
			var result = $(this).sortable('toArray');
			var thisID = $(this).attr('id');
			$('.store-' + thisID).val(result) 
		}
    });

	$('.sort_list').disableSelection();

	// turn select boxes into something magical
	if (!!$.prototype.chosen)
		$('.chosen').chosen({ allow_single_deselect: true });

	$('[name="naba_color-pallet"]').on('change', function() {
		var val = $('input[name="naba_color-pallet"]:checked').val();

		var vals = val.split(',');

		$('.billboard-preview').css('background-color',vals[0]);
		$('svg','.billboard-preview').css('color',vals[1]);
		$('.billboard-preview').css('color',vals[2]);
	});
	if($('[name="naba_color-pallet"]').length>0){
		try{
			var val = $('input[name="naba_color-pallet"]:checked').val();

			var vals = val.split(',');

			$('.billboard-preview').css('background-color',vals[0]);
			$('svg','.billboard-preview').css('color',vals[1]);
			$('.billboard-preview').css('color',vals[2]);

		}catch(ex){

		}
	}

	var markers = [];
	var maps = [];
	var fields = [];

	$('.map').each(function(){
		var index = $('.map').index($(this));
		var parent = $(this).closest('.map-place-wrap');
		fields[index] = $('input',parent);
		var mapOptions = {
			center: new google.maps.LatLng(53.206570, 50.111386),
			zoom: 13,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.DEFAULT,
			},
			disableDoubleClickZoom: true,
			mapTypeControl: true,
			mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
			},
			scaleControl: true,
			scrollwheel: true,
			panControl: true,
			streetViewControl: true,
			draggable : true,
			overviewMapControl: true,
			overviewMapControlOptions: {
				opened: false,
			},
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			styles: [{"featureType":"all","elementType":"geometry","stylers":[{"lightness":"26"},{"gamma":"1.14"},{"saturation":"38"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#c7c7c7"}]}]
		}
		var mapElement = $(this).get(0);
		maps[index] = new google.maps.Map(mapElement, mapOptions);

		//maps[index] = map;
        //
		google.maps.event.addListener(maps[index], 'click', function(event) {
			placeMarker(event.latLng);
		});

		function placeMarker(location) {
			if(markers[index]){
				markers[index].setMap(null);
			}
			markers[index] = new google.maps.Marker({
				position: location,
				map: maps[index],
				draggable: true
			});

			updateField(markers[index].getPosition().lat(),markers[index].getPosition().lng());

			google.maps.event.addListener(markers[index], 'dragend', function() {
               	//console.log();
				updateField(this.getPosition().lat(),this.getPosition().lng())
            });
		}

		if(fields[index].val()!=""){
			var val = fields[index].val().split(',');
			placeMarker(new google.maps.LatLng(parseFloat(val[0]), parseFloat(val[1])));
		}

		function updateField(lat, lng){
			fields[index].val(lat+ ','+lng);
		}

		fields[index].focusout(function(){
			try{
				var val = $(this).val().split(',');
				var lt = val[0];
				var ln = val[1];
				placeMarker(new google.maps.LatLng(lt, ln))
			}catch (ex){

			}
		});
	})


	$('[data-mask]').each(function(){
		$(this).inputmask({mask: $(this).data('mask')});
	});
});