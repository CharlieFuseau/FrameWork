<?php
// Charlie Fuseau
//CTRLmain

require_once(LIB.'controller.php');

class CTRLmain extends controller 
{
	public function index()
	{
	$this->loadModel('main');
	$this->main->Find();
	$a = array('main'=>$this->main->Find(//SQL)); 
	$this->set($a);
	//Possibilité de lire plusieurs requete sur une meme page
	// $b = array('main'=>$this->main->Find(//SQL)); 
	// $this->set($b);
	$this->render('index');
	}
	
	
	
	public function read($id) //fonctionne
	{
	$this->loadModel('main');
	$this->main->Find();
	$a = array('description'=>$this->main->Find());
	$this->set($a);
	$this->render('read');
	}
	
	public function updateForm($id) //fonctionne
	{
	$this->loadModel('main');
	$this->main->Read($id);
	$a = array('main' => $this->main->totable());
	$this->set($a);
	$this->render('updateForm');
	}

	public function update() //fonctionne
	{
	$this->loadModel('main');
	$this->main->postToModel();
	$this->main->Update();
	$a =array('main'=>$this->main->Find());
	$this->set($a);
	$this->render('index');
	}

	public function delete($id) //fonctionne
	{
	$this->loadModel('main');
	$this->main->del($id);
	$a = array('main' => $this->main->Find());
	$this->set($a);
	$this->render('index');
	}
	
	public function create() // fonctionne
	{
	$this->loadModel('main');
	$this->main->postToModel();
	$this->main->Create();
	$a = array('main' => $this->main->Find());
	$this->set($a);
	$this->render('index');
	}
	
	public function createForm() //fonctionne
	{
	$this->loadModel('main');
	$this->render('createForm');
	}
}