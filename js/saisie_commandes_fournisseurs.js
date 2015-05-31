$(function() {
// gestion de la validation du formulaire
$("form").validate();

//cela permet de remplir et de paramétrer la DataTable : liste des demandes
		var table_dmd=$('#table_demandes').dataTable( {
				ajax: {
						"url": "traitement_bdd/chargement_table_demande_cmde_fournisseurs.php",
						"type": "POST"
				},
				lengthMenu: [[3, 5,10,15,-1], [3, 5, 10, 15,"Toutes"]],
				columnDefs: [
						{
								"targets": [ 1 ],
								"visible": false,
								"searchable": false
						},									
						{
								"targets": [ 2 ],
								"visible": false,
						},
						{
								"targets": [ 5 ],
								"visible": false,
						},
						{
								"targets": [ 6 ],
								"visible": false,
								"searchable": false
						},
						{
								"targets": [ 7 ],
								"visible": false,
						}
				],
				responsive: true
		});
// ajout de l'événèment clique sur le bouton delete pour supprimer la ligne
		$('div button:eq(0)').click(function(){
				$(this).parent().parent().parent().remove();
				maj_name();
		});

// lorque que le champ marque cela charge les modèles correspondants dans le champ modèle
		$('.ligne_champs select:eq(0)').change(function(){
				var select_modele_ligne=$('select:eq(1)',$(this).parent().parent());
				$.ajax({
						url: 'traitement_bdd/chargement_marque_modele_etat_cmde_fournisseurs.php',
						type: "POST",
						async: false,
						data: { marque: $(this).val(), type: "marque" }, 
						success: function(html) { 								
								$(select_modele_ligne).html(html);
						}
				});
				$(select_modele_ligne).trigger('change');
		});
// lorque que le champ modele cela charge les états correspondants dans le champ modèle
		$('.ligne_champs select:eq(1)').change(function(){
				var select_etat_ligne=$('select:eq(2)',$(this).parent().parent());
				$.ajax({
						url: 'traitement_bdd/chargement_marque_modele_etat_cmde_fournisseurs.php',
						type: "POST",
						async: false,
						data: { modele: $(this).val(), type: "modele" }, 
						success: function(html) { 								
								$(select_etat_ligne).html(html);
						}
				});
		});

// affiche sélectionnez d'abord une marque si on clique sur le champ modèle et qu'il est vide et que aucune marque n'a été sélectionné
		$('.ligne_champs select:eq(1)').click(function(){
				var select_marque_ligne=$('select:eq(0)',$(this).parent().parent());
				if($(this).val()=='' && $(select_marque_ligne).val()=='')
						alert("Sélectionnez d'abord une marque");
		});

// affiche sélectionnez d'abord un modèle si on clique sur le champ état et qu'il est vide et que aucun modèle  n'a été sélectionné
		$('.ligne_champs select:eq(2)').click(function(){
				var select_modele_ligne=$('select:eq(1)',$(this).parent().parent());
				if($(this).val()=='' && $(select_modele_ligne).val()=='')
						alert("Sélectionnez d'abord un modèle");
		});
// variable qui contient la toute première ligne vide du formulaire qu'on utilise par la suite pour insérer des lignes
		var clone_first_empty = $('.ligne_champs');
		clone_first_empty=$(clone_first_empty).clone(true);



// fonction pour renvoyer la première ligne vide du formulaire
function first_empty_row()
{
		var first_empty_row=-1;
		$('[class*="ligne_champs"]').each(function(num_ligne){
				var champs_vide=true;
				selects_vide = $('select',this).each(function(){
						if($(this).val()!="")
						{
								champs_vide=false;
								return false;
						}
				});
				if(selects_vide==true)
				{
						$('input',this).each(function(){
								if($(this).val()!="")
								{
										champs_vide=false;
										return false;
								}
						});
				}
				if(champs_vide==true)
				{
						first_empty_row=num_ligne+1;
						return false;
				}
				
		});
		return first_empty_row;
}

// fonction pour ajouter une ligne vide au formulaire
		function ajout_ligne_vide()
		{
				var new_ligne_champs_vide=clone_first_empty.clone(true);
				$('legend:last').before(new_ligne_champs_vide);
				maj_name();
		}
// pour que cela ajoute une ligne quand on clique sur le bouton ajouter
		$('#ajouter').click(function(){
				ajout_ligne_vide();
		});
// fonction pour mettre à jour les name des champs après insertion ou suppression de ligne
		function maj_name()
		{
				$('.ligne_champs').each(function(num_ligne){
						maj_name_dune_ligne_de_champs(this,num_ligne+1);
				});
		}
// fonction qui change tout les indices d'une ligne (name, for, id). Elle se contente de changer le numéro de ligne du name par celui qui lui est communiqué
		function maj_name_dune_ligne_de_champs(ligne_de_champs,num_row)
		{
				$('[name]',ligne_de_champs).each(function(){
						// maj des names
						var name_courant = $(this).attr('name');
						name_courant=name_courant.replace(/\d+/,num_row);
						$(this).attr('name',name_courant);
						// maj des id
						var id_courant = $(this).attr('id');
						id_courant=id_courant.replace(/\d+/,num_row);
						$(this).attr('id',id_courant);
				});
				// maj des numéro de ligne (titre)
				var titre_courant = $('h3',$(ligne_de_champs)).text();
				$('h3',$(ligne_de_champs)).text(titre_courant.replace(/\d+/,num_row));

				//maj des labels
				$('label',ligne_de_champs).each(function(){
						var for_courant = $(this).attr('for');
						for_courant=for_courant.replace(/\d+/,num_row);
						$(this).attr('for',for_courant);
				});
				if(num_row%2==0)
				{
						$(ligne_de_champs).css('background-color','white');
				}
				else
				{
						$(ligne_de_champs).css('background-color','#F9F9F9');
				}
		}

// ajoute ou remplit une ligne du formulaire lorque l'on clique sur une ligne du tableau
		$('tbody:eq(0)').on('click', 'tr', function () {
			var cells =$('td', this);
			var ref_dmd = cells.eq(1).text();
			var ligne = table_dmd.fnGetData( this );
			// variable qui va contenir la ligne à remplir ou à insérer 
			var ligne_a_remplir_ou_inserer=null;

			// on change la couleur de la ligne cliquée pour réduire les erreurs de saisie
			$(this).css('background-color','#717197');

			//récupération des données nécessaire au remplissage du formulaire
			var ref_dmd_zfw=ligne[2];
			var marque=ligne[7];
			var modele=ligne[8];
			var etat=ligne[9];
			var qte_cmdee=ligne[11]-ligne[10];
		
			num_ligne_vide=first_empty_row();
			if(num_ligne_vide==-1)
			{
					ligne_a_remplir_ou_inserer=clone_first_empty.clone(true);	
			}
			else
			{
					ligne_a_remplir_ou_inserer=$('.ligne_champs:eq('+(num_ligne_vide-1)+')')
			}
					// tableau qui contient toutes les valeurs des selects
					var table_vals_selects=[];
					table_vals_selects.push(marque);
					table_vals_selects.push(modele);
					table_vals_selects.push(etat);
					table_vals_selects.push(ref_dmd_zfw);
					// on remplit la ligne de champs qui est soit déjà dans le formulaire soit à insérer par la suite
					$('select',ligne_a_remplir_ou_inserer).each(function(indice){ // on remplit d'abord les selects
									$(this).val(table_vals_selects[indice]);
									if(indice==0 || indice==1)
											$(this).trigger('change');
					});
					$('input[name*="qte"]',ligne_a_remplir_ou_inserer).val(qte_cmdee);// puis on remplit le champ qqte à commander

					// on insère la ligne si il n'y a plus de ligne de champs vides
					if(num_ligne_vide==-1)
							$('legend:last').before(ligne_a_remplir_ou_inserer);
					maj_name();
		});
		// soumission du formulaire
		$('form:eq(0)').on('submit',function(e){

		//première partie : vérification du bon remplissage des champs
		if($('.ligne_champs').length==0)
		{
				alert('Veuillez saisir au moins une ligne de champs');
				$('#ajouter').trigger('click');
				return false;
		}



		// deuxième partie, si champs bien remplis alors on envoie le formulaire
				
				var cmde_fourni={}; // tab qui va contenir les données de la saisie
				// tab infos_vente qui contient les données à envoyer à saving_ventes.php
				var cmde_fourni = $(this).serializeArray();
				cmde_fourni.push({name: 'nbre_ligne', value: $('.ligne_champs').length });
				$.ajax({
						dataType: "json",
						url: 'traitement_bdd/saving_commandes_fournisseurs.php',
						type: 'POST',
						data: cmde_fourni, 
						success: function(retour) { // Je récupère la réponse du fichier PHP
								if(retour[0]) // si il y pas d'erreur
								{
								/*		// pour remettre à zéro le formulaire
										$('[class*="btn-primary"]').trigger('click');	
										$('#ajouter').trigger('click');
										$('form:eq(0)')[0].reset();
										// pour recharger la table des demandes
										table_dmd.api().ajax.reload();
										alert(retour[1]);*/


								}
								else //si il y a une erreur
								{
										alert(retour[1]);
								}
						}
				});
		});
});


