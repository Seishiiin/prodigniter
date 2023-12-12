<?php

namespace App\Controllers;

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
    
}
