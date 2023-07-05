// Qunad on Selectionne un produit dans la liste deroulante
let currentProduit = {
    id: null,
    nom: null,
    quantite: null,
    prix: null,
    calculerTotal: () => {
        return {
            prixUnitaire: currentProduit.prix,
            total: currentProduit.prix * currentProduit.quantite
        }
    }
}

let client = {
    nom: $("#nomClient").val(),
    prenom: $("#prenomClient").val(),
}

let vente = {
    client: null,
    sommeRecue: 0,

    getNombreProduit: () => {
        let res = 0;
        $("#tableauListeProduit tr").each(function () {
            res += parseInt($(this).attr("data-quantiteProduit"))
        });

        $("#nombreProduitSpan").text(res);

        console.log("nombres de produits:");
        console.log(res);

        return res;
    },

    chargerListeProduit: () => {
        let listeProduit = Array();

        $("#tableauListeProduit tr").each(function () {
            let ligneTmp = {
                idProduit: $(this).attr("data-idProduit"),
                quantite: $(this).attr("data-quantiteProduit"),
            }

            listeProduit.push(ligneTmp);
        });

        console.log("Liste des produits:");
        console.log(listeProduit);

        return listeProduit;
    },

    calculerTotalHorsRemise: () => {
        let res = 0;
        $("#tableauListeProduit tr").each(function () {
            let prixTmp = $(this).attr("data-prix");

            res += prixTmp * $(this).attr("data-quantiteProduit");
        });

        $("#montantHorsRemise").text(res);

        console.log("montant hors remise:");
        console.log(res);

        return res;
    },

    calculerMontantARemettre: () => {
        let res = vente.sommeRecue - vente.calculerTotalHorsRemise();

        $("#montantARemettre").text(res);

        console.log("montant a remettre:");
        console.log(res);

        return res;
    },

    reload: () => {
        vente.calculerMontantARemettre();
        vente.getNombreProduit();
        vente.chargerListeProduit();
    }
}

$("#selectProduitZone1").on("input", () => {
    $("#quantiteZone1").val(null);
    $("#quantiteZone1").attr("max", $("#selectProduitZone1 option:selected").attr("data-stock"))
    $("#quantiteZone1").attr(
        "placeholder",
        `Min: 1 | Max: ${$("#selectProduitZone1 option:selected").attr("data-stock")}`
    );
    currentProduit.id = $("#selectProduitZone1 option:selected").attr("data-idProduit");
    currentProduit.nom = $("#selectProduitZone1 option:selected").text()
    currentProduit.prix = $("#selectProduitZone1 option:selected").attr("data-prixDet")

    $("#prixDetZone1").val(currentProduit.prix);

    console.log("Les infromation de votre produit :");
    console.log(currentProduit);
});

$("#selectProduitZone1").on("change", () => {
    $("#quantiteZone1").val(null);
    $("#quantiteZone1").attr("max", $("#selectProduitZone1 option:selected").attr("data-stock"))
    $("#quantiteZone1").attr(
        "placeholder",
        `Min: 1 | Max: ${$("#selectProduitZone1 option:selected").attr("data-stock")}`
    );
    currentProduit.id = $("#selectProduitZone1 option:selected").attr("data-idProduit");
    currentProduit.nom = $("#selectProduitZone1 option:selected").text()
    currentProduit.prix = $("#selectProduitZone1 option:selected").attr("data-prixDet")

    $("#prixDetZone1").val(currentProduit.prix);

    console.log("Les infromation de votre produit :");
    console.log(currentProduit);
});

$("#quantiteZone1").on("input", () => {
    currentProduit.quantite = $("#quantiteZone1").val();

    console.log("Les infromation de votre produit :");
    console.log(currentProduit);
});

$("#selectProduitZone1").trigger("input");
$("#quantiteZone1").trigger("input");

// si on soumet le formulaire de selection de produit
$("#form1").on("submit", function (e) {
    let component = `
        <tr data-idProduit="${currentProduit.id}"
            data-nomProduit="${currentProduit.nom}" 
            data-prix="${currentProduit.prix}" 
            data-quantiteProduit="${currentProduit.quantite}"
        >
            <td>${currentProduit.nom}</td>
            <td>${currentProduit.calculerTotal().prixUnitaire}</td>
            <td>${currentProduit.quantite}</td>
            <td>${currentProduit.calculerTotal().total}</td>
            <td class="actionZone">
                <div>
                    <span class="deleteBtn" title="supprimer">
                        <i class="fa fa-trash-alt"></i>
                    </span>
                    <span class="modifierBtn" title="Modifier">
                        <i class="fa fa-pen-alt"></i>
                    </span>
                </div>
            </td>
        </tr>
    `;

    // on verifie si on a deja le produit dans le tableau

    let selected = false;

    $("#tableauListeProduit tr").each(function () {
        if ($(this).attr("data-idProduit") == currentProduit.id) {
            selected = true;
        }
    });

    if (selected) {
        alert("Ce produit est deja selectionner. vous pouver le supprimer ou modifier la quantite");
    }
    else {
        $("#tableauListeProduit").append(component);
    }

    // pour supprimer lelement du tableau
    $(".deleteBtn").click(function (e) {
        if (confirm("Etes vous sur de vouloir supprimer tout ce produit du panier ?")) {
            $(this).parent().parent().parent().remove();

            vente.reload();
        }
    });

    $(".modifierBtn").click(function (e) {
        let id = $(this).parent().parent().parent().attr("data-idProduit");
        let nom = $(this).parent().parent().parent().attr("data-nomProduit");
        let prix = $(this).parent().parent().parent().attr("data-prixDet");
        let qt = $(this).parent().parent().parent().attr("data-quantiteProduit");

        currentProduit.id = id;
        currentProduit.nom = nom;
        currentProduit.prix = prix;
        currentProduit.quantite = qt;

        $("#selectProduitZone1 option").removeAttr('selected').filter("[data-idProduit='" + id + "']").attr("selected", true);
        $("#quantiteZone1").val(qt);
        $("#prixDetZone1").val(prix);

        $(this).parent().parent().parent().remove();

        vente.reload();
    });

    vente.reload();

    e.preventDefault();
});

// pour vider le tableau
$("#btnViderTableau").click(function (e) {
    e.preventDefault();
    if (confirm("Etes vous sur de vouloir supprimer tout les produits du panier ?")) {
        $("#tableauListeProduit").empty();

        vente.reload();
    }
});

// Pour changer les info du client
$("#nomClient").on("change", function () {
    client.nom = $("#nomClient").val();
    console.log(client.nom)
});

$("#prenomClient").on("input", function () {
    client.prenom = $("#prenomClient").val();
    console.log(client.prenom)

});

// On charge les info de paimement
$("#sommeRecu").on("input", function () {
    vente.sommeRecue = $("#sommeRecu").val();
    vente.reload();
});

// pour valider la vente

$("#formFinalVente").on("submit", function (e) {
    $("#validerBtnZone button").addClass("btnLoad");

    let lancerRequest = true;

    if (vente.chargerListeProduit().length < 1) {
        alert("Veuillez selectionnez au moin un produit");
        lancerRequest = false;
    }
    if (vente.sommeRecue < vente.calculerTotalHorsRemise()) {
        alert("Le client n'a pas tout payer");
        lancerRequest = false;
    }

    if (lancerRequest) {
        $.ajax({
            type: "POST",
            url: "../script/ajouter_vente.php",
            data: {
                token: 'djessyaroma1234',
                listeProduit: vente.chargerListeProduit(),
                nom: client.nom,
                prenom: client.prenom
            },
            success: function () {
                alert("Vente effectuer");
                window.location.reload(true);
            },
            error: function () {
                alert("Une erreur est sur survenue. veuillez verifier votre stoque de produit");
            }
        });
    }

    $("#validerBtnZone button").removeClass("btnLoad");
    e.preventDefault();
});

// pout rechercher un produit
$("#searchInput").on("input", function (e) {
    let value = $("#searchInput").val();

    $.expr[":"].contains = $.expr.createPseudo(function (arg) {
        return function (elem) {
            return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
        };
    });

    $("#selectProduitZone1 option").removeAttr('selected');

    $("#selectProduitZone1").find(
        `option:contains(${value})`
    ).show();

    $("#selectProduitZone1").find(
        `option:contains(${value})`
    ).eq(
        0
    ).prop("selected", true);

    $("#selectProduitZone1").trigger("change");

});