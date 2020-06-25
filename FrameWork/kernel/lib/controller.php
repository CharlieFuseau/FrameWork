<?php
class controller 
{
	protected $viewvar = array();
	
	public function set ($v)
	{
		$this->viewvar = array_merge($this->viewvar, $v);
	}
	
	public function controlleur()
	{
		echo "Erreur controlleur";
	}
	
	public function loadModel($model)
	{
		require(MODEL."$model.php");
		$this->$model = new $model();
	}
	
	public function render($view)
	{
		extract($this->viewvar);
		ob_start();
		$objet = str_replace('CTRL','',get_class($this));
		require(VIEW.$objet."/$view.php");
		$content = ob_get_clean();
		require(VIEW."layout/default.php");
	}
}
?>