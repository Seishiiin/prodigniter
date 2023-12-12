<?php

namespace App\Controllers;

class Home extends BaseController {
    public function index() {
        $session = session();
        if ($session -> get('admin')) {
            return redirect() -> to('/admin/home');
        } else {
            $data['titre'] = "Bienvenue sur Prodigniter";
            $data['soustitre'] = "Entrez vos identitifiants";

            return view('template/header') .
                   view('login_form', $data);
        }
    }
}