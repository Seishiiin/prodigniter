<section>
    <table class="table table-striped">
        <?php

            echo "<thead class='bg-viva-magenta'>";
                echo "<tr>";
                    echo "<th id='imageProduct' scope='col'><i class='fa-solid fa-image'></i></th>";
                    echo "<th scope='col'>Produit</th>";
                    echo "<th scope='col'>Prix unitaire</th>";
                    echo "<th scope='col'>Quantité</th>";
                    echo "<th scope='col'>Valeur stock</th>";
                    echo "<th scope='col'></th>";
                echo "</tr>";
            echo "</thead>";

            echo "<tbody>";
                $total = 0;
                foreach ($produits as $produit) {
                    $total += $produit -> PUHT * $produit -> qteStock;
                    echo "<tr>";
                        echo "<td>" . img('/public/img/prod/'. $produit -> reference . '.png',true,'class="img-fluid rounded"') . "</td>";
                        echo "<td>" . $produit -> nom . "</td>";
                        echo "<td>" . number_format($produit -> PUHT, "2", ",", " ") . "€</td>";
                        echo "<td>" . $produit -> qteStock . "</td>";
                        echo "<td>" . number_format($produit -> PUHT * $produit -> qteStock, "2", ",", " ") . "€</td>";
                        echo "<td>";
                            echo anchor("/prod/MinusProduct/$produit->reference", "<i class='fa-solid fa-minus' id='minusProduct'></i>");
                            echo anchor("/prod/PlusProduct/$produit->reference", "<i class='fa-solid fa-plus' id='plusProduct'></i>");
                        echo "</td>";
                    echo "</tr>";
                }
            echo "</tbody>";

        ?>
    </table>

    <div class="statistiques">
        <?php

            $nbProduitsTotal = count($produits);
            $nbProduitsEnStock = 0;
            $nbProduitsHorsStock = 0;

            foreach ($produits as $produit) {
                if ($produit -> qteStock > 0) {
                    $nbProduitsEnStock++;
                } else {
                    $nbProduitsHorsStock++;
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
                    <p>Nombre de produits : <span class="badge"><?php echo count($produits); ?></span></p>
                </div>

                <div class="col">
                    <p>Nombre de produits en stock : <span class="badge"><?php echo $nbProduitsEnStock; ?></span></p>
                </div>

                <div class="col">
                    <p>Nombre de produits hors stock : <span class="badge"><?php echo $nbProduitsHorsStock; ?></span></p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <p>Valeur totale du stock : <span class="badge"><?php echo number_format($total, "2", ",", " "); ?>€</span></p>
                </div>

                <div class="col"></div>
                <div class="col"></div>
            </div>
        </div>
    </div>
</section>