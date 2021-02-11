<?php
if (isset($_POST["action"])) {

    require "BD.inc.php";

    if ($_POST["action"] == "recherche") {
        $output = "";

        $txt2 = $_POST["txt"];
        $txt = "%" . $txt2 . "%";

        $result = $conn->prepare("SELECT utilisateurs.email,utilisateurs.nom,utilisateurs.prenom,adresseClients.numcivic,adresseClients.rue,adresseClients.ville,adresseClients.pays,adresseClients.codepostal,adresseClients.numtel  FROM utilisateurs left join adresseClients on utilisateurs.id = adresseClients.id_user WHERE utilisateurs.type = :type AND CONCAT(utilisateurs.prenom,' ',utilisateurs.nom)  LIKE :txt ORDER BY utilisateurs.id DESC");
        $result->execute(array(':type' => "U", ':txt' => $txt));
        $result2 = $result->fetchAll(PDO::FETCH_ASSOC);

        if ($result2) {
            $output = '
    <table class="w3-table-all w3-center">
    <thead>
    <tr>
    <th style="width: 10%">
    Nom
    </th>
    <th style="width: 10%">
     Email
    </th>
    <th style="width: 10%">
     Numéro civic
    </th>
    <th style="width: 10%">
      Rue
    </th>
    <th  style="width: 10%">
       Ville
     </th>
     <th  style="width: 10%">
     Pays
  </th>
  <th  style="width: 10%">
  Code postal
</th>
<th  style="width: 10%">
Numéro de téléphone
</th>
  </tr>
    </thead>
    ';
            foreach ($result2 as $row) {
                $output .= '

                <tr class="w3-center">
                <td>
                ' .
                    $row['prenom'] . ' ' . $row['nom'] . '
                </td>
                <td>
                ' .
                    $row['email'] . '
                </td>
                <td> ';
                if ($row["numcivic"] == "") {$numcivic = "N/A";
                } else { $numcivic = $row["numcivic"];
                }
                $output .= $numcivic . '
                </td>
                <td> ';
                if ($row["rue"] == "") {$rue = "N/A";
                } else { $rue = $row["rue"];
                }
                $output .= $rue . '
                </td>
                <td> ';
                if ($row["ville"] == "") {$ville = "N/A";
                } else { $ville = $row["ville"];
                }
                $output .= $ville . '
                </td>
                <td> ';
                if ($row["pays"] == "") {$pays = "N/A";
                } else { $pays = $row["pays"];
                }
                $output .= $pays . '
                </td>
                <td> ';
                if ($row["codepostal"] == "") {$codepostal = "N/A";
                } else { $codepostal = $row["codepostal"];
                }
                $output .= $codepostal . '
                </td>
                <td> ';
                if ($row["numtel"] == "") {$numtel = "N/A";
                } else { $numtel = $row["numtel"];
                }
                $output .= $numtel . '
                </td>
             </tr>
     ';
            }
            $output .= '</tbody> </table>';
            echo $output;
        } else {
            echo "Aucun client ne correspond";
        }
    }

    if ($_POST["action"] == "fetch") {
        $result = $conn->prepare("SELECT utilisateurs.email,utilisateurs.nom,utilisateurs.prenom,adresseClients.numcivic,adresseClients.rue,adresseClients.ville,adresseClients.pays,adresseClients.codepostal,adresseClients.numtel  FROM utilisateurs left join adresseClients on utilisateurs.id = adresseClients.id_user WHERE utilisateurs.type = :type ORDER BY utilisateurs.id DESC");
        $result->execute(array(':type' => "U"));
        $result2 = $result->fetchAll(PDO::FETCH_ASSOC);

        $output = '
    <table class="w3-table-all w3-center">
    <thead>
      <tr>
        <th style="width: 10%">
        Nom
        </th>
        <th style="width: 10%">
         Email
        </th>
        <th style="width: 10%">
         Numéro civic
        </th>
        <th style="width: 10%">
          Rue
        </th>
        <th  style="width: 10%">
           Ville
         </th>
         <th  style="width: 10%">
         Pays
      </th>
      <th  style="width: 10%">
      Code postal
   </th>
   <th  style="width: 10%">
  Numéro de téléphone
</th>
      </tr>
    </thead>
    ';
        foreach ($result2 as $row) {
            $output .= '

    <tr class="w3-center">
        <td>
        ' .
                $row['prenom'] . ' ' . $row['nom'] . '
        </td>
        <td>
        ' .
                $row['email'] . '
        </td>
        <td> ';
            if ($row["numcivic"] == "") {$numcivic = "N/A";
            } else { $numcivic = $row["numcivic"];
            }
            $output .= $numcivic . '
        </td>
        <td> ';
            if ($row["rue"] == "") {$rue = "N/A";
            } else { $rue = $row["rue"];
            }
            $output .= $rue . '
        </td>
        <td> ';
            if ($row["ville"] == "") {$ville = "N/A";
            } else { $ville = $row["ville"];
            }
            $output .= $ville . '
        </td>
        <td> ';
            if ($row["pays"] == "") {$pays = "N/A";
            } else { $pays = $row["pays"];
            }
            $output .= $pays . '
        </td>
        <td> ';
            if ($row["codepostal"] == "") {$codepostal = "N/A";
            } else { $codepostal = $row["codepostal"];
            }
            $output .= $codepostal . '
        </td>
        <td> ';
            if ($row["numtel"] == "") {$numtel = "N/A";
            } else { $numtel = $row["numtel"];
            }
            $output .= $numtel . '
        </td>
     </tr>
     ';

        }
        $output .= '</tbody> </table>';
        echo $output;
    }

    $conn = null;
}
