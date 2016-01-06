<?php

if($header == TRUE)
{
	$this->load->view("layout/header");
}

if($_view == TRUE)
{
	$this->load->view($_view);
}

if($footer == TRUE)
{
	$this->load->view("layout/footer");
}