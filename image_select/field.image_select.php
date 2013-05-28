<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Image Select Field Type
 *
 * @package		Addons\Field Types
 * @author		James Doyle (james2doyle)
 * @license		MIT License
 * @link		http://github.com/james2doyle/pyro-image-select
 */
class Field_image_select
{
	public $field_type_slug    = 'image_select';
	public $db_col_type        = 'text';
	public $version            = '1.0.1';
	public $author             = array('name'=>'James Doyle', 'url'=>'http://github.com/james2doyle/pyro-image-select');
	public $custom_parameters  = array('folder_select');

	// --------------------------------------------------------------------------

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('files/files');
		$this->CI->load->model('files/file_folders_m');
		$this->CI->load->library('files/files');
	}

	// --------------------------------------------------------------------------

	public function pre_output($input, $data)
	{
		$file = Files::get_file($input);
		$filedata = $file['data'];
		if($filedata)
		{
			$image = "<img title='$filedata->name' id='$filedata->id' src='".BASE_URL."/files/thumb/$filedata->filename/100/100/fit' />";
		}
		return $image;
	}
	
	public function pre_output_plugin($input, $data)
	{
		$file = Files::get_file($input);
		return (array)$file['data'];
	}

	/**
	 * Param Image Folder
	 *
	 * @access	public
	 * @param	[string - value]
	 * @return	string
	 */
	public function param_folder_select($value=null)
	{
		$instructions = '<p class="note">'.lang('streams:image_select.folder_select_instructions').'</p>';

		$folder = $this->CI->file_folders_m->get_all();
		$folder_select = array_for_select($folder, 'id', 'name');

		return $instructions.'<div style="float: left;">'.form_dropdown('folder_select', $folder_select, $value).'</div>';
	}

	/**
	 * Output form input
	 *
	 * @param	array
	 * @param	array
	 * @return	string
	 */
	public function form_output($data, $entry_id, $field)
	{
		$folder_select = $field->field_data['folder_select'];
		$files = Files::folder_contents($folder_select);
		$hidden_input = "<input id='input_$data[form_slug]' name='$data[form_slug]' type='hidden' value='$data[value]' >";
		$image_list = "<ul>";
		foreach ($files['data']['file'] as $file) {
			if ($file->type == 'i') {
				$class = ($file->id == $data['value']) ? 'class="active"': '';
				$image_list .= "<li $class><img title='$file->name' id='$file->id' src='".BASE_URL."/files/thumb/$file->filename/120/120/fit' /></li>";
			}
		}
		$image_list."</ul>";
		return "<div id='$data[form_slug]' class='image_select'>".$hidden_input.$image_list."</div>";
	}

	public function event($field)
	{
		$this->CI->type->add_js('image_select', 'image_select.js');
		$this->CI->type->add_css('image_select', 'image_select.css');
	}
}
