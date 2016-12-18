<?php 
class ControllerUploadCsvUpload extends Controller { 
	private $error = array();
 
	public function index() {	

		$this->language->load('upload/csv');

		 $this->document->setTitle($this->language->get('heading_title'));


		
		$this->load->model('upload/csvupload');
				
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateForm()) {
			   
			   $filetype=$this->request->files['import']['name'];
 			   $extension = explode('.', $filetype);
			   $extension=end($extension);

			if (is_uploaded_file($this->request->files['import']['tmp_name'])) {
				$file_name = $this->request->files['import']['tmp_name'];
			} else {
				$file_name = false;
			}
			$tabledata = array();
			if($extension=='csv'){
			if ($file_name) {
				$tabledata_error = $this->model_upload_csvupload->upload_error($file_name,'1');
				//pre($tabledata_error['value']);////tp added////
				if(isset($tabledata_error['value']) && !empty($tabledata_error['value'])) {
					$error_upload=$tabledata_error['value'];
					$this->session->data['error'] = nl2br($error_upload);
				//$this->session->data['tabledata']  = $tabledata_error;
				$this->response->redirect($this->url->link('upload/csvupload', 'token=' . $this->session->data['token'], 'SSL'));
					
				}
					else {
				$tabledata = $this->model_upload_csvupload->upload($file_name,'1');
				$this->session->data['success'] = $this->language->get('text_success');
				
				$this->session->data['tabledata']  = $tabledata;
				$this->response->redirect($this->url->link('upload/csvupload', 'token=' . $this->session->data['token'], 'SSL'));
			
				}

				////end tp added////

				//$this->response->redirect($this->url->link('upload/csvupload', 'token=' . $this->session->data['token'], 'SSL'));
			
				
			} else {
				 
				$this->session->data['error'] = $this->language->get('error_empty');
			}

		  }else{
                 $this->session->data['error'] = 'File is not in csv formate';
		        }
		}

		$data['heading_title'] = $this->language->get('heading_title');   
		//$data['entry_Vendor'] = $this->language->get('entry_Vendor');
		
		$data['entry_upload'] = $this->language->get('entry_upload');
		 
	    $data['button_upload'] = $this->language->get('button_upload');  
	    //$data['vendorlist']=$this->model_upload_csvupload->vendorlist();

	     
		if (isset($this->session->data['error'])) {
    		$data['error_warning'] = $this->session->data['error'];
    		//echo "#######";
    
			unset($this->session->data['error']);
 		} elseif (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->session->data['tabledata'])) {
			$this->data['tabledata'] = $this->session->data['tabledata'];
		
			unset($this->session->data['tabledata']);
		} else {
			$data['tabledata'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),     		
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('upload/csvupload', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['upload'] = $this->url->link('upload/csvupload', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
				
		$this->response->setOutput($this->load->view('upload/csv.tpl', $data));
	}
	protected function validateForm() {


		if (!$this->user->hasPermission('modify', 'upload/csvupload')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

			// if ($this->request->post['vendor_id']==0) {
			// 	$this->error['warning'] = $this->language->get('select_vendor');
			// }
			return !$this->error;
	}

}
?>