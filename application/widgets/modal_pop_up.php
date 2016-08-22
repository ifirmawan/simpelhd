<?php
class Modal_pop_up extends Widget {

    public function display($data) {
    	$footer_button  ='<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
        $footer_button .='<button type="button" class="btn btn-primary">Save changes</button>';
        if (!isset($data['modal'])) {
            $data['modal'] = array(
       			'title' => 'lorem'
       			,'content'=>'not yet'
       			,'footer' =>$footer_button
    		);
        }
        $this->view('widgets/modal-pop-up', $data);
    }
    
}