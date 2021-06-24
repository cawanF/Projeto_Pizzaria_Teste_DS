<?php

  namespace App\Controllers;
  //HomeController estende Controller pai
  class HomeController extends Controller {
    public function index() { //Nome da action é o mesmo que o nome do método. Utilizamos o método da classe pai para renderizar a view.
      $this->render('home/index');
    }
  }
?>