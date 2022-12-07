<?php

namespace App\Controllers;

/**
 * Description of Test
 *
 * @author alexey
 */
class Test extends BaseController{
    
    public function index()
    {
        return view('welcome_message');
    }
}
