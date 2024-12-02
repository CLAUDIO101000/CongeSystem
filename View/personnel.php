<?php
include 'header.php';
?>
<span class="dashboard">Personnel</span>
<span class="dashboard"><?= $_SESSION['role'] ?> : <?= $_SESSION['username'] ?> <i class="bi bi-circle-fill blink" style="color: green; font-size: 12px;"></i></span>
</div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-3 mt-3">
            <div class="form-group">
                <form action="../Controller/controllerPersonnel.php" method="post">
                    <?php include 'message.php'; ?>
                    <div class="mb-2">
                        <input type="text" name="nom" class="form-control" placeholder="Nom" value="" id="test2" required>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="prenom" class="form-control" placeholder="Prénom" id="test3" required>
                    </div>
                    <div class="mb-2 mt-1">
                        <label for="dnais">Date de naissance</label>
                        <input type="date" name="dnais" class="form-control" required>
                    </div>
                    <div class="mb-2 mt-1">
                        <label for="demb">Date d'embauche</label>
                        <input type="date" name="demb" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="adr" id="test4" class="form-control" placeholder="Adresse" required>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="contact" id="test6" class="form-control" placeholder="Contact" required>
                    </div>
                    <div class="mb-2">
                        <input type="email" name="email" id="test5" class="form-control" placeholder="E-mail" required>
                    </div>
                    <?php
                    include_once '../Model/connexion.php';
                    include_once '../Model/modelDirection.php';
                    include_once '../Model/modelFonction.php';
                    $direction = new Direction();
                    $affiche = $direction->Afficher();
                    $directions =  $affiche->fetchAll(PDO::FETCH_ASSOC);
                    $fonction = new Fonction();
                    $afficher = $fonction->Afficher();
                    $fonctions =  $afficher->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <div class="mb-2 mt-1">
                        <label for="comboD">Direction</label>
                        <select name="comboDirection" id="comboD" style="width: 210px;" class="form-select">
                            <?php foreach ($directions as $direc) { ?>
                                <option value=" <?= $direc['ID_Direction'] ?>"><?= $direc['Direction'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-2 mt-1">
                        <label for="comboF">Fonction</label>
                        <select name="comboFonction" id="comboF" style="width: 210px;" class="form-select">
                            <?php foreach ($fonctions as $fonc) { ?>
                                <option value=" <?= $fonc['ID_Fonction'] ?>"><?= $fonc['Fonction'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-1">
                        <button type="submit" value="ajoute" name="ajoute" class="btn btn-success d-block w-100" style="max-width: 295px;">Valider</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-9 mt-3">
            <table id="MyTable" class="table table-hover table-bordered table-custom text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Contact</th>
                        <th>Solde congées</th>
                        <th>Année de service</th>
                        <th>Direction</th>
                        <th>Fonction</th>
                        <th><i class="bi-brush"></i></th>
                        <th><i class="bi-trash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once '../Model/modelPersonnel.php';
                    $pers = new Personnel();
                    $affiche = $pers->Afficher();
                    while ($rows = $affiche->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td> <?= $rows['ID_Personnel'] ?> </td>
                            <td> <?= $rows['Nom'] . " " . $rows['Prenom'] ?></td>
                            <td> <?= $rows['Contact'] ?></td>
                            <td> <?= $rows['Solde_Conge'] . " jours" ?></td>
                            <td> <?= $rows['Année_de_service'] . " ans" ?></td>
                            <td> <?= $rows['Direction'] ?></td>
                            <td> <?= $rows['Fonction'] ?></td>
                            <td>
                                <a href="" data-bs-toggle="modal" data-bs-target="#myModal"
                                    onclick="edit('<?= $rows['ID_Personnel'] ?>', 
                                        '<?= $rows['Nom'] ?>', 
                                        '<?= $rows['Prenom'] ?>', 
                                        '<?= $rows['Adresse'] ?>', 
                                        '<?= $rows['Contact'] ?>', 
                                        '<?= $rows['E_Mail'] ?>',
                                        '<?= $rows['Date_de_naissance'] ?>', 
                                        '<?= $rows['Date_d_embauche'] ?>',
                                        '<?= $rows['ID_Direction'] ?>',
                                        '<?= $rows['ID_Fonction'] ?>'
                                        )">
                                    <i class="bi-brush"></i>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" onclick="confirmDelete('<?= $rows['ID_Personnel'] ?>')">
                                    <i class="bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal" id="myModal">

    <div class="modal-dialog">
        <div class="modal-content mx-auto" style="max-width: 400px;">

            <!-- Modal Header -->
            <div class="modal-header" style="height: 50px;">
                <h5 class="modal-title">Modification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-signin">
                    <form action="../Controller/controllerPersonnel.php" method="post">
                        <div class="mb-2">
                            <input type="text" name="matrP" id="persMatr" hidden>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-2">
                                    <input type="text" name="nomP" class="form-control" placeholder="Nom" id="persN" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <input type="text" name="prenomP" class="form-control" placeholder="Prénom" id="persP" required>
                                </div>

                            </div>
                        </div>
                        <div class="mb-2 mt-1">
                            <label for="dnais" class="form-floating">Date de naissance</label>
                            <input type="date" name="dnaisP" id="persNs" class="form-control" required>
                        </div>
                        <div class="mb-2 mt-1">
                            <label for="demb">Date d'embauche</label>
                            <input type="date" name="dembP" id="persE" class="form-control" required>
                        </div>
                        <div class="mb-2 mt-1">
                            <input type="text" name="adrP" id="persA" class="form-control" placeholder="Adresse" required>
                        </div>
                        <div class="mb-2 mt-1">
                            <input type="text" name="contactP" id="contP" class="form-control" placeholder="Contact" required>
                        </div>
                        <div class="mb-2 mt-1">
                            <input type="email" name="emailP" id="mailP" class="form-control" placeholder="E-mail" required>
                        </div>
                        <div class="mb-2 mt-1">
                            <label for="comboDirP">Direction</label>
                            <select name="comboDirectionP" id="comboDirP" class="form-select">
                                <?php foreach ($directions as $direc) { ?>
                                    <option value="<?= htmlspecialchars($direc['ID_Direction'], ENT_QUOTES, 'UTF-8') ?>">
                                        <?= htmlspecialchars($direc['Direction'], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-2 mt-1">
                            <label for="comboFonP">Fonction</label>
                            <select name="comboFonctionP" id="comboFonP" class="form-select">
                                <?php foreach ($fonctions as $fonc) { ?>
                                    <option value="<?= htmlspecialchars($fonc['ID_Fonction'], ENT_QUOTES, 'UTF-8') ?>">
                                        <?= htmlspecialchars($fonc['Fonction'], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <br>
                        <div class="mb-2">
                            <div class="row">
                                <div class="col">
                                    <button type="submit" name="modification" value="modification" class="btn btn-primary" style="max-width: 295px;">Confirmer</button>
                                </div>

                                <div class="col d-flex justify-content-end">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../Public/js/searchPagination.js"></script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Êtes-vous sûr de vouloir supprimer ce personnel ?',
            text: "Vous ne pourrez pas revenir en arrière!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui',
            cancelButtonText: 'Non',
            customClass: {
                popup: 'custom-swal-popup',
                confirmButton: 'custom-button',
                cancelButton: 'custom-button',
                icon: 'custom-icon'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../Controller/controllerPersonnel.php?id=' + id + '&del=1';
            }
        });
    }
</script>

<script>
    function edit(id, nom, pr, adr, contact, mail, dn, de, direct, fonct) {
        console.log('ID:', id);
        console.log('Nom:', nom);
        console.log('Prénom:', pr);
        console.log('Adresse:', adr);
        console.log('Contact:', contact);
        console.log('Email:', mail);
        console.log('Date de naissance:', dn);
        console.log('Date d\'embauche:', de);
        console.log('Direction:', direct);
        console.log('Fonction:', fonct);

        $('#persN').val(nom);
        $('#persP').val(pr);
        $('#persA').val(adr);
        $('#contP').val(contact);
        $('#mailP').val(mail);
        $('#persNs').val(dn);
        $('#persE').val(de);
        $('#persMatr').val(id);
        $('#comboDirP').val(direct);
        $('#comboFonP').val(fonct);
        $('#myModal').modal('show');
    }
</script>

<?php
include 'footer.php';
?>