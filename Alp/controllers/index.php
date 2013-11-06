<?php
class index extends AlpFramework {

public function __construct($url)
{
	parent::AlpFramework($url);
}

function Start()
{
	$this->LoadView('home');
}

}
?>