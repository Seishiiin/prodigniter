<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    class Produit extends Model {
        protected $primaryKey = 'reference';
        public $incrementing = false;
        protected $keyType = 'string';
        public $timestamps = false;

        public function categorie(): BelongsTo {
            return $this -> belongsTo('App\Models\Categorie', 'categories_id');
        }
    }

?>