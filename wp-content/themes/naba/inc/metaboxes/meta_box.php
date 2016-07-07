<?php

// metaboxes directory constant
define( 'CUSTOM_METABOXES_DIR', get_template_directory_uri() . '/inc/metaboxes' );

/**
 * recives data about a form field and spits out the proper html
 *
 * @param	array					$field			array with various bits of information about the field
 * @param	string|int|bool|array	$meta			the saved data for this field
 * @param	array					$repeatable		if is this for a repeatable field, contains parant id and the current integar
 *
 * @return	string									html for the field
 */
function custom_meta_box_field( $field, $meta = null, $repeatable = null ) {
	if ( ! ( $field || is_array( $field ) ) )
		return;
	
	// get field data
	$type = isset( $field['type'] ) ? $field['type'] : null;
	$label = isset( $field['label'] ) ? $field['label'] : null;
	$desc = isset( $field['desc'] ) ? '<span class="description">' . $field['desc'] . '</span>' : null;
	$place = isset( $field['place'] ) ? $field['place'] : null;
	$size = isset( $field['size'] ) ? $field['size'] : null;
	$post_type = isset( $field['post_type'] ) ? $field['post_type'] : null;
	$options = isset( $field['options'] ) ? $field['options'] : null;
	$settings = isset( $field['settings'] ) ? $field['settings'] : null;
	$repeatable_fields = isset( $field['repeatable_fields'] ) ? $field['repeatable_fields'] : null;
	
	// the id and name for each field
	$id = $name = isset( $field['id'] ) ? $field['id'] : null;
	if ( $repeatable ) {
		$name = $repeatable[0] . '[' . $repeatable[1] . '][' . $id .']';
		$id = $repeatable[0] . '_' . $repeatable[1] . '_' . $id;
	}
	switch( $type ) {
		// basic
		case 'text':
		case 'tel':
		case 'email':
		default:
			echo '<input ';
			if(isset($field['mask']))
				echo 'data-mask="'.$field['mask'].'"';
		echo' type="' . $type . '" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . esc_attr( $meta ) . '" class="regular-text" size="30" />
					<br />' . $desc;
		break;
		case 'url':
			echo '<input type="' . $type . '" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . esc_url( $meta ) . '" class="regular-text" size="30" />
					<br />' . $desc;
		break;
		case 'number':
			echo '<input type="' . $type . '" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . intval( $meta ) . '" class="regular-text" size="30" />
					<br />' . $desc;
		break;
		// textarea
		case 'textarea':
			echo '<textarea name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" cols="60" rows="4">' . esc_textarea( $meta ) . '</textarea>
					<br />' . $desc;
		break;
		// editor
		case 'editor':
			echo wp_editor( $meta, $id, $settings ) . '<br />' . $desc;
		break;
		// checkbox
		case 'checkbox':
			echo '<input type="checkbox" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" ' . checked( $meta, true, false ) . ' value="1" />
					<label for="' . esc_attr( $id ) . '">' . $desc . '</label>';
		break;
		// select, chosen
		case 'select':
		case 'chosen':
			echo '<select name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '"' , $type == 'chosen' ? ' class="chosen"' : '' , isset( $multiple ) && $multiple == true ? ' multiple="multiple"' : '', isset( $option['required'] ) && $option['required'] == true ? ' required="required"' : '' , '>
					<option value="">Выбрать</option>'; // Select One
			foreach ( $options as $option )
				echo '<option' . selected( $meta, $option['value'], false ) . ' value="' . $option['value'] . '">' . $option['label'] . '</option>';
			echo '</select><br />' . $desc;
		break;
		// radio
		case 'radio':
			echo '<ul class="meta_box_items">';
			foreach ( $options as $option )
				echo '<li><input type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '-' . $option['value'] . '" value="' . $option['value'] . '" ' . checked( $meta, $option['value'], false ) . ' />
						<label for="' . esc_attr( $id ) . '-' . $option['value'] . '">' . $option['label'] . '</label></li>';
			echo '</ul>' . $desc;
		break;
		// checkbox_group
		case 'checkbox_group':
			echo '<ul class="meta_box_items">';
			foreach ( $options as $option )
				echo '<li><input type="checkbox" value="' . $option['value'] . '" name="' . esc_attr( $name ) . '[]" id="' . esc_attr( $id ) . '-' . $option['value'] . '"' , is_array( $meta ) && in_array( $option['value'], $meta ) ? ' checked="checked"' : '' , ' /> 
						<label for="' . esc_attr( $id ) . '-' . $option['value'] . '">' . $option['label'] . '</label></li>';
			echo '</ul>' . $desc;
		break;
		// color
		case 'color':
			$meta = $meta ? $meta : '#';
			echo '<input type="text" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . $meta . '" size="10" />
				<br />' . $desc;
			echo '<div id="colorpicker-' . esc_attr( $id ) . '"></div>
				<script type="text/javascript">
				jQuery(function(jQuery) {
					jQuery("#colorpicker-' . esc_attr( $id ) . '").hide();
					jQuery("#colorpicker-' . esc_attr( $id ) . '").farbtastic("#' . esc_attr( $id ) . '");
					jQuery("#' . esc_attr( $id ) . '").bind("blur", function() { jQuery("#colorpicker-' . esc_attr( $id ) . '").slideToggle(); } );
					jQuery("#' . esc_attr( $id ) . '").bind("focus", function() { jQuery("#colorpicker-' . esc_attr( $id ) . '").slideToggle(); } );
				});
				</script>';
		break;
		// post_select, post_chosen
		case 'post_select':
		case 'post_list':
		case 'post_chosen':
			echo '<select data-placeholder="Select One" name="' . esc_attr( $name ) . '[]" id="' . esc_attr( $id ) . '"' , $type == 'post_chosen' ? ' class="chosen"' : '' , isset( $multiple ) && $multiple == true ? ' multiple="multiple"' : '' , '>
					<option value=""></option>'; // Select One
			$posts = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'name', 'order' => 'ASC' ) );
			foreach ( $posts as $item )
				echo '<option value="' . $item->ID . '"' . selected( is_array( $meta ) && in_array( $item->ID, $meta ), true, false ) . '>' . $item->post_title . '</option>';
			$post_type_object = get_post_type_object( $post_type );
			echo '</select> &nbsp;<span class="description"><a href="' . admin_url( 'edit.php?post_type=' . $post_type . '">Manage ' . $post_type_object->label ) . '</a></span><br />' . $desc;
		break;
		case 'color-pallet':
			echo '<div class="color-pallete-wrap"><ul class="meta_box_items color-pallete">';
			$k = 0;
			foreach ( $options as $option ) {
				$label = 'Цвет #'.$k.'<br>';
				$label.= '<small>Фон: </small><div class="one-color" style="background-color: '.$option['colors'][0].'"></div><br>';
				$label.= '<small>Активный: </small><div class="one-color" style="background-color: '.$option['colors'][1].'"></div><br>';
				echo '<li><input type="radio" name="' . esc_attr($name) . '" id="' . esc_attr($id) . '-' . $option['value'] . '" value="' . $option['value'] . '" ' . checked($meta, $option['value'], false) . ' />
						<label for="' . esc_attr($id) . '-' . $option['value'] . '">' . $label . '</label></li>';
				$k++;
			}
			echo '</ul>';
			echo '<h4>Превью палитры</h4>';
			echo '<div class="billboard-preview">
			<div class="billboard-wrap">
			<div class="billboard-top">
				Средний чек 100р
			</div>

			<div>
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="49" height="58" viewBox="0 0 49 58">
			  <defs>
			    <style>
			      .cls-1 {
			        fill: #ff471a;
			        fill-rule: evenodd;
			      }
			    </style>
			  </defs>
			  <path d="M48.120,2.503 L40.143,5.170 L37.585,13.494 L43.124,13.494 C43.495,13.494 43.849,13.655 44.092,13.936 C44.337,14.217 44.448,14.590 44.398,14.959 L38.662,56.879 C38.574,57.518 38.030,57.994 37.388,57.994 L17.312,57.994 C16.670,57.994 16.125,57.518 16.038,56.879 L11.346,22.590 C10.853,22.665 10.355,22.707 9.855,22.707 C4.425,22.707 0.008,18.276 0.008,12.830 C0.008,7.384 4.425,2.953 9.854,2.953 C13.663,2.953 17.167,5.191 18.780,8.656 C19.080,9.301 18.802,10.069 18.159,10.370 C17.516,10.671 16.751,10.392 16.450,9.747 C15.258,7.186 12.669,5.532 9.854,5.532 C5.843,5.532 2.580,8.806 2.580,12.830 C2.580,16.854 5.843,20.127 9.854,20.127 C10.237,20.127 10.617,20.088 10.994,20.028 L10.301,14.959 C10.250,14.590 10.361,14.218 10.606,13.936 C10.850,13.655 11.203,13.494 11.575,13.494 L34.894,13.494 L37.881,3.776 C38.003,3.378 38.309,3.064 38.702,2.932 L47.306,0.055 C47.982,-0.170 48.709,0.196 48.933,0.871 C49.157,1.547 48.793,2.278 48.120,2.503 ZM18.188,20.127 L32.855,20.127 L34.101,16.074 L13.049,16.074 L18.432,55.414 L36.266,55.414 L40.742,22.707 L18.188,22.707 C17.478,22.707 16.902,22.129 16.902,21.417 C16.902,20.705 17.478,20.127 18.188,20.127 ZM35.546,20.127 L41.095,20.127 L41.650,16.074 L36.792,16.074 L35.546,20.127 ZM22.769,29.354 C25.276,29.354 27.315,31.400 27.315,33.915 C27.315,36.431 25.276,38.476 22.769,38.476 C20.262,38.476 18.223,36.431 18.223,33.915 C18.223,31.400 20.262,29.354 22.769,29.354 ZM22.769,35.897 C23.857,35.897 24.744,35.008 24.744,33.915 C24.744,32.823 23.857,31.934 22.769,31.934 C21.680,31.934 20.794,32.823 20.794,33.915 C20.794,35.008 21.680,35.897 22.769,35.897 ZM29.615,40.280 C31.594,40.280 33.204,41.895 33.204,43.881 C33.204,45.867 31.594,47.482 29.615,47.482 C27.636,47.482 26.026,45.866 26.026,43.881 C26.026,41.895 27.636,40.280 29.615,40.280 ZM29.615,44.902 C30.176,44.902 30.633,44.444 30.633,43.881 C30.633,43.318 30.176,42.860 29.615,42.860 C29.054,42.860 28.598,43.318 28.598,43.881 C28.598,44.444 29.054,44.902 29.615,44.902 ZM31.229,35.214 C31.229,34.309 31.960,33.576 32.862,33.576 C33.765,33.576 34.496,34.309 34.496,35.214 C34.496,36.120 33.765,36.853 32.862,36.853 C31.960,36.853 31.229,36.120 31.229,35.214 Z" class="cls-1"/>
			</svg>
			<h3>Пример текста</h3>
			</div>
			<div class="billboard-bottom">
				Места
			</div>
			</div>

			</div>';
			echo '</div>'.$desc;
			break;
		case 'icons-pallet':
			echo '<div class="color-pallete-wrap"><ul class="meta_box_items icons-pallete">';
			$count =$field['count'] ;
			for ($i = 1; $i < $count+1; $i++ ) {
				$label = 'Икона #'.$i.'<br>';
				$label .= '<img src="'.get_template_directory_uri().'/icons/ico'.$i.'.svg">';
				echo '<li><input type="radio" name="' . esc_attr($name) . '" id="' . esc_attr($id) . '-' . $i . '" value="' . $i . '" ' . checked($meta, $i, false) . ' />
						<label for="' . esc_attr($id) . '-' . $i . '">' . $label . '</label></li>';
			}
			echo '</ul>';
			echo '</div>'.$desc;
			break;
		case 'places-pallet':
			echo '<div class="color-pallete-wrap"><ul class="meta_box_items icons-pallete">';
			for ($i = 0; $i < sizeof($options); $i++ ) {
				$label = '<img src="'.$options[$i]['icon'].'">';
				$label .= $options[$i]['title'];
				echo '<li><input type="radio" name="' . esc_attr($name) . '" id="' . esc_attr($id) . '-' . $i . '" value="' . $i . '" ' . checked($meta, $i, false) . ' />
						<label class="places-pallet-label" for="' . esc_attr($id) . '-' . $i . '">' . $label . '</label></li>';
			}
			echo '</ul>';
			echo '</div>'.$desc;
			break;
		case 'places-map':
			echo '<div class="map-place-wrap">';
			echo '<input type="' . $type . '" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . esc_attr( $meta ) . '" class="regular-text" size="30" />
					<br />' . $desc;
			echo '<div class="map" id="map-'.esc_attr($id).'"></div>';
			echo '</div>';
			break;
		// post_checkboxes
		case 'post_checkboxes':
			$posts = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1 ) );
			echo '<ul class="meta_box_items">';
			foreach ( $posts as $item ) 
				echo '<li><input type="checkbox" value="' . $item->ID . '" name="' . esc_attr( $name ) . '[]" id="' . esc_attr( $id ) . '-' . $item->ID . '"' , is_array( $meta ) && in_array( $item->ID, $meta ) ? ' checked="checked"' : '' , ' />
						<label for="' . esc_attr( $id ) . '-' . $item->ID . '">' . $item->post_title . '</label></li>';
			$post_type_object = get_post_type_object( $post_type );
			echo '</ul> ' . $desc , ' &nbsp;<span class="description"><a href="' . admin_url( 'edit.php?post_type=' . $post_type . '">Manage ' . $post_type_object->label ) . '</a></span>';
		break;
		// post_drop_sort
		case 'post_drop_sort':
			//areas
			$post_type_object = get_post_type_object( $post_type );
			echo '<p>' . $desc . ' &nbsp;<span class="description"><a href="' . admin_url( 'edit.php?post_type=' . $post_type . '">Manage ' . $post_type_object->label ) . '</a></span></p><div class="post_drop_sort_areas">';
			foreach ( $areas as $area ) {
				echo '<ul id="area-' . $area['id']  . '" class="sort_list">
						<li class="post_drop_sort_area_name">' . $area['label'] . '</li>';
						if ( is_array( $meta ) ) {
							$items = explode( ',', $meta[$area['id']] );
							foreach ( $items as $item ) {
								$output = $display == 'thumbnail' ? get_the_post_thumbnail( $item, array( 204, 30 ) ) : get_the_title( $item ); 
								echo '<li id="' . $item . '">' . $output . '</li>';
							}
						}
				echo '</ul>
					<input type="hidden" name="' . esc_attr( $name ) . '[' . $area['id'] . ']" 
					class="store-area-' . $area['id'] . '" 
					value="' , $meta ? $meta[$area['id']] : '' , '" />';
			}
			echo '</div>';
			// source
			$exclude = null;
			if ( !empty( $meta ) ) {
				$exclude = implode( ',', $meta ); // because each ID is in a unique key
				$exclude = explode( ',', $exclude ); // put all the ID's back into a single array
			}
			$posts = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1, 'post__not_in' => $exclude ) );
			echo '<ul class="post_drop_sort_source sort_list">
					<li class="post_drop_sort_area_name">Available ' . $label . '</li>';
			foreach ( $posts as $item ) {
				$output = $display == 'thumbnail' ? get_the_post_thumbnail( $item->ID, array( 204, 30 ) ) : get_the_title( $item->ID ); 
				echo '<li id="' . $item->ID . '">' . $output . '</li>';
			}
			echo '</ul>';
		break;
		// tax_select
		case 'tax_select':
			echo '<select name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '">
					<option value="">Select One</option>'; // Select One
			$terms = get_terms( $id, 'get=all' );
			$post_terms = wp_get_object_terms( get_the_ID(), $id );
			$taxonomy = get_taxonomy( $id );
			$selected = $post_terms ? $taxonomy->hierarchical ? $post_terms[0]->term_id : $post_terms[0]->slug : null;
			foreach ( $terms as $term ) {
				$term_value = $taxonomy->hierarchical ? $term->term_id : $term->slug;
				echo '<option value="' . $term_value . '"' . selected( $selected, $term_value, false ) . '>' . $term->name . '</option>'; 
			}
			echo '</select> &nbsp;<span class="description"><a href="'.get_bloginfo( 'url' ) . '/wp-admin/edit-tags.php?taxonomy=' . $id . '">Manage ' . $taxonomy->label . '</a></span>
				<br />' . $desc;
		break;
		// tax_checkboxes
		case 'tax_checkboxes':
			$terms = get_terms( $id, 'get=all' );
			$post_terms = wp_get_object_terms( get_the_ID(), $id );
			$taxonomy = get_taxonomy( $id );
			$checked = $post_terms ? $taxonomy->hierarchical ? $post_terms[0]->term_id : $post_terms[0]->slug : null;
			foreach ( $terms as $term ) {
				$term_value = $taxonomy->hierarchical ? $term->term_id : $term->slug;
				echo '<input type="checkbox" value="' . $term_value . '" name="' . $id . '[]" id="term-' . $term_value . '"' . checked( $checked, $term_value, false ) . ' /> <label for="term-' . $term_value . '">' . $term->name . '</label><br />';
			}
			echo '<span class="description">' . $field['desc'] . ' <a href="'.get_bloginfo( 'url' ) . '/wp-admin/edit-tags.php?taxonomy=' . $id . '&post_type=' . $page . '">Manage ' . $taxonomy->label . '</a></span>';
		break;
		// date
		case 'date':
			echo '<input type="text" class="datetimepicker" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . $meta . '" size="30" />
					<br />' . $desc;
			break;
		case 'time':
			echo '<input type="text" class="datetimepicker timepicker" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . $meta . '" size="30" />
					<br />' . $desc;
			break;
		// slider
		case 'slider':
		$value = $meta != '' ? intval( $meta ) : '0';
			echo '<div id="' . esc_attr( $id ) . '-slider"></div>
					<input type="text" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . $value . '" size="5" />
					<br />' . $desc;
		break;
		// image
		case 'image':
			$image = CUSTOM_METABOXES_DIR . '/images/image.png';	
			echo '<div class="meta_box_image"><span class="meta_box_default_image" style="display:none">' . $image . '</span>';
			if ( $meta ) {
				$image = wp_get_attachment_image_src( intval( $meta ), 'medium' );
				$image = $image[0];
			}				
			echo	'<input name="' . esc_attr( $name ) . '" type="hidden" class="meta_box_upload_image" value="' . intval( $meta ) . '" />
						<img src="' . esc_attr( $image ) . '" class="meta_box_preview_image" alt="" />
							<hr>
							<a href="#" class="meta_box_upload_image_button button" rel="' . get_the_ID() . '">Выбрать изображение</a>
							<small>&nbsp;<a href="#" class="meta_box_clear_image_button">Удалить изображение</a></small></div>
							<br clear="all" />' . $desc;
		break;
		// file
		case 'file':		
			$iconClass = 'meta_box_file';
			if ( $meta ) $iconClass .= ' checked';
			echo	'<div class="meta_box_file_stuff"><input name="' . esc_attr( $name ) . '" type="hidden" class="meta_box_upload_file" value="' . esc_url( $meta ) . '" />
						<span class="' . $iconClass . '"></span>
						<span class="meta_box_filename">' . esc_url( $meta ) . '</span>
							<a href="#" class="meta_box_upload_image_button button" rel="' . get_the_ID() . '">Choose File</a>
							<small>&nbsp;<a href="#" class="meta_box_clear_file_button">Remove File</a></small></div>
							<br clear="all" />' . $desc;
		break;
		// repeatable
		case 'repeatable':
			echo '<table id="' . esc_attr( $id ) . '-repeatable" class="meta_box_repeatable" cellspacing="0">
				<thead>
					<tr>
						<th><span class="sort_label"></span></th>
						<th>Fields</th>
						<th><a class="meta_box_repeatable_add" href="#"></a></th>
					</tr>
				</thead>
				<tbody>';
			$i = 0;
			// create an empty array
			if ( $meta == '' || $meta == array() ) {
				$keys = wp_list_pluck( $repeatable_fields, 'id' );
				$meta = array ( array_fill_keys( $keys, null ) );
			}
			$meta = array_values( $meta );
            //var_dump($meta);
			foreach( $meta as $row ) {
				echo '<tr>
						<td><span class="sort hndle"></span></td><td>';
				foreach ( $repeatable_fields as $repeatable_field ) {
					if ( ! array_key_exists( $repeatable_field['id'], $meta[$i] ) )
						$meta[$i][$repeatable_field['id']] = null;
					echo '<label>' . $repeatable_field['label']  . '</label><p>';
					echo custom_meta_box_field( $repeatable_field, $meta[$i][$repeatable_field['id']], array( $id, $i ) );
					echo '</p>';
				} // end each field
				echo '</td><td><a class="meta_box_repeatable_remove" href="#"></a></td></tr>';
				$i++;
			} // end each row
			echo '</tbody>';
			echo '
				<tfoot>
					<tr>
						<th><span class="sort_label"></span></th>
						<th>Fields</th>
						<th><a class="meta_box_repeatable_add" href="#"></a></th>
					</tr>
				</tfoot>';
			echo '</table>
				' . $desc;
		break;
	} //end switch
		
}


/**
 * Finds any item in any level of an array
 *
 * @param	string	$needle 	field type to look for
 * @param	array	$haystack	an array to search the type in
 *
 * @return	bool				whether or not the type is in the provided array
 */
function meta_box_find_field_type( $needle, $haystack ) {
	foreach ( $haystack as $h )
		if ( isset( $h['type'] ) && $h['type'] == 'repeatable' )
			return meta_box_find_field_type( $needle, $h['repeatable_fields'] );
		elseif ( ( isset( $h['type'] ) && $h['type'] == $needle ) || ( isset( $h['repeatable_type'] ) && $h['repeatable_type'] == $needle ) )
			return true;
	return false;
}

/**
 * Find repeatable
 *
 * This function does almost the same exact thing that the above function 
 * does, except we're exclusively looking for the repeatable field. The 
 * reason is that we need a way to look for other fields nested within a 
 * repeatable, but also need a way to stop at repeatable being true. 
 * Hopefully I'll find a better way to do this later.
 *
 * @param	string	$needle 	field type to look for
 * @param	array	$haystack	an array to search the type in
 *
 * @return	bool				whether or not the type is in the provided array
 */
function meta_box_find_repeatable( $needle = 'repeatable', $haystack ) {
	foreach ( $haystack as $h )
		if ( isset( $h['type'] ) && $h['type'] == $needle )
			return true;
	return false;
}

/**
 * sanitize boolean inputs
 */
function meta_box_santitize_boolean( $string ) {
	if ( ! isset( $string ) || $string != 1 || $string != true )
		return false;
	else
		return true;
}

/**
 * outputs properly sanitized data
 *
 * @param	string	$string		the string to run through a validation function
 * @param	string	$function	the validation function
 *
 * @return						a validated string
 */
function meta_box_sanitize( $string, $function = 'sanitize_text_field' ) {
	switch ( $function ) {
		case 'intval':
			return intval( $string );
		case 'absint':
			return absint( $string );
		case 'wp_kses_post':
			return wp_kses_post( $string );
		case 'wp_kses_data':
			return wp_kses_data( $string );
		case 'esc_url_raw':
			return esc_url_raw( $string );
		case 'is_email':
			return is_email( $string );
		case 'sanitize_title':
			return sanitize_title( $string );
		case 'santitize_boolean':
			return santitize_boolean( $string );
		case 'sanitize_text_field':
		default:
			return sanitize_text_field( $string );
	}
}

/**
 * Map a multideminsional array
 *
 * @param	string	$func		the function to map
 * @param	array	$meta		a multidimensional array
 * @param	array	$sanitizer	a matching multidimensional array of sanitizers
 *
 * @return	array				new array, fully mapped with the provided arrays
 */
function meta_box_array_map_r( $func, $meta, $sanitizer ) {
		
	$newMeta = array();
	$meta = array_values( $meta );
	
	foreach( $meta as $key => $array ) {
		if ( $array == '' )
			continue;
		/**
		 * some values are stored as array, we only want multidimensional ones
		 */
		if ( ! is_array( $array ) ) {
			return array_map( $func, $meta, (array)$sanitizer );
			break;
		}
		/**
		 * the sanitizer will have all of the fields, but the item may only 
		 * have valeus for a few, remove the ones we don't have from the santizer
		 */
		$keys = array_keys( $array );
		$newSanitizer = $sanitizer;
		if ( is_array( $sanitizer ) ) {
			foreach( $newSanitizer as $sanitizerKey => $value )
				if ( ! in_array( $sanitizerKey, $keys ) )
					unset( $newSanitizer[$sanitizerKey] );
		}
		/**
		 * run the function as deep as the array goes
		 */
		foreach( $array as $arrayKey => $arrayValue )
			if ( is_array( $arrayValue ) )
				$array[$arrayKey] = meta_box_array_map_r( $func, $arrayValue, $newSanitizer[$arrayKey] );
		
		//$array = array_map( $func, $array, $newSanitizer );
        //var_dump($array);
		$newMeta[$key] = array_combine( $keys, array_values( $array ) );
	}
	return $newMeta;
}

/**
 * takes in a few peices of data and creates a custom meta box
 *
 * @param	string			$id			meta box id
 * @param	string			$title		title
 * @param	array			$fields		array of each field the box should include
 * @param	string|array	$page		post type to add meta box to
 */
class Custom_Add_Meta_Box {
	
	var $id;
	var $title;
	var $fields;
	var $page;
	
    public function __construct( $id, $title, $fields, $page ) {
		$this->id = $id;
		$this->title = $title;
		$this->fields = $fields;
		$this->page = $page;
		
		if( ! is_array( $this->page ) )
			$this->page = array( $this->page );
		
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_head',  array( $this, 'admin_head' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_box' ) );
		add_action( 'save_post',  array( $this, 'save_box' ));
    }
	
	/**
	 * enqueue necessary scripts and styles
	 */
	function admin_enqueue_scripts() {
		global $pagenow;
		if ( in_array( $pagenow, array( 'post-new.php', 'post.php' ) ) && in_array( get_post_type(), $this->page ) ) {
			// js
			$deps = array( 'jquery' );
			if ( meta_box_find_field_type( 'date', $this->fields ) )
				$deps[] = 'jquery-ui-datepicker';
			if ( meta_box_find_field_type( 'slider', $this->fields ) )
				$deps[] = 'jquery-ui-slider';
			if ( meta_box_find_field_type( 'color', $this->fields ) )
				$deps[] = 'farbtastic';
			if ( in_array( true, array(
				meta_box_find_field_type( 'chosen', $this->fields ),
				meta_box_find_field_type( 'post_chosen', $this->fields )
			) ) ) {
				wp_register_script( 'chosen', CUSTOM_METABOXES_DIR . '/js/chosen.js', array( 'jquery' ) );
				$deps[] = 'chosen';
				wp_enqueue_style( 'chosen', CUSTOM_METABOXES_DIR . '/css/chosen.css' );
			}
			if ( in_array( true, array( 
				meta_box_find_field_type( 'date', $this->fields ), 
				meta_box_find_field_type( 'slider', $this->fields ),
				meta_box_find_field_type( 'color', $this->fields ),
				meta_box_find_field_type( 'chosen', $this->fields ),
				meta_box_find_field_type( 'post_chosen', $this->fields ),
				meta_box_find_repeatable( 'repeatable', $this->fields ),
				meta_box_find_field_type( 'image', $this->fields ),
				meta_box_find_field_type( 'file', $this->fields ),
				meta_box_find_field_type('places-map',$this->fields)
			) ) )

				wp_enqueue_script( 'meta_box', CUSTOM_METABOXES_DIR . '/js/scripts.js', $deps );
			wp_enqueue_script( 'meta_box_ui', CUSTOM_METABOXES_DIR . '/js/jquery-ui.min.js', $deps );
			wp_enqueue_script( 'meta_datetime', CUSTOM_METABOXES_DIR . '/js/jquery.datetimepicker.full.min.js', $deps );

			if(meta_box_find_field_type('places-map',$this->fields)){
				wp_enqueue_script( 'google_maps_api',"https://maps.googleapis.com/maps/api/js?key=AIzaSyCheN4Tubg-Pe3qf7QwITpCHq9lHH1t658&sensor=false&extension=.js" );
				wp_enqueue_media();
			}
			wp_enqueue_script( 'mask_plugin_2',CUSTOM_METABOXES_DIR . '/js/m.js');
			wp_enqueue_script( 'mask_plugin',CUSTOM_METABOXES_DIR . '/js/mask.js');

			// css
			$deps = array();
			wp_enqueue_style( 'meta_jqueryui', CUSTOM_METABOXES_DIR . '/css/jquery-ui.min.css' );
			wp_enqueue_style( 'meta_timepicker', CUSTOM_METABOXES_DIR . '/css/jquery.datetimepicker.min.css' );
			//if ( meta_box_find_field_type( 'date', $this->fields ) || meta_box_find_field_type( 'slider', $this->fields ) )
//				$deps[] = 'jqueryui';
			if ( meta_box_find_field_type( 'color', $this->fields ) )
				$deps[] = 'farbtastic';
			wp_enqueue_style( 'meta_box', CUSTOM_METABOXES_DIR . '/css/meta_box.css', $deps );
		}
	}
	
	/**
	 * adds scripts to the head for special fields with extra js requirements
	 */
	function admin_head() {
		if ( in_array( get_post_type(), $this->page ) && ( meta_box_find_field_type( 'date', $this->fields ) || meta_box_find_field_type( 'slider', $this->fields ) ) ) {
		
			echo '<script type="text/javascript">
						jQuery(function( $) {';
			
			foreach ( $this->fields as $field ) {
				switch( $field['type'] ) {
					// date
					case 'date' :
						echo 'jQuery.datetimepicker.setLocale(\'ru\');';
						echo '$("#' . $field['id'] . '").datetimepicker({
								format: \'Y-m-d H:i\',
								lang: \'ru\',
								 i18n:{
 									 ru:{
 									  months:[
 									   \'Январь\',\'Февраль\',\'Март\',\'Апрель\',
 									   \'Май\',\'Июнь\',\'Июль\',\'Август\',
 									   \'Сентябрь\',\'Октябрь\',\'Ноябрь\',\'Декабрь\',
 									  ],
 									  dayOfWeek:[
 									   "Вс.", "Пн.", "Вт.", "Ср.",
 									   "Чт.", "Пт.", "Сб.",
 									  ]
 									 }
 									}
								});';
						break;
					case 'time' :
						echo 'jQuery.datetimepicker.setLocale(\'ru\');';
						echo '$("#' . $field['id'] . '").datetimepicker({
								datepicker:false,
  								format:\'H:i\',
								lang: \'ru\',
								 i18n:{
 									 ru:{
 									  months:[
 									   \'Январь\',\'Февраль\',\'Март\',\'Апрель\',
 									   \'Май\',\'Июнь\',\'Июль\',\'Август\',
 									   \'Сентябрь\',\'Октябрь\',\'Ноябрь\',\'Декабрь\',
 									  ],
 									  dayOfWeek:[
 									   "Вс.", "Пн.", "Вт.", "Ср.",
 									   "Чт.", "Пт.", "Сб.",
 									  ]
 									 }
 									}
								});';
						break;
					// slider
					case 'slider' :
					$value = get_post_meta( get_the_ID(), $field['id'], true );
					if ( $value == '' )
						$value = $field['min'];
					echo '
							$( "#' . $field['id'] . '-slider" ).slider({
								value: ' . $value . ',
								min: ' . $field['min'] . ',
								max: ' . $field['max'] . ',
								step: ' . $field['step'] . ',
								slide: function( event, ui ) {
									$( "#' . $field['id'] . '" ).val( ui.value );
								}
							});';
					break;
				}
			}
			
			echo '});
				</script>';
		
		}
	}
	
	/**
	 * adds the meta box for every post type in $page
	 */
	function add_box() {
		foreach ( $this->page as $page ) {
			add_meta_box( $this->id, $this->title, array( $this, 'meta_box_callback' ), $page, 'normal', 'high' );
		}
	}
	
	/**
	 * outputs the meta box
	 */
	function meta_box_callback() {
		// Use nonce for verification
		wp_nonce_field( 'custom_meta_box_nonce_action', 'custom_meta_box_nonce_field' );
		
		// Begin the field table and loop
		echo '<table class="form-table meta_box">';
		foreach ( $this->fields as $field) {
			if ( $field['type'] == 'section' ) {
				echo '<tr>
						<td colspan="2">
							<h2>' . $field['label'] . '</h2>
						</td>
					</tr>';
			}
			else {
				echo '<tr>
						<th style="width:20%"><label for="' . $field['id'] . '">' . $field['label'] . '</label></th>
						<td>';
						
						$meta = get_post_meta( get_the_ID(), $field['id'], true);
						echo custom_meta_box_field( $field, $meta );
						
				echo     '<td>
					</tr>';
			}
		} // end foreach
		echo '</table>'; // end table
	}
	
	/**
	 * saves the captured data
	 */
	function save_box( $post_id ) {
		$post_type = get_post_type();
		
		// verify nonce
		if ( ! isset( $_REQUEST['custom_meta_box_nonce_field'] )) {
			return $post_id;
		}

		if ( ! ( in_array( $post_type, $this->page ) || wp_verify_nonce( $_REQUEST['custom_meta_box_nonce_field'],  'custom_meta_box_nonce_action' ) ) ) {
			return $post_id;
		}
		// check autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		// check permissions
		if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
		
		// loop through fields and save the data
//		var_dump($this);
		foreach ( $this->fields as $field ) {
			if( $field['type'] == 'section' ) {
				$sanitizer = null;
				continue;
			}
			$sanitize = isset($field['sanitize']) ? $field['sanitize'] : true;
//			if(!$sanitize){
//				update_post_meta( $post_id, $field['id'],  );
//				return;
//			}
			if( in_array( $field['type'], array( 'tax_select', 'tax_checkboxes' ) ) ) {
				// save taxonomies
				if ( isset( $_REQUEST[$field['id']] ) ) {
					$term = $_REQUEST[$field['id']];
					wp_set_object_terms( $post_id, $term, $field['id'] );
				}
			}
			else {
				$new = false;
				// save the rest
				$old = get_post_meta( $post_id, $field['id'], true );
				if ( isset( $_REQUEST[$field['id']] ) )
                    $new = $_REQUEST[$field['id']];
//				var_dump($new);
				if ( isset( $new ) && '' == $new && $old ) {
					delete_post_meta( $post_id, $field['id'], $old );
				} elseif ( isset( $new ) && $new != $old ) {
					$sanitizer = isset( $field['sanitizer'] ) ? $field['sanitizer'] : 'sanitize_text_field';
					if ( is_array( $new ) ) {
                        //var_dump($new);
                        $new = meta_box_array_map_r('meta_box_sanitize', $new, $sanitizer);
                        //die();
                    }
					else
						$new = meta_box_sanitize( $new, $sanitizer );
					update_post_meta( $post_id, $field['id'], $new );
//					var_dump($new);
				}
			}
		} // end foreach
	}
	
}