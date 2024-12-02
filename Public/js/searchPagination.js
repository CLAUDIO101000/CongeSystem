$(document).ready(function() {
    $('#MyTable').DataTable({
        "paging": true,
        "ordering": true,
        "searching": true,
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
