<section>
    <h2 class="text-center mb-5 fw-bold">Modifier un produit</h2>
    <div class="container">
        <?php echo form_open_multipart('prod/updateProd'); ?>
        <div class="row">
            <div class="col align-self-center">Référence :</div>
            <div class="col-10">
                <?php

                    echo form_input([
                        'type' => 'text',
                        'name' => 'ref',
                        'id' => 'ref',
                        'class' => 'form-control',
                        'readonly' => 'readonly',
                        'maxlength' => '15',
                        'placeholder' => 'Référence du produit',
                        'value' => $produit -> reference
                    ]);

                ?>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col align-self-center">Illustration :</div>
            <div class="col-8 align-self-center">
                <?php

                    echo form_upload([
                        'type' => 'file',
                        'name' => 'userfile',
                        'id' => 'userfile',
                        'class' => 'form-control',
                        'placeholder' => 'Illustration du produit',
                ]);

                ?>
            </div>
            <div class="col-2 text-center">
                <?php

                    echo img('/public/img/prod/' . strtoupper($produit -> reference) . '.png?t=' . time(), true, 'class="img-fluid rounded"');

                ?>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col align-self-center">Catégorie :</div>
            <div class="col-10">
                <?php

                    echo "<select name='categ' id='categ' class='form-control' required>";

                    foreach ($categories as $categorie) {
                        if ($produit -> categorie -> id == $categorie -> id) {
                            echo "<option value='$categorie->id' selected> $categorie->libelle </option>";
                        } else {
                            echo "<option value='$categorie->id'> $categorie->libelle </option>";
                        }
                    }

                    echo "</select>";

                ?>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col align-self-center">Nom :</div>
            <div class="col-10">
                <?php

                    echo form_input([
                        'type' => 'text',
                        'name' => 'nom',
                        'id' => 'nom',
                        'class' => 'form-control',
                        'required' => 'required',
                        'maxlength' => '50',
                        'placeholder' => 'Nom du produit',
                        'value' => $produit -> nom
                    ]);

                ?>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col align-self-center">Description :</div>
            <div class="col-10">
                <?php

                    echo form_textarea([
                        'name' => 'desc',
                        'id' => 'desc',
                        'class' => 'form-control',
                        'required' => 'required',
                        'maxlength' => '255',
                        'placeholder' => 'Description du produit',
                        'value' => $produit -> description
                    ]);

                ?>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col align-self-center">Prix unitaire HT :</div>
            <div class="col-10">
                <?php

                    echo form_input([
                        'type' => 'number',
                        'name' => 'puht',
                        'id' => 'puht',
                        'class' => 'form-control',
                        'required' => 'required',
                        'min' => '0',
                        'max' => '999999.99',
                        'step' => '0.01',
                        'placeholder' => 'Prix unitaire HT du produit',
                        'value' => $produit -> PUHT
                    ]);

                ?>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col align-self-center">Quantité en stock :</div>
            <div class="col-10">
                <?php

                    echo form_input([
                        'type' => 'number',
                        'name' => 'qtestock',
                        'id' => 'qtestock',
                        'class' => 'form-control',
                        'required' => 'required',
                        'min' => '0',
                        'max' => '999999',
                        'placeholder' => 'Quantité en stock du produit',
                        'value' => $produit -> qteStock
                    ]);

                ?>
            </div>
        </div>

        <br>

        <div class="text-center">
            <?php

                echo form_submit([
                    'type' => 'submit',
                    'class' => 'btn btn-primary',
                    'value' => 'Valider'
                ]);

            ?>
        </div>
    </div>
</section>