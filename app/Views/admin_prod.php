<section>
    <?php

        if (session() -> getFlashdata('insertProd')) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
            echo session() -> getFlashdata('insertProd');
            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if (session() -> getFlashdata('updateProd')) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>";
            echo session() -> getFlashdata('updateProd');
            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if (session() -> getFlashdata('deleteProd')) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
            echo session() -> getFlashdata('deleteProd');
            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

    ?>

    <table class="table table-striped">
        <?php

            echo "<thead class='bg-viva-magenta'>";
                echo "<tr>";
                    echo "<th id='imageProduct' scope='col'><i class='fa-solid fa-image'></i></th>";
                    echo "<th scope='col'>Produit</th>";
                    echo "<th scope='col'>Description</th>";
                    echo "<th scope='col'>Catégorie</th>";
                    echo "<th scope='col'></th>";
                echo "</tr>";
            echo "</thead>";

            echo "<tbody>";
                foreach ($produits as $produit) {
                    echo "<tr>";
                        echo "<td>" . img('/public/img/prod/'. $produit -> reference . '.png',true,'class="img-fluid rounded"') . "</td>";
                        echo "<td>" . $produit -> nom . "</td>";
                        if (strlen($produit -> description) > 65) {
                            echo "<td>" . substr($produit -> description, 0, 65) . "...</td>";
                        } else {
                            echo "<td>" . $produit -> description . "</td>";
                        }
                        echo "<td>" . $produit -> categorie -> libelle . "</td>";
                        echo "<td>";
                            echo anchor("/prod/updateProd/$produit->reference", "<i class='fa-solid fa-pen-to-square'></i>");
                            if ($produit -> qteStock == 0) {
                                echo anchor("/prod/deleteProd/$produit->reference", "<i class='fa-solid fa-trash'></i>");
                            }
                        echo "</td>";
                    echo "</tr>";
                }
            echo "</tbody>";

        ?>
    </table>

    <?php echo anchor("prod/insertProd", "<button id='insertProd'><i class='fa-solid fa-add'></i> Ajouter un produit</button>") ?>
</section>