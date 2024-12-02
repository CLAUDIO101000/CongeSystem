<?php
include 'header.php';
include 'message.php';
include_once '../Model/modelConge.php';
include_once '../Model/modelPersonnel.php';
include_once '../Model/modelTypeConge.php';
?>
<span class="dashboard">Congés</span>
<span class="dashboard"><?= $_SESSION['role'] ?> : <?= $_SESSION['username'] ?> <i class="bi bi-circle-fill blink" style="color: green; font-size: 12px;"></i></span>
</div>
</nav>

<!-- Messages d'erreurs -->
<?php if (isset($_GET['status'])): ?>
    <script>
        <?php if ($_GET['status'] == 'solde_error'): ?>
            Swal.fire({
                icon: 'error',
                title: 'Solde insuffisant',
                text: 'Ce personnel n\'a plus assez de congés.',
                confirmButtonColor: '#3085d6',
                customClass: {
                    popup: 'custom-swal-popup',
                    confirmButton: 'custom-button',
                    cancelButton: 'custom-button',
                    icon: 'custom-icon'
                }
            });
        <?php elseif ($_GET['status'] == 'service_error'): ?>
            Swal.fire({
                icon: 'error',
                title: 'Année de service insuffisante',
                text: 'Ce personnel n\'a pas encore à son actif une année de service ou plus.',
                confirmButtonColor: '#3085d6',
                customClass: {
                    popup: 'custom-swal-popup',
                    confirmButton: 'custom-button',
                    cancelButton: 'custom-button',
                    icon: 'custom-icon'
                }
            });
        <?php endif; ?>
    </script>
<?php endif; ?>

<div class="container">
    <div class="row">
        <!-- Fomulaire de saisie -->
        <div class="col-3 mt-3">
            <div class="form-group">
                <form action="../Controller/controllerConge.php" method="post">
                    <div class="mb-2">
                        <label for="personnel">Personnel</label>
                        <select name="personnel" id="personnel" class="form-select" required>
                            <?php
                            $personnel = new Personnel();
                            $result = $personnel->Afficher();
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=\"{$row['ID_Personnel']}\">{$row['Nom']} {$row['Prenom']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="dateDebut">Date de début</label>
                        <input type="date" name="dateDebut" id="dateDebut" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="dateFin">Date de fin</label>
                        <input type="date" name="dateFin" id="dateFin" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="typeConge">Type de congé</label>
                        <select name="typeConge" id="typeConge" class="form-select" required>
                            <?php
                            $typeconge = new TypeConge();
                            $result = $typeconge->Afficher();
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=\"{$row['ID_Type']}\">{$row['Type_Conge']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <button type="submit" name="ajouter" class="btn btn-success d-block w-100">Valider</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Tableau des résultats de congés -->
        <div class="col-9 mt-2">
            <!-- Recherche entre deux dates -->
            <div class="col-9 mt-2">
                <form action="conge.php" method="GET">
                    <div class="mb-2">
                        <label for="dateDebut" class="mr-2">Date de début :</label>
                        <input type="date" name="dateDebut" id="dateDebut" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="dateFin" class="mr-2">Date de fin :</label>
                        <input type="date" name="dateFin" id="dateFin" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Rechercher</button>
                    <a href="Conge.php" class="btn btn-secondary mb-2">Actualiser</a>
                </form>
                <a href="../Model/pdf.php?dateDebut=<?= isset($_GET['dateDebut']) ? $_GET['dateDebut'] : '' ?>&dateFin=<?= isset($_GET['dateFin']) ? $_GET['dateFin'] : '' ?>" class="btn btn-success d-mod mb-2" id="imprimer">Imprimer</a>
            </div>
            <table id="Table" class="table table-hover table-bordered table-custom text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Personnel</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Nombre de jours</th>
                        <th>Type de congé</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Si les dates de début et fin sont fournies via GET, faites une recherche
                    if (isset($_GET['dateDebut']) && isset($_GET['dateFin'])) {
                        $dateDebut = $_GET['dateDebut'];
                        $dateFin = $_GET['dateFin'];

                        // Appel à la méthode RechercherParDates
                        $conge = new Conge();
                        $result = $conge->RechercherParDates($dateDebut, $dateFin);
                    } else {
                        // Afficher tous les congés si les dates ne sont pas fournies
                        $conge = new Conge();
                        $result = $conge->Afficher();
                    }

                    // Affichage des résultats
                    if ($result->rowCount() > 0) {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $dateDebutConge = (new DateTime($row['Date_de_debut']))->format('d/m/Y');
                            $dateFinConge = (new DateTime($row['Date_de_fin']))->format('d/m/Y');
                            echo "<tr>
                                    <td>{$row['ID_conge']}</td>
                                    <td>{$row['Nom']} {$row['Prenom']}</td>
                                    <td>{$dateDebutConge}</td>
                                    <td>{$dateFinConge}</td>
                                    <td>{$row['Nombre_conge']}</td>
                                    <td>{$row['Type_Conge']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Aucun congé trouvé pour cette période.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#Table').DataTable({
            "paging": true,
            "ordering": true,
            "searching": false,
            "pageLength": 5,
            "lengthChange": false,
            "language": {
                "sEmptyTable": "Aucune donnée disponible dans le tableau",
                "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ enregistrements",
                "sInfoEmpty": "Affichage de 0 à 0 sur 0 enregistrements",
                "sInfoFiltered": "(filtré de _MAX_ enregistrements au total)",
                "sLengthMenu": "Afficher _MENU_ enregistrements",
                "sLoadingRecords": "Chargement...",
                "sProcessing": "Traitement...",
                "sSearch": "Rechercher :",
                "sZeroRecords": "Aucun enregistrement correspondant trouvé",
            }
        });
    });
</script>

<?php
include 'footer.php';
?>