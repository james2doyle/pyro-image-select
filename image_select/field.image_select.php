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
	public $version            = '1.0.2';
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
		$hidden_input = "<input id='input_$data[form_slug]' name='$data[form_slug]' type='hidden' value='$data[value]' >";
	
		$file_list = $this->get_folder_contents($folder_id, true);
	
		return "<div id='$data[form_slug]' class='image_select'>".$hidden_input.$file_list."</div><div style=\"clear:both;\"></div>";
	}
	
	/**
	 * Recursive loop to get all the subfolders, and their images 
	 * If it is a base folder, don't show the folder icon
	 *
	 * @access	private
	 * @param	array
	 * @return	string
	 */
	private function get_folder_contents($folder_id, $base_folder = false)
	{
		
		$files = Files::folder_contents($folder_id);
		
		$return_string = "<ul class=" . ( $base_folder ? "'base_folder'" : "'folder'" ) . " id=\"folder_$folder_id\">";
				
		foreach ($files['data']['folder'] as $folder)
		{
			if (!$base_folder) 
			{
				$return_string .= "<li class='folder_title' id=\"$folder->id\">";
				$return_string .= "<img src='" . BASE_URL . APPPATH . "modules/files/img/folder.png' />";
				$return_string .= "<br />$folder->name</li>";
			}
			
			$return_string .= "<li class='" . ( $base_folder ? "" : "hidden_folder" ) . " folder_item_$folder->id'>" . $this->get_folder_contents($folder->id) . "</li>";
		}
		
		foreach ($files['data']['file'] as $file) {
			if ($file->type == 'i') {
				$class = ($file->id == $data['value']) ? 'class="active"': '';
				$return_string .= "<li $class><img title='$file->name' id='$file->id' src='".BASE_URL."/files/thumb/$file->filename/120/120/fit' /></li>";
			}
		}
		
		
		$return_string .= "</ul>";
		
		return $return_string;
	}
	

	public function event($field)
	{
		$this->CI->type->add_js('image_select', 'image_select.js');
		$this->CI->type->add_css('image_select', 'image_select.css');
	}
}
