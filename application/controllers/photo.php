<?php
class Photo extends CI_Controller
{
	function Photo() {
		parent::__construct();
		$this->load->library(array('form_validation', 'session'));
		$this->load->helper(array('url', 'form', 'file'));
		$this->load->model('account_model');
	}

	function start() {
		if($this->account_model->logged_in()) {

			$data = array('error' => "");
			$data['activemenu']="Upload_Photo";
			$data['activesubmenu']="Upload";
			$data['formaction']="../photo/upload.html";

			$this->load->view('main', $data);
		}
		else {
			redirect('account/login');
		}
	}

	function upload() {
		if($this->account_model->logged_in()) {
			$config['upload_path'] = './photos/temp/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name']	= TRUE;
			$config['max_size']	= '2048';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('photoimagefile'))
			{
				$data = array('error' => $this->upload->display_errors());
				$data['activemenu']="Upload_Photo";
				$data['activesubmenu']="Upload";
				$data['formaction']="../photo/upload.html";

				$this->load->view('main', $data);
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				$data['activemenu']="Upload_Photo";
				$data['activesubmenu']="Crop";
				$data['formaction']="../photo/crop.html";
				$this->load->view('main', $data);
			}
		}
		else {
			redirect('account/login');
		}
	}


	function crop() {
		if($this->account_model->logged_in()) {
			$event_target = $this->input->post('__EVENTTARGET');

			$file_path = $this->input->post('CropImageFilePath');
			$file_name = $this->input->post('CropImageFileName');
			
			if ($event_target == 'CropImage$lnkCrop')
			{
				$x_axis = $this->input->post('CropImageX');
				$y_axis = $this->input->post('CropImageY');
				$width = $this->input->post('CropImageW');
				$height = $this->input->post('CropImageH');
				$file_new_path = './photos/';
				$file_new_name = $this->account_model->get_email().$file_name;

				$config['image_library'] = 'gd2';
				$config['source_image'] = $file_path.$file_name;
				$config['maintain_ratio'] = FALSE;
				$config['x_axis'] = $x_axis;
				$config['y_axis'] = $y_axis;
				$config['width'] = $width;
				$config['height'] = $height;
					
				$this->load->library('image_lib', $config);

				$this->image_lib->crop();

				$config['width'] = 111;
				$config['height'] = 150;
				$config['new_image']= $file_new_path.$file_new_name;

				$this->image_lib->initialize($config);

				$this->image_lib->resize();

				//delete the temp photo file
				unlink($file_path.$file_name);

				$data['activemenu']="Upload_Photo";
				$data['activesubmenu']="Confirm";
				$data['formaction']="../photo/confirm.html";
				$data['file_path']=$file_new_path;
				$data['file_name']=$file_new_name;
				$data['error'] = $this->image_lib->display_errors();

				$this->load->view('main', $data);
			}
			else
			{
				//delete the photo file
				unlink($file_path.$file_name);
				redirect('photo/start');
			}
		}
		else {
			redirect('account/login');
		}
	}


	function confirm() {
		if($this->account_model->logged_in()) {
			$event_target = $this->input->post('__EVENTTARGET');

			$file_path = $this->input->post('CropImageFilePath');
			$file_name = $this->input->post('CropImageFileName');
				
			if ($event_target == 'CropImage$lnkSave')
			{
				//save file old name
				$file_old_name = $this->account_model->get_photo();
				if ($file_old_name == "unknown.jpg") {
					$file_old_name = NULL;
				}

				if ($this->account_model->change_photo($file_name)) {
						
					//delete the old photo file
					if (!is_null($file_old_name)){
						unlink($file_path.$file_old_name);
					}
						
					redirect('main/home');
				}
				else
				{
					//delete the photo file
					unlink($file_path.$file_name);
					
					$data['activemenu']="Upload_Photo";
					$data['formaction']="../photo/confirm.html";
					$data['file_path']=$file_path;
					$data['file_name']=$file_name;
					$data['error'] = "Update photo error! Please try again.";

					$this->load->view('photo/photo', $data);
				}

			}
			else
			{
				//delete the photo file
				unlink($file_path.$file_name);

				redirect('photo/start');
			}
		}
		else {
			redirect('account/login');
		}
	}
}