<?php
	function form_input($data = '', $value = '', $extra = '', $label = '',$message = null)
	{
		$defaults = array(
			'type' => 'text',
			'name' => is_array($data) ? '' : $data,
			'value' => $value
		);
		$name = is_array($data) ? $data['name'] : $data;
		
		$awalan = '<div class="form-group"><label for="'.$name.'" class="font-weight-bold">'.$label."</label>\n";
		
		$isinvalid = $message?'is-invalid':'';
		
		$pos = strpos($extra,"class");
		$pos_quote = strpos($extra,'"',$pos); // petik pertama setelah tulisan class
		if ( $pos === false	){
			$extra .= ' class="form-control '.$isinvalid.'"';			
		} else {
			// menambahkan class form-control pada variable extra jika 
			// di dalam variable extra terdapat tulisan class
			// misal $extra berisi 'class="col-6"'
			// maka akan menjadi 'class="form-control col-6"'
			
			$extra = substr_replace($extra, 'form-control '.$isinvalid, $pos_quote+1, 0);
		}
		
		if($name){
		$extra .= ' id="'.$name.'" placeholder="'.$label.'"';
		}
		
		return $awalan.'  <input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n$message</div>\n";

	}
	
	function form_dropdown($data = '', $options = array(), $selected = array(), $extra = '', $label = '',$message = null)
	{
		$defaults = array();

		if (is_array($data))
		{
			if (isset($data['selected']))
			{
				$selected = $data['selected'];
				unset($data['selected']); // select tags don't have a selected attribute
			}

			if (isset($data['options']))
			{
				$options = $data['options'];
				unset($data['options']); // select tags don't use an options attribute
			}
		}
		else
		{
			$defaults = array('name' => $data);
		}
		
		is_array($selected) OR $selected = array($selected);
		is_array($options) OR $options = array($options);

		// If no selected state was submitted we will attempt to set it automatically
		if (empty($selected))
		{
			if (is_array($data))
			{
				if (isset($data['name'], $_POST[$data['name']]))
				{
					$selected = array($_POST[$data['name']]);
				}
			}
			elseif (isset($_POST[$data]))
			{
				$selected = array($_POST[$data]);
			}
		}

		$name = is_array($data) ? '' : $data;
		
		$awalan = '<div class="form-group"><label for="'.$name.'" class="font-weight-bold">'.$label."</label>\n";
		
		$isinvalid = $message?' is-invalid':'';
		$pos = strpos($extra,"class");
		$pos_quote = strpos($extra,'"',$pos); // petik pertama setelah tulisan class
		
		if ( $pos === false	){
			$extra .= ' class="form-control'.$isinvalid.'"';			
		} else {
			// menambahkan class form-control pada variable extra jika 
			// di dalam variable extra terdapat tulisan class
			// misal $extra berisi 'class="col-6"'
			// maka akan menjadi 'class="form-control col-6"'
			
			$extra = substr_replace($extra, 'form-control '.$isinvalid, $pos_quote+1, 0);
		} 
		
		
		
		$extra .= ' id="'.$name.'" data-allow-clear="1" data-placeholder="'.$label.'"';
		$extra = _attributes_to_string($extra);

		$multiple = (count($selected) > 1 && stripos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

		$form = '<select '.rtrim(_parse_form_attributes($data, $defaults)).$extra.$multiple.">\n<option disabled=\"disabled\" selected=\"selected\">$label</option>\n";

		foreach ($options as $key => $val)
		{
			$key = (string) $key;

			if (is_array($val))
			{
				if (empty($val))
				{
					continue;
				}

				$form .= '<optgroup label="'.$key."\">\n";

				foreach ($val as $optgroup_key => $optgroup_val)
				{
					$sel = in_array($optgroup_key, $selected) ? ' selected="selected"' : '';
					$form .= '<option value="'.html_escape($optgroup_key).'"'.$sel.'>'
						.(string) $optgroup_val."</option>\n";
				}

				$form .= "</optgroup>\n";
			}
			else
			{
				$form .= '<option value="'.html_escape($key).'"'
					.(in_array($key, $selected) ? ' selected="selected"' : '').'>'
					.(string) $val."</option>\n";
			}
		}
		
		
		return $awalan.$form."</select>\n$message</div>\n";
		
	}

function form_error($field = '', $prefix = '<div class="invalid-feedback">', $suffix = '</div>')
	{
		if (FALSE === ($OBJ =& _get_validation_object()))
		{
			return '';
		}

		return $OBJ->error($field, $prefix, $suffix);
	}
	
function form_password($data = '', $value = '', $extra = '', $label = '',$message = null)
	{
		is_array($data) OR $data = array('name' => $data);
		$data['type'] = 'password';
		return form_input($data, $value, $extra, $label, $message);
	}
	
	function form_email($data = '', $value = '', $extra = '', $label = '',$message = null)
	{
		is_array($data) OR $data = array('name' => $data);
		$data['type'] = 'email';
		return form_input($data, $value, $extra, $label, $message);
	}
	
	function form_upload($data = '', $value = '', $extra = '',$label = '',$message = null,$desc = null)
	{
		$defaults = array('type' => 'file', 'name' => '');
		is_array($data) OR $data = array('name' => $data);
		$data['type'] = 'file';

		$isinvalid = $message?' is-invalid':'';
		
		$pos = strpos($extra,"class");
		$pos_quote = strpos($extra,'"',$pos); // petik pertama setelah tulisan class
		if ( $pos === false	){
			$extra .= ' class="custom-file-input'.$isinvalid.'"';			
		} else {
			// menambahkan class form-control pada variable extra jika 
			// di dalam variable extra terdapat tulisan class
			// misal $extra berisi 'class="col-6"'
			// maka akan menjadi 'class="form-control col-6"'
			
			$extra = substr_replace($extra, 'custom-file-input'.$isinvalid, $pos_quote+1, 0);
		}
		
		$name = is_array($data) ? $data['name'] : $data;
		$awalan = "<div class=\"form-group\"><label for=\"".$name."\" class=\"font-weight-bold\">".$label."</label>\n<div class=\"custom-file mb-3\">";
		
		$desc = $desc?"<small class=\"form-text text-muted\"> $desc </small>":''; 
		$akhiran = "<label class=\"custom-file-label\" for=\"".$name."\">Choose file</label> $message $desc
    </div></div>";

		if($name){
		$extra .= ' id="'.$name.'" placeholder="'.$label.'"';
		}

		return $awalan.'<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n".$akhiran;
	}