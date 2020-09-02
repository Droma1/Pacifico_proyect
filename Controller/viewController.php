<?php
	require_once "./Model/viewModel.php";
	class viewController extends viewModel{

		public function index(){
			return require_once "./View/home.php";
		}

		public function view_Controller(){
			if(isset($_GET['page'])){
				//echo $_GET['page'];
				$ruta=explode("/", $_GET['page']);
				//echo $ruta[0];
				$respuesta=viewModel::view_Model($ruta[0]);
				//echo $respuesta;
			}else{
				$respuesta="home";
			}
			return $respuesta;
		}
	}
?>