<section>
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
                        echo "<td>" . substr($produit -> description, 0, 65) . "...</td>";
                        echo "<td>" . $produit -> categorie -> libelle . "</td>";
                        echo "<td>";
                            echo anchor("/prod/updateProd/$produit->id", "<i class='fa-solid fa-pen-to-square'></i>");
                            if ($produit -> qteStock == 0) {
                                echo anchor("/prod/deleteProd/$produit->id", "<i class='fa-solid fa-trash'></i>");
                            }
                        echo "</td>";
                    echo "</tr>";
                }
            echo "</tbody>";

        ?>
    </table>
</section>