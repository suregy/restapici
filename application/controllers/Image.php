<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image extends CI_Controller {


    public function __construct()
    {
        parent::__construct();

    }
	public function index()
	{
        $path= base_url('upload/8ee7027d078ea812d0f63180881a1e18.jpg');
        echo anchor($path);
	}
}
