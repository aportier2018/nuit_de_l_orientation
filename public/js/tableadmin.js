$(document).ready(function ()
{
    $('#tableadmin').DataTable(
        {
        "columnDefs": [
            { "orderable": false, "targets": 3 },
            { "orderable": false, "targets": 7 },
            { "orderable": false, "targets": 8 }
            ],
        "language":
            {
            "lengthMenu": "affichage de _MENU_ lignes par page",
            "search": "Recherche",
            "zeroRecords": "aucun résultat - Désolé",
            "info": "nombre de page _PAGE_ de _PAGES_",
            "infoEmpty": "Enregistrement invalide",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "paginate":
                {
                "next": "suivante",
                "previous": "précédente"
                }
            }
        });
        
    $('#tablemotcle').DataTable(
        {
            "columnDefs": [
                { "orderable": false, "targets": 2 },
                { "orderable": false, "targets": 3 }
            ],
            "language":
            {
                "lengthMenu": "affichage de _MENU_ lignes par page",
                "search": "Recherche",
                "zeroRecords": "aucun résultat - Désolé",
                "info": "nombre de page _PAGE_ de _PAGES_",
                "infoEmpty": "Enregistrement invalide",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "paginate":
                {
                    "next": "suivante",
                    "previous": "précédente"
                }
            }
        });

    $('#tableuser').DataTable(
        {
            "columnDefs": [
                { "orderable": false, "targets": 5 }
            ],
            "language":
            {
                "lengthMenu": "affichage de _MENU_ lignes par page",
                "search": "Recherche",
                "zeroRecords": "aucun résultat - Désolé",
                "info": "nombre de page _PAGE_ de _PAGES_",
                "infoEmpty": "Enregistrement invalide",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "paginate":
                {
                    "next": "suivante",
                    "previous": "précédente"
                }
            }
        })
    
    
});