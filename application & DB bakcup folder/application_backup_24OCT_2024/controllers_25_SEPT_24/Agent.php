<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Agent extends CI_Controller
{
    public function index()
    {
        return view('agent/agent_dashboard'); 
    }

    public function new_ticket_form()
    {
        return view('agent/new_ticket_form'); 
    }
}
