<?php

/*
 * Demo widget
 */
class Navigation extends Widget {

    public function display($data) {
        $this->view('widgets/bar-navigation-top', $data);
    }
    
}