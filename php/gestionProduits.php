<?php
if (isset($_POST["action"])) {

    require "BD.inc.php";

    if ($_POST["action"] == "recherche") {
        $output = "";

        $txt2 = $_POST["txt"];
        $txt = "%" . $txt2 . "%";

        $result = $conn->prepare("SELECT *  FROM produits WHERE nom LIKE :txt ORDER BY id DESC");
        $result->execute(array(':txt' => $txt));
        $result2 = $result->fetchAll(PDO::FETCH_ASSOC);

        if ($result2) {
            $output = '
    <table class="w3-table-all w3-center">
    <thead>
      <tr>
        <th style="width: 10%">
        Image
        </th>
        <th style="width: 10%">
          Nom
        </th>
        <th style="width: 10%">
         prix
        </th>
        <th style="width: 10%">
          quantite
        </th>
        <th  style="width: 10%">
            Sorte
         </th>
         <th  style="width: 10%">
         Détails
      </th>
      <th  style="width: 10%">
      Ingrédients
   </th>
   <th  style="width: 10%">
   Allergènes
</th>
<th  style="width: 10%">
Statut
</th>
<th  style="width: 10%">
Actions
</th>
      </tr>
    </thead>
    ';
            foreach ($result2 as $row) {
                $output .= '

    <tr class="w3-center">
        <td>
        <img  src="' . $row['image'] . '" width="80" height="80" alt=" ' . $row['nom'] . ' ">
        </td>
        <td class="nom">
        ' .
                    $row['nom'] . '
        </td>
        <td class="prix"> ' .
                    $row['prix'] . '
        </td>
        <td class="quantite">
        ' .
                    $row['quantite'] . '
        </td>
        <td class="sorte">
        ' .
                    $row['sorte'] . '
        </td>
        <td class="details">
        ' .
                    $row['details'] . '
        </td>
        <td class="ingredients">
        ' .
                    $row['ingredients'] . '
        </td>
        <td class="allergene">
        ' .
                    $row['allergene'] . '
        </td>
        <td>
        <span id="typeStat" ';if ($row["statut"] == 1) {$statut = "Actif";
                    $output .= 'class="w3-badge w3-green">';} else { $statut = "Inactif";
                    $output .= 'class="w3-badge w3-red"> ';}
                $output .= $statut . ' </span>
        </td>
        <td>
        <a  style="margin:5px" id="' . $row["id"] . '" name="update" class="w3-button w3-blue-grey w3-round update" href="#">
                <i style="margin:5px" class="fas fa-pencil-alt"></i>
               Modifier
              </a>
              <a  style="margin:5px" id="' . $row["id"] . '" name="delete" class=" w3-button w3-red w3-round delete" href="#">
                <i style="margin:5px" class="fas fa-trash"></i>
                Supprimer
              </a>
              </td>
     </tr>
     ';
            }
            $output .= '</tbody> </table>';
            echo $output;
        } else {
            echo "Aucune pâtisserie";
        }
    }

    if ($_POST["action"] == "fetch") {
        $result = $conn->prepare("SELECT *  FROM produits ORDER BY id DESC");
        $result->execute();
        $result2 = $result->fetchAll(PDO::FETCH_ASSOC);

        $output = '
    <table class="w3-table-all w3-center">
    <thead>
      <tr>
        <th style="width: 10%">
        Image
        </th>
        <th style="width: 10%">
          Nom
        </th>
        <th style="width: 10%">
         prix
        </th>
        <th style="width: 10%">
          quantite
        </th>
        <th  style="width: 10%">
            Sorte
         </th>
         <th  style="width: 10%">
         Détails
      </th>
      <th  style="width: 10%">
      Ingrédients
   </th>
   <th  style="width: 10%">
   Allergènes
</th>
<th  style="width: 10%">
Statut
</th>
<th  style="width: 10%">
Actions
</th>
      </tr>
    </thead>
    ';
        foreach ($result2 as $row) {
            $output .= '

    <tr class="w3-center">
        <td>
        <img  src="' . $row['image'] . '" width="80" height="80" alt=" ' . $row['nom'] . ' ">
        </td>
        <td class="nom">
        ' .
                $row['nom'] . '
        </td>
        <td class="prix"> ' .
                $row['prix'] . '
        </td>
        <td class="quantite">
        ' .
                $row['quantite'] . '
        </td>
        <td class="sorte">
        ' .
                $row['sorte'] . '
        </td>
        <td class="details">
        ' .
                $row['details'] . '
        </td>
        <td class="ingredients">
        ' .
                $row['ingredients'] . '
        </td>
        <td class="allergene">
        ' .
                $row['allergene'] . '
        </td>
        <td>
        <span id="typeStat" ';if ($row["statut"] == 1) {$statut = "Actif";
                $output .= 'class="w3-badge w3-green">';} else { $statut = "Inactif";
                $output .= 'class="w3-badge w3-red"> ';}
            $output .= $statut . ' </span>
        </td>
        <td>
        <a  style="margin:5px" id="' . $row["id"] . '" name="update" class="w3-button w3-blue-grey w3-round update" href="#">
                <i style="margin:5px" class="fas fa-pencil-alt"></i>
               Modifier
              </a>
              <a  style="margin:5px" id="' . $row["id"] . '" name="delete" class=" w3-button w3-red w3-round delete" href="#">
                <i style="margin:5px" class="fas fa-trash"></i>
                Supprimer
              </a>
              </td>
     </tr>
     ';

        }
        $output .= '</tbody> </table>';
        echo $output;
    }

    if ($_POST["action"] == "insert") {

        $nom = $_POST["nom"];
        $prix = $_POST["prix"];
        $quantite = $_POST["quantite"];
        $sorte = $_POST["sorte"];
        $details = $_POST["details"];
        $ingredients = $_POST["ingredients"];
        $allergenes = $_POST["allergenes"];
        $statut = 1;
        $file1 = "img/" . $_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], "../" . $file1);
        $file2 = "pdf/" . $_FILES["pdf"]["name"];
        move_uploaded_file($_FILES["pdf"]["tmp_name"], "../" . $file2);

        $sql = "SELECT COUNT(ID) FROM produits WHERE nom = LOWER(:nom);";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':nom' => $nom));
        $nomExiste = $stmt->fetchColumn();

        if ($nomExiste > 0) {
            echo "La patisserie existe déjà, choisissez un autre nom";
        } else {
            $result = $conn->prepare("INSERT INTO produits (nom,prix,quantite,sorte,details,ingredients,allergene,image,statut,pdf) VALUES (:nom,:prix,:quantite,:sorte,:details,:ingredients,:allergene,:image,:statut,:pdf)");
            if ($result->execute(array(':nom' => $nom, ':prix' => $prix, ':quantite' => $quantite, ':sorte' => $sorte, ':details' => $details, ':ingredients' => $ingredients, ':allergene' => $allergenes, ':image' => $file1, ':statut' => $statut, ':pdf' => $file2))) {
                echo "Le produit a été ajouté";
            } else {
                echo "Le produit n'a pas pu être ajouté";
            }
        }

    }

    if ($_POST["action"] == "update") {

        $nom = $_POST["nom2"];
        $prix = $_POST["prix2"];
        $quantite = $_POST["quantite2"];
        $sorte = $_POST["sorte2"];
        $details = $_POST["details2"];
        $ingredients = $_POST["ingredients2"];
        $allergenes = $_POST["allergenes2"];
        $statut = $_POST["statut"];
        $id = $_POST["patId"];
        $ancienNom = $_POST["ancienNom"];

        if ($nom != $ancienNom) {

            $sql = "SELECT COUNT(ID) FROM produits WHERE nom = LOWER(:nom);";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':nom' => $nom));
            $nomExiste = $stmt->fetchColumn();
            if ($nomExiste > 0) {
                echo "La patisserie existe déjà, choisissez un autre nom";
                return false;
            }
        }

        if ($_FILES['image2']['name'] == "" && $_FILES['pdf2']['name'] == "") {

            $result = $conn->prepare("UPDATE produits SET nom = :nom,prix = :prix, quantite = :quantite, sorte= :sorte,details = :details,ingredients = :ingredients,allergene = :allergenes,statut = :statut  where id = :id");
            if ($result->execute(array(':nom' => $nom, ':prix' => $prix, ':quantite' => $quantite, ':sorte' => $sorte, ':details' => $details, ':ingredients' => $ingredients, ':allergenes' => $allergenes, ':statut' => $statut, ':id' => $id))) {
                echo "Le produit a été modifié";
            } else {
                echo "Le produit n'a pas pu être modifié";
            }

        } elseif ($_FILES['image2']['name'] != "" && $_FILES['pdf2']['name'] == "") {
            $file = "img/" . $_FILES["image2"]["name"];
            move_uploaded_file($_FILES["image2"]["tmp_name"], "../" . $file);

            $result = $conn->prepare("UPDATE produits SET nom = :nom,prix = :prix, quantite = :quantite, sorte= :sorte,details = :details,ingredients = :ingredients,allergene = :allergenes,image = :image,statut = :statut  where id = :id");
            if ($result->execute(array(':nom' => $nom, ':prix' => $prix, ':quantite' => $quantite, ':sorte' => $sorte, ':details' => $details, ':ingredients' => $ingredients, ':allergenes' => $allergenes, ':image' => $file, ':statut' => $statut, ':id' => $id))) {
                echo "Le produit a été modifié";
            } else {
                echo "Le produit n'a pas pu être modifié";
            }

        } elseif ($_FILES['image2']['name'] == "" && $_FILES['pdf2']['name'] != "") {
            $file = "pdf/" . $_FILES["pdf2"]["name"];
            move_uploaded_file($_FILES["pdf2"]["tmp_name"], "../" . $file);

            $result = $conn->prepare("UPDATE produits SET nom = :nom,prix = :prix, quantite = :quantite, sorte= :sorte,details = :details,ingredients = :ingredients,allergene = :allergenes,statut = :statut,pdf=:pdf  where id = :id");
            if ($result->execute(array(':nom' => $nom, ':prix' => $prix, ':quantite' => $quantite, ':sorte' => $sorte, ':details' => $details, ':ingredients' => $ingredients, ':allergenes' => $allergenes, ':statut' => $statut, ':pdf' => $file, ':id' => $id))) {
                echo "Le produit a été modifié";
            } else {
                echo "Le produit n'a pas pu être modifié";
            }

        } elseif ($_FILES['image2']['name'] != "" && $_FILES['pdf2']['name'] != "") {
            $file1 = "img/" . $_FILES["image2"]["name"];
            move_uploaded_file($_FILES["image2"]["tmp_name"], "../" . $file1);
            $file2 = "pdf/" . $_FILES["pdf2"]["name"];
            move_uploaded_file($_FILES["pdf2"]["tmp_name"], "../" . $file2);

            $result = $conn->prepare("UPDATE produits SET nom = :nom,prix = :prix, quantite = :quantite, sorte= :sorte,details = :details,ingredients = :ingredients,allergene = :allergenes,image = :image,statut = :statut,pdf = :pdf  where id = :id");
            if ($result->execute(array(':nom' => $nom, ':prix' => $prix, ':quantite' => $quantite, ':sorte' => $sorte, ':details' => $details, ':ingredients' => $ingredients, ':allergenes' => $allergenes, ':image' => $file, ':statut' => $statut, ':pdf' => $file2, ':id' => $id))) {
                echo "Le produit a été modifié";
            } else {
                echo "Le produit n'a pas pu être modifié";
            }

        }

    }

    if ($_POST["action"] == "delete") {

        $statut = 0;
        $id = $_POST["produit_id"];
        $result = $conn->prepare("UPDATE produits SET statut = :stat where id = :id");
        if ($result->execute(array(':stat' => $statut, ':id' => $id))) {
            echo "Le produit a été supprimé";
        } else {
            echo "Le produit n'a pas pu être supprimé";
        }
    }

    $conn = null;
}
