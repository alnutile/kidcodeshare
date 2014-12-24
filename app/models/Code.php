<?php

class Code extends \Eloquent {
	protected $fillable = [
        'title'
    ];

    public static $rules = [
        'title' => 'required|min:5',
        'code'  => 'required',
        'name'  => 'required' //alpha_dash
    ];


}