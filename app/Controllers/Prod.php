<?php

    namespace App\Controllers;

    use App\Models\Categorie;
    use App\Models\Produit;
    use CodeIgniter\HTTP\RedirectResponse;

    class Prod extends BaseController {
        public function getAll(): string {
            $data['titre'] = "Liste des produits";
            $data['soustitre'] = "Tous les produits actuellement disponibles en magasin";
            $data['produits'] = Produit::all();

            return view('template/header')
                 . view('template/menu')
                 . view('home',$data)
                 . view('template/footer');
        }

        public function getMinusProduct($reference): RedirectResponse {
            $produit = Produit::find($reference);

            if ($produit -> qteStock > 0) {
                $produit -> qteStock -= 1;
                $produit -> save();
            }

            return redirect() -> to(base_url('/admin/home'));
        }

        public function getPlusProduct($reference): RedirectResponse {
            $produit = Produit::find($reference);
            $produit -> qteStock += 1;
            $produit -> save();

            return redirect() -> to(base_url('/admin/home'));
        }

        public function getDeleteProd($id): RedirectResponse {
            $produit = Produit::find($id);
            $produit -> delete();

            unlink('./public/img/prod/' . strtoupper($produit -> reference) . '.png');

            session() -> setFlashdata('deleteProd', 'Le produit a bien été supprimé !');
            return redirect() -> to('/admin/prod');
        }

        public function getInsertProd(): string {
            $data['categories'] = Categorie::all();

            return view('template/header')
                 . view('template/menu')
                 . view('prod_insert', $data)
                 . view('template/footer');
        }

        public function postInsertProd(): RedirectResponse {
            $produit = new Produit();

            $produit -> reference = $this -> request -> getPost('ref');
            $produit -> nom = $this -> request -> getPost('nom');
            $produit -> description = $this -> request -> getPost('desc');
            $produit -> PUHT = $this -> request -> getPost('puht');
            $produit -> dateAjout = date('Y-m-d');
            $produit -> qteStock = $this -> request -> getPost('qtestock');
            $produit -> categories_id = $this -> request -> getPost('categ');

            $image = $this -> request -> getFile('userfile');
            $image -> move('./public/img/prod', strtoupper($produit -> reference) . '.png');

            $produit -> save();

            session() -> setFlashdata('insertProd', 'Le produit a bien été ajouté !');
            return redirect() -> to('/admin/prod');
        }

        public function getUpdateProd($id): string {
            $data['produit'] = Produit::find($id);
            $data['categories'] = Categorie::all();

            return view('template/header')
                 . view('template/menu')
                 . view('prod_update', $data)
                 . view('template/footer');
        }

        public function postUpdateProd(): RedirectResponse {
            $produit = Produit::find($this -> request -> getPost('ref'));

            if ($produit != null) {
                $produit -> reference = $this -> request -> getPost('ref');
                $produit -> nom = $this -> request -> getPost('nom');
                $produit -> description = $this -> request -> getPost('desc');
                $produit -> PUHT = $this -> request -> getPost('puht');
                $produit -> qteStock = $this -> request -> getPost('qtestock');
                $produit -> categories_id = $this -> request -> getPost('categ');

                $image = $this -> request -> getFile('userfile');
                if ($image -> getSize() > 0) {
                    $image -> move('./public/img/prod', strtoupper($produit -> reference) . '.png');
                }

                $produit -> save();

                session() -> setFlashdata('updateProd', 'Le produit a bien été modifié !');
                return redirect() -> to('/admin/prod');
            } else {
                session() -> setFlashdata('updateProd', 'Le produit n\'existe pas !');
                return redirect() -> to('/admin/prod');
            }
        }
    }

?>