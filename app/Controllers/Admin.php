<?php

    namespace App\Controllers;

    use App\Models\Categorie;
    use App\Models\User;
    use App\Models\Produit;
    use CodeIgniter\HTTP\RedirectResponse;

    class Admin extends BaseController {
        public function postLogin() {
            $rules = [
                "login" => [
                    "label" => "'Identifiant'",
                    "rules" => "required"
                ],
                "pwd" => [
                    "label" => "'Mot de passe'",
                    "rules" => "required"
                ]
            ];

            if ($this -> validate($rules)) {
                $login = $this -> request -> getPost('login');
                $pwd = $this -> request -> getPost('pwd');
                $userModel = new User();

                if ($userModel -> isAdmin($login,$pwd)) {
                    $session = session();
                    $sessiondata = array(
                           'nom'  => $this->request->getPost('login'),
                           'admin'=> true
                        );
                    $session->set($sessiondata);
                    return redirect()->to('/admin/home');
                }
                else {
                    $data['titre'] = "Bienvenue sur ProdIgniter";
                    $data['soustitre'] = "Les identifiants saisis ne permettent pas de se connecter en tant qu'administrateur";
                    return view('template/header')
                         . view('template/menu')
                         . view('login_form',$data)
                         . view('template/footer');
                }
            }
            else {
                $data['erreurs'] = $this->validator->getErrors();
                $data['titre'] = "Bienvenue sur ProdIgniter";
                $data['soustitre'] = "Saisie invalide";
                return view('template/header')
                     . view('template/menu')
                     . view('login_form',$data)
                     . view('template/footer');
            }
        }

        public function getHome(): string {
            $data['produits'] = Produit::orderBy('qteStock', 'desc') -> get();

            return view('template/header')
                 . view('template/menu')
                 . view('admin_home',$data)
                 . view('template/footer');
        }

        public function getProd(): string {
            $data['produits'] = Produit::orderBy('nom', 'asc') -> get();
            $data['categories'] = Categorie::orderBy('libelle', 'asc') -> get();

            return view('template/header')
                 . view('template/menu')
                 . view('admin_prod', $data)
                 . view('template/footer');
        }

        public function getCateg(): string {
            $data['categories'] = Categorie::orderBy('libelle', 'asc') -> get();
            $data['produits'] = Produit::orderBy('qteStock', 'desc') -> get();

            return view('template/header')
                 . view('template/menu')
                 . view('admin_categ',$data)
                 . view('template/footer');
        }

        public function getLogout(): RedirectResponse {
            $session = session();
            $session -> destroy();
            return redirect() -> to(base_url('/'));
        }
    }

?>