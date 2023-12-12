<script>
    function updateCateg(id, libelle) {
        document.getElementById('libelleCateg').value = libelle;
        document.getElementById('idCateg').value = id;
    }
</script>

<section>
    <?php

        if (session() -> getFlashdata('insertCateg')) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                echo session() -> getFlashdata('insertCateg');
                echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if (session() -> getFlashdata('updateCateg')) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>";
                echo session() -> getFlashdata('updateCateg');
                echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if (session() -> getFlashdata('deleteCateg')) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
                echo session() -> getFlashdata('deleteCateg');
                echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

    ?>

    <?php

        echo form_open('/categ/insertCateg', 'class="form-inline"');
            echo "<div class='form-group'>";
                echo form_label('', 'libelle', array('class' => 'mr-2'));
                echo "<div class='form-group'>";
                    echo form_input('libelle', "",  array('class' => 'form-control mr-2', 'placeholder' => 'Nom de la catégorie'));
                    echo form_submit('submit', 'Ajouter', array('class' => 'btn bg-viva-magenta'));
                echo "</div>";
            echo "</div>";
        echo form_close();

    ?>

    <table class="table table-striped">
        <?php

            echo "<thead class='bg-viva-magenta'>";
                echo "<tr>";
                    echo "<th scope='col'>Nom de la catégorie</th>";
                    echo "<th scope='col'>Nombre de produits</th>";
                    echo "<th scope='col'>Valeur de la catégorie</th>";
                    echo "<th scope='col'></th>";
                echo "</tr>";
            echo "</thead>";

            echo "<tbody>";
                $total = 0;
                foreach ($categories as $categorie) {
                    $produitsCateg = $produits -> where('categories_id', $categorie -> id);
                    $valeurCateg = 0;
                    foreach ($produitsCateg as $produitCateg) {
                        $valeurCateg += $produitCateg -> PUHT * $produitCateg -> qteStock;
                    }
                    echo "<tr>";
                        echo "<td>" . $categorie -> libelle . "</td>";
                        echo "<td>" . $produitsCateg -> count() . "</td>";
                        echo "<td>" . number_format($valeurCateg, "2", ",", " ") . "€</td>";
                        echo "<td>";
                            echo "<button type='button' onclick='updateCateg(\"" . $categorie -> id . "\", \"" . $categorie -> libelle . "\")' class='btn' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-pen-to-square'></i></button>";
                            if ($produitsCateg -> count() == 0) {
                                echo anchor("/categ/deleteCateg/$categorie->id", "<i class='fa-solid fa-trash'></i>");
                            }
                        echo "</td>";
                    echo "</tr>";
                }

        ?>
    </table>

    <div class="statistiques">
        <?php

        $nbCategVide = 0;

        foreach ($categories as $categorie) {
            $produitsCateg = $produits -> where('categories_id', $categorie -> id);
            if ($produitsCateg -> count() == 0) {
                $nbCategVide++;
            }
        }

        ?>

        <h3>
            <i class="fa-solid fa-chart-line"></i>
            Statistiques :
        </h3>

        <div class="container">
            <div class="row">
                <div class="col">
                    <p>Nombre de catégories : <span class="badge"><?php echo count($categories); ?></span></p>
                </div>

                <div class="col">
                    <p>Nombre de catégories avec des produits : <span class="badge"><?php echo count($categories) - $nbCategVide; ?></span></p>
                </div>

                <div class="col">
                    <p>Nombre de catégories sans produits : <span class="badge"><?php echo $nbCategVide; ?></span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php echo form_open('/categ/updateCateg', 'class="form-inline"'); ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier la catégorie</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php

                    echo form_input('id', "",  array('hidden' => 'hidden', 'id' => 'idCateg'));

                    echo "<div class='form-group'>";
                        echo "<div class='form-group'>";
                            echo form_input('libelle', "",  array('class' => 'form-control mr-2', 'placeholder' => "Nom de la catégorie", 'id' => 'libelleCateg'));
                        echo "</div>";
                    echo "</div>";

            ?>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <?php echo form_submit('submit', 'Modifier', array('class' => 'btn bg-viva-magenta')); ?>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>