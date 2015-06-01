	// pour inclure le fichier fonctions.js
	document.write("<script type='text/javascript' src=\"js/fonctions.js\"></script>" );
		$(function() {
// cela sert à remplir et à paramétrer la DataTable
		// cette table contiendra toutes les ref externe des commandes à destination de BEE lorsque BEE fera la réception
		// cette table contiendra toutes les ref externe des commandes à destination de ZFW ( expedition_bee + commandes_fourni à detination de bee ) lorsque ZFW fera la réception
		// pour adpater le contenu au destinataire, il faut envoyer dans la requête ajax le champ destinataire

				var table_ref_externe = $('#liste_ref_externe_fourni').dataTable( {
						ajax: {
								"dataType" : "json",
								"url": "traitement_bdd/reception_commande_remplissage_table_ref_externe_fourni.php",
								"type": "POST",
						},
						lengthMenu: [[5,10,15,-1], [5, 10, 15,"Toutes"]],
						columnDefs: [
								{
										"targets": [ 1 ],
										"visible": false,
										"searchable": true
								},									
								{
										"targets": [ 2 ],
										"visible": false,
										"searchable": false
								}
						],
						responsive: true
				});

				

// on adapte le formulaire au destinataire ( nécessite les fonctions d'ajout et de suppression de ligne)

		// si le destinataire est BEE, il n'y pas besoin des lignes de stocks car BEE a un seul stock donc on les supprime
		if($('#destinataire').val()=='BEE')
		{
				$('.ligne_stock').remove();
				$('legend:eq(2)').remove();
				$(".ajout_stock").remove();
		}



// cette partie gère les liste déroulante marque, modèle et état qui sont des listes déroulantes changeantes en fonction de la valeur choisie des autres
		 			// lorque que le champ marque cela charge les modèles correspondants dans le champ modèle
					$('#marque1').change(function(){
							var ligne_cmde_associe=$(this).parents('.ligne_cmde');
							var modele_ligne=$('select:eq(1)',ligne_cmde_associe);
							$.ajax({
									url: 'traitement_bdd/chargement_marque_modele_etat_cmde_fournisseurs.php',
									async : false,
									type: "POST",
									data: { marque: $(this).val(), type: "marque" }, 
									success: function(html) { 								
											$(modele_ligne).html(html);
											// cela permet de recharger les données du champ état qui dépendent du champ modèle
											$(modele_ligne).trigger('change');
									}
							});
					});
					// lorque que le champ modele cela charge les états correspondants dans le champ modèle
					$('#modele1').change(function(){
							var ligne_cmde_associe=$(this).parents('.ligne_cmde');
							var etat_ligne=$('select:eq(2)',ligne_cmde_associe);
							$.ajax({
									url: 'traitement_bdd/chargement_marque_modele_etat_cmde_fournisseurs.php',
									async : false,
									type: "POST",
									async: false,
									data: { modele: $(this).val(), type: "modele" }, 
									success: function(html) { 								
											$(etat_ligne).html(html);
									}
							});
					});


// gestion de la suppression et de l'ajout des lignes de stocks
		
		// function pour mettre à jour les indices des lignes de stock
				function maj_indice_lignes_stock(ligne_cmde_associe)
				{
						if($(ligne_cmde_associe).children('.ligne_stock').length!==0)
						{
								$(ligne_cmde_associe).children('.ligne_stock').each(function(num_ligne){
										// maj des name
										$('[name]',this).each(function(){
												var name_courant=$(this).attr('name');
												name_courant=name_courant.replace(/_\d+/,'_'+(num_ligne+1));
												$(this).attr('name',name_courant);
										});
										// maj des id
										$('[id]',this).each(function(){
												var id_courant=$(this).attr('id');
												id_courant=id_courant.replace(/_\d+/,'_'+(num_ligne+1));
												$(this).attr('id',id_courant);
										});
										// maj des labels
										$('[for]',this).each(function(){
												var for_courant=$(this).attr('for');
												for_courant=for_courant.replace(/_\d+/,'_'+(num_ligne+1));
												$(this).attr('for',for_courant);
										});									
								});
						}
				}
		
		// fonction pour mettre à jour les names des lignes sup
		function maj_ligne_sup()
		{
				$('.ligne_sup').each(function(){
						$('[name]',this).each(function(){
								var name_courant=$(this).attr('name');
								if(!(/sup_/.test(name_courant)))
								{
										name_courant='sup_'+name_courant;
								}
								$(this).attr('name',name_courant);
						});
				});
		}
		
		// function pour mettre à jour les indices des lignes de cmde et pour les colorer
				function maj_indice_lignes_cmde()
				{
						if($('.ligne_cmde').length!==0)
						{
								$('.ligne_cmde').each(function(num_ligne){
										//coloration des lignes
										if(num_ligne%2==0)
												$(this).css('background-color','white');
										// maj des name
										$('[name]',this).each(function(){
												var name_courant=$(this).attr('name');
												name_courant=name_courant.replace(/\d+/,(num_ligne+1));
												$(this).attr('name',name_courant);
										});
										// maj des id
										$('[id]',this).each(function(){
												var id_courant=$(this).attr('id');
												id_courant=id_courant.replace(/\d+/,(num_ligne+1));
												$(this).attr('id',id_courant);
										});
										// maj des labels
										$('[for]',this).each(function(){
												var for_courant=$(this).attr('for');
												for_courant=for_courant.replace(/\d+/,(num_ligne+1));
												$(this).attr('for',for_courant);
										});									
										// maj du titre de la ligne
										var titre_ligne=$('h3',this)[0];
										var texte_titre_ligne=$(titre_ligne).text();
										texte_titre_ligne=texte_titre_ligne.replace(/\d+/,(num_ligne+1));
										$(titre_ligne).text(texte_titre_ligne);
								});
						}
				}

		// lorsqu'on clique sur le bouton delete d'une ligne de stock cela la supprime 
				$('.delete_ligne_stock').click(function(){
						var ligne_cmde_associe = $(this).parents('.ligne_cmde');
						var ligne_stock_associe = $(this).parents('.ligne_stock');
						$(ligne_stock_associe).remove();
						maj_indice_lignes_stock(ligne_cmde_associe);
				});
		

		// on clone la première ligne de stock afin de pouvoir l'ajouter à volonté par la suite
				var clone_ligne_stock = clone_ligne('.ligne_stock');
		
		// lorqu'on clique sur Ajouter stock, cela ajoute une ligne
				$('.ajout_stock').click(function()
				{
						var clone = clone_ligne(clone_ligne_stock);	
						$(this).parent().before(clone);
						var ligne_cmde_associe = $(this).parents('.ligne_cmde');
						maj_indice_lignes_cmde();
						maj_indice_lignes_stock(ligne_cmde_associe);
						maj_ligne_sup();
				});

// getion de la suppression et de l'ajout des lignes de commandes
		
		// lorsque qu'on clique sur le bouton Delete d'une ligne cela supprime la ligne correspondate
				$('.delete_ligne_cmde').click(function(){
						var ligne_cmde_associe = $(this).parents('.ligne_cmde');
						$(ligne_cmde_associe).remove();
						maj_indice_lignes_cmde();
				});
		
		// on clone la première ligne de commande afin pouvoir l'ajouter à volonté par la suite
				var clone_ligne_cmde = clone_ligne('.ligne_cmde');

		// lorqu'on clique sur Ajouter ligne, cela ajoute une ligne
				$('#ajout_ligne').click(function(event,ligne_sup)
				{
						var clone = clone_ligne(clone_ligne_cmde);	
						if(ligne_sup===undefined)
						{
								$(clone).addClass('ligne_sup').addClass('bordure_ligne');
								$('h3',clone).css('color','red');
								$('h3',clone).text('Ligne de commande supplémentaire !');
						}
						$('#fin_des_lignes').before(clone);
						// on marque cette ligne supp pour la différencier des lignes de cmde
						if(ligne_sup===undefined)
								maj_ligne_sup();
						maj_indice_lignes_cmde();
				});

// on supprime toutes les lignes de commandes afin de détecter les lignes de commandes supplémentaire
				$('.delete_ligne_cmde').trigger('click');

// pré-remplissage dur formulaire lorsque que l'on clique sur une ligne du tableau
				$('#liste_ref_externe_fourni').on('click', 'tr', function () {
						var cells =$('td', this);
						var ligne = table_ref_externe.fnGetData( this );
						var ref_externe=ligne[0];
						var expediteur=ligne[1];
						var nbre_ligne_cmde=ligne[2];
						// on remplit l'entête du formulaire
						$('#ref_externe').val(ref_externe);
						$('#expediteur').val(expediteur);
						$('#nbre_ligne_cmde').val(nbre_ligne_cmde);
	
						// on récupère toutes les lignes de commande correspondantes à cette ref_externe
						$.ajax({
								dataType: "json",
								url: 'traitement_bdd/reception_commandes_zfw_chargement_donnees_formulaire.php',
								type: "POST",
								data: { ref_externe: ref_externe, expediteur: expediteur}, 
								success: function(retour_cmde) {
										if(retour_cmde[0])
										{
												donnees_cmde = retour_cmde[1];	
												nbre_tot_row=donnees_cmde.length;
												// on doit mettre le formulaire dans un état défini avant d'y insérer les données. Pour se faire, on actionne tous les boutons supprimer du formulaire
												$('.delete_ligne_cmde').trigger('click');
												for(indice_row=0;indice_row<nbre_tot_row;indice_row++)
												{
														donnees_ligne=donnees_cmde[indice_row];
														// à chaque nouvelle ligne de commande, on ajoute une ligne au formulaire que l'on va automatiquement pré-remplir
														$('#ajout_ligne').trigger('click',[false]);
												
														
														// on définie les id de la ligne et des champs dans lesquelles on va insérer les données
														var id_marque="#marque"+(indice_row+1);
														var id_modele="#modele"+(indice_row+1);
														var id_etat="#etat"+(indice_row+1);
														var id_qte_recue="#qte_recue"+(indice_row+1);
					
														//on insère les données dans le formulaire
														$(id_marque).val(donnees_ligne[2]);
														$(id_marque).trigger('change');
														$(id_modele).val(donnees_ligne[3]);
														$(id_modele).trigger('change');
														$(id_etat).val(donnees_ligne[4]);
														$(id_qte_recue).val(donnees_ligne[1]);

												}
										}
										else
										{
												alert('erreur retour ajax :'+retour_cmde[1]);
										}
								}
						});
				});



// soumission du formulaire
				$('form:eq(0)').on('submit',function(e){
						e.preventDefault();
//première partie : vérification du bon remplissage des champs		

					// envoyer message d'erreur si il n'y a pas de lignes de commandes et si il y a des lignes sup et qu'il y a moins de lignes de commandes que prévu 
					var nbre_ligne_cmde = $('.ligne_cmde').length-$('.ligne_sup').length;
					var nbre_ligne_sup = $('.ligne_sup').length;
					if(nbre_ligne_cmde==0)
					{
							alert('Vous ne pouvez pas envoyer de formulaires sans lignes de commandes ou avec uniquement que des lignes de commandes supplémentaires');
							return false;
					}
					if(nbre_ligne_cmde<$('#nbre_ligne_cmde').val() && nbre_ligne_sup>0)
					{
							alert('Vous ne pouvez pas envoyer de formulaires avec des lignes supplémentaires et un nombre de lignes de commandes inférieures à celui de l\'entête');
							return false;
					}
					// pour vérifier que le nbre dans les stocks est égale à la qte recue pour chaque ligne de commande
					if($('#destinataire').val()=='ZFW')
					{
							mauvaise_repartition=false;
							$('.ligne_cmde').each(function(indice_row)
							{
									qte_recue=$('#qte_recue'+(indice_row+1)).val();
									qte_stock=0;
									$('.ligne_stock',this).each(function()
									{
											qte_stock+=parseInt($('[id*="qte_lieu_stockage"]',this).val());			
									});
									if(qte_recue!=qte_stock)
									{
											mauvaise_repartition=true;
											alert('Vous avez mal réparti la quantité recue de la ligne n°'+(indice_row+1)+' dans les stocks');
											$('#qte_recue'+(indice_row+1)).focus();
											return false;
									}
							});
							if(mauvaise_repartition)
							{
									return false;
							}
								
					}

// deuxième partie, si champs bien remplis alors on envoie le formulaire
					// tableau qui contient les infos du formulaire
					var infos_form = $(this).serializeArray();
					infos_form.push({name: 'nbre_ligne_cmde_saisie', value: nbre_ligne_cmde });
					infos_form.push({name: 'nbre_ligne_sup', value: nbre_ligne_sup });
					
					// on envoie des données pour connaitre le nbre de ligne de stocks pa ligne de commande ( valable lorsque que le destinataire est ZFW)
					if($('#destinataire').val()=='ZFW')
					{
							$('.ligne_cmde').each(function(indice_row)
							{
								infos_form.push({name: 'nbre_ligne_stock'+(indice_row+1), value: $('.ligne_stock',this).length });
							});
					}

					// Envoi de la requête HTTP en mode asynchrone
						$.ajax({
								dataType: "json",
								url: 'traitement_bdd/reception_commande_traitement_formulaire.php', // Le nom du fichier indiqué dans le formulaire
								type: 'POST', // La méthode indiquée dans le formulaire (get ou post)
								data: infos_form, 
								success: function(retour) { // Je récupère la réponse du fichier PHP
										if(retour[0]) // si il y pas d'erreur
										{
												alert(retour[1]);
												$('form:eq(0)')[0].reset();
												$('.delete_ligne_cmde').trigger('click');
												// on met à jour la dataTable 
												table_ref_externe.api().ajax.reload();
										}
										else //si il y a une erreur
										{
												alert(retour[1]);
										}
								}
						});
				})

		});

