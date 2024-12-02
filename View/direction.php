<?php
include 'header.php';
include 'message.php';
?>
<span class="dashboard">Directions</span>
<span class="dashboard"><?= $_SESSION['role'] ?> : <?= $_SESSION['username'] ?> <i class="bi bi-circle-fill blink" style="color: green; font-size: 12px;"></i></span>
</div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-3 mt-3">
            <div class="form-group">
                <form action="../Controller/controllerDirection.php" method="post">
                    <div class="mb-2 mt-1">
                        <label for="direction" class="form-label">Direction</label>
                        <input type="text" name="direction" class="form-control" placeholder="Direction" id="" required>
                    </div>
                    <div class="mb-2">
                        <button type="submit" value="ajoute" name="ajoute" class="btn btn-success d-block w-100" style="max-width: 295px;">Valider</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-9 mt-3">
            <table id="MyTable" class="table table-hover table-bordered table-custom text-center">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Direction</th>
                        <th><i class="bi-brush"></i></th>
                        <th><i class="bi-trash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once '../Model/connexion.php';
                    include_once '../Model/modelDirection.php';
                    $direction = new Direction();
                    $affiche = $direction->Afficher();
                    while ($rows = $affiche->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td><?= $rows['ID_Direction'] ?></td>
                            <td><?= $rows['Direction'] ?></td>
                            <td>
                                <a href="" data-bs-toggle="modal" data-bs-target="#myModal" onclick="edit('<?= $rows['ID_Direction'] ?>', '<?= $rows['Direction'] ?>')">
                                    <i class="bi-brush"></i>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" onclick="confirmDelete('<?= $rows['ID_Direction'] ?>')">
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
        <div class="modal-content mx-auto" style="max-width: 350px;">
            <div class="modal-header" style="height: 50px;">
                <h5 class="modal-title">Modification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body ">
                <div class="form-signin">
                    <form action="../Controller/controllerDirection.php" method="post">
                        <input type="hidden" name="dirId" id="dirId">
                        <div class="mb-2 mt-1">
                            <label for="direction" class="form-floating"></label>
                            <input type="text" name="direc" class="form-control" placeholder="Direction" id="direc" required>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <button type="submit" name="modification" value="modification" class="btn btn-primary" style="max-width: 295px;">Confirmer</button>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Êtes-vous sûr de vouloir supprimer cette direction ?',
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
                window.location.href = '../Controller/controllerDirection.php?id=' + id + '&del=1';
            }
        });
    }

    function edit(id, dir) {
        document.getElementById('dirId').value = id;
        document.getElementById('direc').value = dir;
    }
</script>

<script src="../Public/js/searchPagination.js"></script>

<?php
include 'footer.php';
?>