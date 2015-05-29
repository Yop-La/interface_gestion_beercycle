		
	// pour inclure le fichier fonctions.js
	document.write("<script type='text/javascript' src=\"js/fonctions.js\"></script>" );
			$(function() {
						
// gestion de la réception des commandes envoyées directement par le fournisseur et par bee 
		// cela sert à remplir et à paramétrer la DataTable
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
// partie pour compter le nombre de lignes de commandes saisies par l'utilisateur et le aussi le nombre de ligne de stock pour chaque ligne de commande
		// ce tableau contient le nombre de ligne de stock pour pour chaque ligne de commande. L'index 0 correspond à la ligne 1
					var nbres_ligne_stock=[1];
		//cette variable contient le nombre de lignes de commande du formulaire (toutes les lignes -> supplémentaires et non supplémentaires)
					var nbre_ligne_commandes=1;
// cette partie sert à sauvegarder les valeurs initiales et finales des champs de la partie modification et validation de la commande

		// on déclare le tableau qui pour chaque ligne de commande non additionnelle va contenir les valeurs initiales et finales des champs : marque, modèle, état et qte commandée
					var modifs_commande = []; //ce tableau contient autant de lignes que de lignes de commande non additionnelles. Chaque ligne de ce tableau est un tableau à 9 cases
					                           // première case d'une ligne est le numéro de la ligne de commande, puis elle contient 4 couples valeur initiale/finale des 4 champs
																		 // ce tableau nous permet de repérer les lignes de commandes qui ont été modifiés ( réception != commande )
		// cette variable permet de savoir si on retiré ou non la partie gestion des stocks du formulaire. Elle est mise à true lorsque que BEE est sélectionné dans l'entete.
					var select_bee = false;

		// pré-remplissage dur formulaire lorsque que l'on clique sur une ligne du tableau
					$('#liste_ref_externe_fourni').on('click', 'tr', function () {
						select_bee = false;
						modifs_commande=[];
						var cells =$('td', this);
						var ligne = table_ref_externe.fnGetData( this );
						var ref_externe=ligne[0];
						var expediteur=ligne[1];
						var nbre_ligne_cmde=ligne[2];
						// on remplit l'entête du formulaire
						$('#fourn_ref_externe').val(ref_externe);
						$('#fourn_expediteur').val(expediteur);
						$('#fourn_nbre_ligne_cmde').val(nbre_ligne_cmde);
						$('#destinataire').val('');
	
						// on récupère toutes les données nécessaire au remplissage du formulaire
						$.ajax({
									dataType: "json",
									url: 'traitement_bdd/reception_commandes_zfw_chargement_donnees_formulaire.php',
									type: "POST",
									data: { ref_externe: ref_externe, expediteur: expediteur}, 
									success: function(donnees_cmde) {
											nbre_tot_row=donnees_cmde.length;
											// on doit connaître l'état du formulaire ou le mettre dans un état défini avant d'y insérer les données
											// on actionne tous les boutons supprimer du formulaire
											$('[class*="btn-primary"]').trigger('click');
											for(indice_row=0;indice_row<nbre_tot_row;indice_row++)
											{
													donnees_ligne=donnees_cmde[indice_row];
													// à chaque nouvelle ligne de commande, on ajoute une ligne au formulaire
											
													ajout_ligne_vide(clone_first_empty_ligne_fourni,'#fin_des_lignes',true,false,false);
													// on met à jour le nombre de lignes du formulaire
													nbre_ligne_commandes++;
													// on ajoute une ligne de stock à cette ligne de commande
													nbres_ligne_stock.push(1);
													// on met à jour les indices des lignes
													maj_indice_ligne('[id*="ligne_cmde_fourn_"]','h3',/\d+/);
													// on colore les lignes pour améliorer la visibilité
													color_selection_ligne('[id*="ligne_cmde_fourn_"]');
													
													// on définie les id de la ligne et des champs dans lesquelles on va insérer les données
													var id_ligne="#ligne_cmde_fourn_"+(indice_row+1);
													var id_marque="#fourn_marque"+(indice_row+1);
													var id_modele="#fourn_modele"+(indice_row+1);
													var id_etat="#fourn_etat"+(indice_row+1);
													var id_qte_recue="#fourn_qte_recue"+(indice_row+1);
				
													//on insère les données
													$(id_marque).val(donnees_ligne[2]);
													$(id_marque).trigger('change');
													$(id_modele).val(donnees_ligne[3]);
													$(id_modele).trigger('change');
													$(id_etat).val(donnees_ligne[4]);
													$(id_qte_recue).val(donnees_ligne[1]);
													var ligne_courante=donnees_cmde[indice_row];

													// on met à jour le tableau modifs_commande
													// on enregistre la ligne de commande
													modifs_commande.push('ligne'+(indice_row+1));
													// on enregistre la marque
													modifs_commande.push(donnees_ligne[2]);
													modifs_commande.push(donnees_ligne[2]);
													// on enregistre le modèle
													modifs_commande.push(donnees_ligne[3]);
													modifs_commande.push(donnees_ligne[3]);
													// on enregistre l'état
													modifs_commande.push(donnees_ligne[4]);
													modifs_commande.push(donnees_ligne[4]);
													// on enregistre la quantité commandée
													modifs_commande.push(donnees_ligne[1]);
													modifs_commande.push(donnees_ligne[1]);
											}
									}
						});
								

					});

		// cette partie gère les liste déroulante marque, modèle et état qui sont des listes déroulantes changeantes en fonction de la valeur choisie des autres
		 			// lorque que le champ marque cela charge les modèles correspondants dans le champ modèle
					$('select:eq(2)').change(function(){
							var num_ligne= $(this).attr('id').match(/\d+/);
							var select_modele_ligne=$('select:eq(1)',$(this).parent().parent().parent());
							var select_marque_ligne=this;
							var select_etat_ligne=$('select:eq(2)',$(this).parent().parent().parent());
							$.ajax({
									url: 'traitement_bdd/chargement_marque_modele_etat_cmde_fournisseurs.php',
									type: "POST",
									async: false,
									data: { marque: $(this).val(), type: "marque" }, 
									success: function(html) { 								
											$(select_modele_ligne).html(html);
											// cela permet de recharger les données du champ état qui dépendent du champ modèle
											$(select_modele_ligne).trigger('change');
									}
							});
							// on enregistre la valeur finale du champ marque dans modifs_commande après changement

							var index=modifs_commande.indexOf("ligne"+num_ligne);
							if(index!=-1)
							{
									modifs_commande[index+2]=$(this).val();
									console.log(modifs_commande);
							}
					});
					// lorque que le champ modele cela charge les états correspondants dans le champ modèle
					$('select:eq(3)').change(function(){
							var num_ligne= $(this).attr('id').match(/\d+/);
							var select_marque_ligne=$('select:eq(0)',$(this).parent().parent().parent());
							var select_etat_ligne=$('select:eq(2)',$(this).parent().parent().parent());
							$.ajax({
									url: 'traitement_bdd/chargement_marque_modele_etat_cmde_fournisseurs.php',
									type: "POST",
									async: false,
									data: { modele: $(this).val(), type: "modele" }, 
									success: function(html) { 								
											$(select_etat_ligne).html(html);
									}
							});
							// on enregistre la valeur finale du champ modèle dans modifs_commande après changement
							var index=modifs_commande.indexOf("ligne"+num_ligne);
							if(index!=-1)
							{
									modifs_commande[index+4]=$(this).val();
							}

					});
					// pour enregistrer les valeurs finales du champ état après changement après l'utilisateur (ne concerne que les lignes de commandes non supplémentaires)
					$('select:eq(4)').change(function(){
							var num_ligne= $(this).attr('id').match(/\d+/);
							// on enregistre la valeur finale du champ état dans modifs_commande après changement
							var index=modifs_commande.indexOf("ligne"+num_ligne);
							if(index!=-1)
							{
							modifs_commande[index+6]=$(this).val();
							}
					});		
					// pour enregistrer les valeurs finales du champ quantité reçue après changement après l'utilisateur (ne concerne que les lignes de commandes non supplémentaires)
					$('input:eq(5)').change(function(){
							var num_ligne= $(this).attr('id').match(/\d+/);
							// on enregistre la valeur finale du champ état dans modifs_commande après changement
							var index=modifs_commande.indexOf("ligne"+num_ligne);
							if(index!=-1)
							{
							modifs_commande[index+8]=$(this).val();
							}
					});

		
// cette partie gère les ajouts et suppression d'éléments du formulaire
		// fonction pour cloner, ajouter et maj des indices de ligne


						// fonction pour insérer une ligne. Cette fonction insére un clone de clone avant l'élément "id insérer avant" si before=true sinon cela l'insère après.
						function ajout_ligne_vide(clone,id_inserer_avant,before,checkbox_ligne_suppl,rouge)
						{
								var new_ligne=$(clone).clone(true);
								if(checkbox_ligne_suppl)
								{
										var checkbox=$('[id*="ligne_suppl"]',new_ligne);
										$(checkbox).prop("checked", true);
								}
								if(rouge)
								{
										$(new_ligne).css('background-color','red');
								}

								if(before)
										$(id_inserer_avant).before(new_ligne);
								else
										$(id_inserer_avant).after(new_ligne);
										
						}

						// fonction pour supprimer une ligne. Cela supprime un parent de ligne_cible. Le parent supprimé est celui choisi par nbre_parent. Nbre_parent est un nombre qui représente le ième
						// parent à suprrimer
						function suppression_ligne(ligne_cible,nbre_parent)
						{
								var papa=$(ligne_cible);
								for(var i=1;i<=nbre_parent;i++)
								{
										papa=$(papa).parent()
								}
								$(papa).remove();
						}

						/* 
						fonction pour mettre à jour les indices des lignes après suppression ou insertion. Cette fonction met à jour tous les indices des lignes sélectionnées par le sélecteur jquery "selec						 teur_ligne qui vaudra dans le cas des lignes de commandes : '[id*="ligne_cmde_fourn_"]'. On doit aussi préicser la regex qui va sélectionner la partie des id et des names à mettre à 						jour. Dans le cas des lignes de commandes, cette regex est : /\d+/
						Par défauti (si element=''), cette fonction met à jour tous les name et tous les id des des éléments des lignes ainsi que l'id des lignes. Si on précise un élément particulier, le t						 exte de celui sera mis à jour ( fait pour les titres surtout ). Cette fonction est surtout utilisé pour faire les maj des indices des names et des id des éléments des lignes de comm						andes. On l'utilise aussi pour faire les maj des indices des names et des id des lignes de stocks*/
						function maj_indice_ligne(selecteur_ligne,element_particulier,regex)
						{
								// on parcoure une à une les lignes sélectionnées
								$(selecteur_ligne).each(function(num_ligne){
										// maj des name
										$('[name]',this).each(function(){
												var name_courant=$(this).attr('name');
												name_courant=name_courant.replace(regex,(num_ligne+1));
												$(this).attr('name',name_courant);
										});
										// maj des id
										$('[id]',this).each(function(){
												var id_courant=$(this).attr('id');
												id_courant=id_courant.replace(regex,(num_ligne+1));
												$(this).attr('id',id_courant);
										});
										// maj des labels
										$('[for]',this).each(function(){
												var for_courant=$(this).attr('for');
												for_courant=for_courant.replace(regex,(num_ligne+1));
												$(this).attr('for',for_courant);
										});									
										//maj d'un élément particulier
										if(element_particulier!='')
										{
												var titre_ligne=$(element_particulier,this)[0];
												var texte_titre_ligne=$(titre_ligne).text();
												texte_titre_ligne=texte_titre_ligne.replace(regex,(num_ligne+1));
												$(titre_ligne).text(texte_titre_ligne);
										}

										//maj de l'id de la ligne
										var id_ligne=$(this).attr('id');
										id_ligne=id_ligne.replace(regex,(num_ligne+1));
										$(this).attr('id',id_ligne);
								});

						}						
						// fonction qui colore une ligne (de commande) sur deux de la sélection
						function color_selection_ligne(selecteur_lignes)
						{
								// on parcoure une à une les lignes sélectionnées
								$(selecteur_lignes).each(function(num_ligne){
										if(num_ligne%2==0)
												$(this).css('background-color','white');
								});
						}




		// partie pour gérer l'ajout et la suppression de ligne de ligne de la partie "répartition des produits" dans les différents stocks

						// bouton qui supprime la ligne n°1 de la partie "répartition des produits dans les stocks" de la 1ère ligne du formulaire
						$('button:eq(1)').click(function(){
								var num_ligne=$(this).parent().parent().parent().attr('id').match(/\d+/);
								suppression_ligne(this,2);
								// on met à jour les indices des lignes de commandes (en particulier le premier indice des lignes de stocks )
								maj_indice_ligne('[id*="ligne_cmde_fourn_"]','h3',/\d+/)
								// on met à jour le deuxième indices des lignes de stokcs
								maj_indice_ligne('[id*="repartition_four_stock_ligne'+num_ligne+'_"]','',/\d+$/);
								// on met à jour le nombre de ligne de stocks pour cette ligne de commande
								nbres_ligne_stock.splice((num_ligne-1),1,(nbres_ligne_stock[num_ligne-1]-1));

						});

						// bouton ajout d'une ligne du formulaire de la partie "réparition dans les différents stocks
						$('button:eq(2)').click(function(){
								// on détermine la ligne dans laquelle le bouton se trouve
								var num_ligne=$(this).parent().parent().attr('id').match(/\d+/);
								// ajoute une ligne de stock vide	
								ajout_ligne_vide(clone_first_empty_ligne_repartition_fourni,'#ajout_repartition_four'+num_ligne,true,false);
								// on met à jour les indices des lignes de commandes
								maj_indice_ligne('[id*="ligne_cmde_fourn_"]','h3',/\d+/)
								// on met à jour dans cette ligne les id et name des lignes de la partie "répartition des produits"
								maj_indice_ligne('[id*="repartition_four_stock_ligne'+num_ligne+'_"]','',/\d+$/)
								// on met à jour le nombre de ligne de stocks pour cette ligne de commande
								nbres_ligne_stock.splice((num_ligne-1),1,(nbres_ligne_stock[num_ligne-1]+1));

						});

						// sert à cloner la première ligne de la partie "répartition des produits" de la première ligne du formulaire
						var clone_first_empty_ligne_repartition_fourni = clone_ligne('#repartition_four_stock_ligne1_1');	

						//  sert à cloner le bouton d'ajout de stock afin de l'ajouter comme on le désire par la suite
						var clone_bouton_ajout_stock = clone_ligne('#ajout_repartition_four1');

						// sert à cloner la légende de la partie répartition dans les stocks afin de l'insérer comme on le désire par la suiite

						var clone_legend_stock=clone_ligne('.partie_stock');
		// partie pour gérer l'ajout et la suppression de ligne du formulaire

						// bouton ajout d'une ligne du formulaire
						$('button:eq(3)').click(function(){
								ajout_ligne_vide(clone_first_empty_ligne_fourni,'#fin_des_lignes',true,true,true)
								maj_indice_ligne('[id*="ligne_cmde_fourn_"]','h3',/\d+/)
								// on met à jour le nombre de lignes du formulaire
								nbre_ligne_commandes++;
								// on ajoute une ligne de stock à cette ligne de commande
								nbres_ligne_stock.push(1);

								if($('#destinataire').val()=='BEE')
								{
										$('#destinataire').trigger('change');
								}


						});	
						
						// bouton delete de la ligne n°1
						$('button:eq(0)').click(function(){
								suppression_ligne(this,3);
								maj_indice_ligne('[id*="ligne_cmde_fourn_"]','h3',/\d+/);

								color_selection_ligne('[id*="ligne_cmde_fourn_"]');
								// on met à jour le nombre de lignes du formulaire
								nbre_ligne_commandes--;
								// on supprime une ligne de stock à cette ligne de commande
								var tampon=$(this).closest('[id*="ligne_cmde_fourn_"]');
								tampon=$(tampon).attr('id');
								indice_ligne=tampon.match(/\d+/);
								if(nbre_ligne_commandes==1)
										nbres_ligne_stock=[1];
								else if(nbre_ligne_commandes==0)
										nbres_ligne_stock=[];
								else
										nbres_ligne_stock.splice((indice_ligne-1),1);
								// si on supprime une ligne de commande qui est non supplémentaire alors on retire les infos de cette ligne de commande du tableau modifs_commande
								var index=modifs_commande.indexOf("ligne"+indice_ligne);
								if(index!=-1)
								{
										modifs_commande.splice(index,9);
										var num_ligne_pas_suppl=1;
										for(i=0;i<modifs_commande.length;i++)
										{
												if(i%9==0)
												{
														modifs_commande[i]="ligne"+num_ligne_pas_suppl;
														num_ligne_pas_suppl++;
												}
		
										}
								}
								// pour colorer les lignes supplémentaires
								$('[type="checkbox"]').each(function(){
										if($(this).prop("checked")==true)
										{
												$(this).parents('[id*="ligne_cmde_fourn_"]').css('background-color','red');
										}
								});
										
						});

						// cette partie sert à cloner la première ligne et à la garder en mémoire pour pouvoir l'insérer à volonté après
						var clone_first_empty_ligne_fourni = clone_ligne('#ligne_cmde_fourn_1');

					
// pour afficher un formulaire vide au début et obliger l'utilisateur à cliquer sur une ligne du tableau
						$('[class*="btn-primary"]').trigger('click');

// cette partie supprime toute la gestion répartition dans les stocks si l'on choisir BEE comme destinataire et rajoute ces parties si l'on choisit ZFW
			$('#destinataire').change(function(){
				if($(this).val()=='BEE')
				{
						$('.partie_stock').remove();
						$('[id*="repartition_four_stock_ligne"]').remove();
						$('[id*="ajout_repartition_four"]').remove();
						select_bee = true;
						for(var indice_ligne_stock=0;indice_ligne_stock<nbres_ligne_stock.length;indice_ligne_stock++)
						{
								nbres_ligne_stock[indice_ligne_stock]=0;
						}
				}
				else if($(this).val()=='ZFW')
				{
						if(select_bee)
						{
								$('.qte_recu').after(clone_legend_stock);	
								$('.qte_recu + legend').after(clone_first_empty_ligne_repartition_fourni);
								$('[id*="repartition_four_stock_ligne"]').after(clone_bouton_ajout_stock);
								select_bee = false;
								for(var indice_ligne_stock=0;indice_ligne_stock<nbres_ligne_stock.length;indice_ligne_stock++)
								{
										nbres_ligne_stock[indice_ligne_stock]=1;
								}
								// on met à jour les indices des lignes de commandes (en particulier le premier indice des lignes de stocks )
								maj_indice_ligne('[id*="ligne_cmde_fourn_"]','h3',/\d+/)
								// on met à jour le deuxième indices des lignes de stokcs
								maj_indice_ligne('[id*="repartition_four_stock_ligne'+num_ligne+'_"]','',/\d+$/);
						}
				}
				else
				{
						alert('Veuillez remplir le champ destinataire');
				}
		});


// soumission du formulaire
						$('form:eq(0)').on('submit',function(e){
								// on réactive toutes les checkbox qui permettent de savoir si on a des lignes sup ou non
								$('[id*="ligne_suppl"]').removeAttr("disabled");

								e.preventDefault();
		//première partie : vérification du bon remplissage des champs		

							// enovyer message d'erreur si il n'y a pas de lignes non suppl
							// on compte le nombre de lignes supplémentaires
							var nbre_lignes_suppl=0;
							$('[type="checkbox"]').each(function(){
									if($(this).prop("checked")==true)
									{
											nbre_lignes_suppl++;
									}
							});
							if((nbre_ligne_commandes-nbre_lignes_suppl)==0) 
							{
									
									alert('Vous ne pouvez pas envoyer ce formulaire car il ne contient pas de lignes de commande non supplémentaires');
									return false;

							}



		// deuxième partie, si champs bien remplis alors on envoie le formulaire

							// on prépare le tableau nbres_ligne_stock à l'envoi par POST
							var envoi_post={};
							for(i=0;i<nbres_ligne_stock.length;i++)
							{
									envoi_post['nb_ligne_stk'+(i+1)]=nbres_ligne_stock[i];
							}
							// de même pour le tableau modifs_commande qui contient les modifications faîtes sur les lignes de commandes non supplémentaire
							// pour envoyer ce tableau avec post, il faut définir des couples (index,valeur). Ce que l'on fait dans le tableau envoi_modifs_commande
							envoi_modifs_commande={};
							var num_ligne_pas_suppl=1;
							for(i=0;i<modifs_commande.length;i++)
							{
									//si il s'agit d'une case contenant un numéro de ligne de commande
									if(i%9==0)
									{
											envoi_modifs_commande[modifs_commande[i]]=modifs_commande[i];
											envoi_modifs_commande['marque_initi'+num_ligne_pas_suppl]=modifs_commande[i+1];
											envoi_modifs_commande['marque_final'+num_ligne_pas_suppl]=modifs_commande[i+2];
											envoi_modifs_commande['modele_initi'+num_ligne_pas_suppl]=modifs_commande[i+3];
											envoi_modifs_commande['modele_final'+num_ligne_pas_suppl]=modifs_commande[i+4];
											envoi_modifs_commande['etat_initi'+num_ligne_pas_suppl]=modifs_commande[i+5];
											envoi_modifs_commande['etat_final'+num_ligne_pas_suppl]=modifs_commande[i+6];
											envoi_modifs_commande['qtee_recue_initi'+num_ligne_pas_suppl]=modifs_commande[i+7];
											envoi_modifs_commande['qtee_recue_final'+num_ligne_pas_suppl]=modifs_commande[i+8];
											num_ligne_pas_suppl++;
									}
							}
							
							envoi_post=$.param(envoi_post)+'&'+$.param(envoi_modifs_commande);
							// de même pour la variable nbre_ligne_commandes
							envoi_post+='&nbre_ligne_commande_saisie='+nbre_ligne_commandes;
							envoi_post=$(this).serialize()+'&'+envoi_post;
							// de même pour la variable nbre_lignes_suppl
							envoi_post+='&nbre_lignes_suppl='+nbre_lignes_suppl;
						
							// Envoi de la requête HTTP en mode asynchrone
								$.ajax({
										dataType: "json",
										url: 'traitement_bdd/reception_commande_traitement_formulaire.php', // Le nom du fichier indiqué dans le formulaire
										type: 'POST', // La méthode indiquée dans le formulaire (get ou post)
										data: envoi_post, 
										success: function(retour) { // Je récupère la réponse du fichier PHP
												if(retour[0]) // si il y pas d'erreur
												{
														alert(retour[1]);
												}
												else //si il y a une erreur
												{
														alert(retour[1]);
												}
										}
								});
		// troisième : on remet le formulaire dans son état intiale
								// on désactive à nouveau tous les checkbox des lignes supp
								$('[id*="ligne_suppl"]').prop('disabled', true);
								// on reset le formulaire
								$('form:eq(0)')[0].reset();
								$('[class*="btn-primary"]').trigger('click');
								// on met à jour la dataTable 
								table_ref_externe.api().ajax.reload();
						});
						
						
				});
