<?php

    namespace App\Controllers;

    use App\Models\Categorie;
    use CodeIgniter\HTTP\RedirectResponse;

    class Categ extends BaseController {
        public function postInsertCateg(): RedirectResponse {
            $categorie = new Categorie();
            $libelle = $this -> request -> getPost('libelle');
            $categorie -> insert(['libelle' => $libelle]);

            session()->setFlashdata('insertCateg', 'La catégorie a bien été ajoutée !');
            return redirect()->to('/admin/categ');

        }

        public function getDeleteCateg($id): RedirectResponse {
            $categorie = Categorie::find($id);
            $categorie -> delete();


            session() -> setFlashdata('deleteCateg', 'La catégorie a bien été supprimée !');
            return redirect()->to('/admin/categ');
        }

        public function postUpdateCateg(): RedirectResponse {
            $categorie = Categorie::find($this -> request -> getPost('id'));
            $categorie -> libelle = $this -> request -> getPost('libelle');
            $categorie -> save();

            session() -> setFlashdata('updateCateg', 'La catégorie a bien été modifiée !');
            return redirect() -> to('/admin/categ');
        }
    }

?>