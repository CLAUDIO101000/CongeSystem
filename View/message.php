<?php if (isset($_GET['status'])): ?>
    <script>
        <?php if ($_GET['status'] == 'succes_insert'): ?>
            Swal.fire({
                title: 'Enregistré',
                text: 'L\'enregistrement a été effectué avec succès.',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                customClass: {
                    popup: 'custom-swal-popup',
                    confirmButton: 'custom-button',
                    cancelButton: 'custom-button',
                    icon: 'custom-icon'
                }
            });
        <?php elseif ($_GET['status'] == 'succes_update'): ?>
            Swal.fire({
                title: 'Modifié !',
                text: 'La modification a été effectuée avec succès.',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                customClass: {
                    popup: 'custom-swal-popup',
                    confirmButton: 'custom-button',
                    cancelButton: 'custom-button',
                    icon: 'custom-icon'
                }
            });
        <?php elseif ($_GET['status'] == 'succes_delete'): ?>
            Swal.fire({
                title: 'Supprimé !',
                text: 'La suppression a été effectuée avec succès.',
                icon: 'success',
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