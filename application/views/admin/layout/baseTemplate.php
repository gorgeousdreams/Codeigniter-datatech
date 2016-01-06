<?php

if($header)
	$this->load->view("admin/layout/header");

if($sidebar)
	$this->load->view("admin/layout/sidebar");

$this->load->view($_view);

if($footer)
	$this->load->view("admin/layout/footer");
