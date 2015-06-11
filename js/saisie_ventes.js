
				// pour inclure le fichier fonctions.js
				document.write("<script type='text/javascript' src=\"js/fonctions.js\"></script>" );
				$(function(){

									// lorsque que le champ identifiant du vendeur change, on propose la ref_canal_distrib du vendeur associée
									$('#id_vendeur').change(function(){
											$.ajax({
													dataType: "json",
													url: 'traitement_bdd/saisie_ventes_remplissage_form.php',
													type: "POST",
													data: { id_vendeur: $(this).val()}, 
													success: function(ret) {
															if(ret[0])
															{
																	 $('#ref_canal_distrib option[value="'+ret[1]+'"]').prop('selected', true);
															}
															else
															{
																		alert('Erreur de chargement de la ref_canal_distribi'); 
															}
													}
											});
									
									});

									// lorsque le champ ref_canal_distrib a le focus, on reset le formulaire si celui n'est pas vierge
									$('#ref_canal_distrib').focus(function(){
											if(!lignes_vente_vierge())
											{
													reset_formulaire();
											}
											if(premiers_champs_remplis())
													read_only_lignes_vente(false);
											else
													read_only_lignes_vente(true);

									});

									// lorsque le champ devise a le focus, on reset le formulaire si celui n'est pas vierge
									$('#devise').focus(function(){
											if(!lignes_vente_vierge())
											{
													reset_formulaire();
											}
											if(premiers_champs_remplis())
													read_only_lignes_vente(false);
											else
													read_only_lignes_vente(true);

									});

									// lorsque l'on change la devise cela affiche la devise choisie dans la partie montant total de la vente

									$('#devise').change(function(){
											$('.devise_montant').text($('#devise').val());			
									});

									// lorsque le champ id_vendeur a le focus, on reset le formulaire si celui n'est pas vierge
									$('#id_vendeur').focus(function(){
											if(!lignes_vente_vierge())
											{
													reset_formulaire();
											}
											if(premiers_champs_remplis())
													read_only_lignes_vente(false);
											else
													read_only_lignes_vente(true);

									});

									// lorque que le champ marque cela charge les modèles correspondants dans le champ modèle
									$('#marque_1').change(function(){
											var modele_associe = $('select:eq(1)',$(this).parents('.ligne_vente'));
											var etat_associe = $('select:eq(2)',$(this).parents('.ligne_vente'));
											$.ajax({
													url: 'traitement_bdd/chargement_marque_modele_etat_cmde_fournisseurs.php',
													type: "POST",
													data: { marque: $(this).val(), type: "marque" }, 
													success: function(html) { 								
															$(modele_associe).html(html);
															$(modele_associe).trigger('change');
													}
											});
									});
							// lorque que le champ modele change cela charge les états correspondants dans le champ modèle
									$('#modele_1').change(function(){
											var etat_associe = $('select:eq(2)',$(this).parents('.ligne_vente'));
											$.ajax({
													url: 'traitement_bdd/chargement_marque_modele_etat_cmde_fournisseurs.php',
													type: "POST",
													data: { modele: $(this).val(), type: "modele" }, 
													success: function(html) { 								
															$(etat_associe).html(html);
															$(etat_associe).trigger('change');
													}
											});
									});

							// lorque que le champ etat change et qu'il n'est pas vide cela affiche le stock par défaut du vendeur
							// et cela charge aussi le prix usd ainsi que le prix dans la devise
									$('#etat_1').change(function(){
											var marque_associe = $('select:eq(0)',$(this).parents('.ligne_vente'));
											var modele_associe = $('select:eq(1)',$(this).parents('.ligne_vente'));
											var etat_associe = $('select:eq(2)',$(this).parents('.ligne_vente'));
											var lieu_stockage_associe = $('select:eq(3)',$(this).parents('.ligne_vente'));
											var prix_usd_associe = $('input:eq(2)',$(this).parents('.ligne_vente'));
											var prix_devise = $('input:eq(3)',$(this).parents('.ligne_vente'));
											// on récupère le num de la ligne de vente
											var num_ligne = $(this).attr('id');
											num_ligne = num_ligne.match(/\d/);
											num_ligne = num_ligne[0];
											if($(this).val()!='')
											{
													$.ajax({
															dataType: "json",
															url: 'traitement_bdd/saisie_ventes_remplissage_form.php',
															type: "POST",
															data: { marque: $(marque_associe).val(), modele: $(modele_associe).val(), etat: $(etat_associe).val(), id_vendeur_canal: $('#id_vendeur').val() , ref_canal_distrib: $('#ref_canal_distrib').val(),devise : $('#devise').val() }, 
															success: function(ret) {
																	if(ret[0])// si il n'y pas d'erreur
																	{
																			// on sélectionne le stock par défaut du vendeur
																			id_stock_associe=$(lieu_stockage_associe).attr('id');
																	 		$('#'+id_stock_associe+' option[value="'+ret[1][1]+'"]').prop('selected', true);
																			$(lieu_stockage_associe).trigger('change');
																			
																			var message_dollard=false;
																			if(!ret[1][2])// si le prix dans la devise n'est pas dans le catalogue
																			{
																					alert("Le prix dans la devise de transaction du produit de la ligne "+num_ligne+" n'existe pas dans le catalogue. Veuillez prévenir votre supérieur afin de l'ajouter dans le catalogue");
																					if(!isNaN(ret[1][3])) // si le prix dans la devise est un nombre
																					{
																							alert("Le prix dans la devise de transaction de ligne "+num_ligne+" n'est qu'une convertion et pas le vrai prix du catalogue. Ce prix est donnée à titre indicatif. Parlez en avec votre supérieur");
																					}
																					else if(isNaN(ret[1][0])) // si le prix en dollard n'existe pas
																					{
																							alert("Le prix en dollard du produit de la ligne "+num_ligne+" n'existe pas dans le catalogue. Veuillez prévenir votre supérieur afin de l'ajouter dans le catalogue \n Par conséquent, on ne peut vous proposer de prix pour ce produit");
																							message_dollard=true;
																					}
																					else
																					{
																							alert("Impossible de trouver le cours de la devise de transaction. Veuillez prévenir votre supérieur afin de l'ajouter. Par conséquent, on ne peut vous proposer un prix pour le produit de la ligne "+num_ligne);
																					}
																					
																			}
																			if(isNaN(ret[1][0]) && !message_dollard) // si le prix en dollard n'existe pas
																			{
																					alert("Le prix en dollard du produit de la ligne "+num_ligne+" n'existe pas dans le catalogue. Veuillez prévenir votre supérieur afin de l'ajouter dans le catalogue \n");
																			}
																			$(prix_usd_associe).val(ret[1][0]);
																			$(prix_devise).val(ret[1][3]);
																	}
																	else
																			alert('problème : '+ret[1]);
															}
													});
											}
									});
							// lorque que le champ lieu_stockage change, on charge les quantitées disponibles correspondantes
									$('#lieu_stockage_1').change(function(){
											var marque_associe = $('select:eq(0)',$(this).parents('.ligne_vente'));
											var modele_associe = $('select:eq(1)',$(this).parents('.ligne_vente'));
											var etat_associe = $('select:eq(2)',$(this).parents('.ligne_vente'));
											var qte_dispo_associe = $('input:eq(1)',$(this).parents('.ligne_vente'));
											if($(this).val()!='')
											{	
													$.ajax({
															dataType: "json",
															url: 'traitement_bdd/saisie_ventes_remplissage_form.php',
															type: "POST",
															data: { marque: $(marque_associe).val(), modele: $(modele_associe).val(), etat: $(etat_associe).val(),  lieu_stockage: $(this).val() }, 
															success: function(ret) {
																	if(ret[0])
																	{
																			$(qte_dispo_associe).val(ret[1]);
																	}
																	else
																			alert('problème : '+ret[1]);
															}
													});
											}
											else
											{
													$(qte_dispo_associe).val('');	
											}
									});

			
										
									
// pour savoir si les lignes de ventes sont vierge	
									function lignes_vente_vierge()
									{
											vierge=true;
											$('.ligne_vente').each(function(){
													$('input',this).each(function(){
															if($(this).val()!='')
															{
																	vierge=false;
																	return false;
															}
													});
													if(vierge==true)
															$('select',this).each(function(){
																	if($(this).val()!='')
																	{
																			vierge=false;
																			return false;
																	}
															});
											});
											return vierge;
									}

// fonction qui empeche la modification des champs de toutes les lignes de commande ou qui l'autorise
		// c'est le boolean read_only qui permet d'autoriser ou d'empêcher la modification des champs
									function read_only_lignes_vente(read_only)
									{
											$('.ligne_vente').each(function(){
													$('input',this).each(function(){
															$(this).prop('disabled',read_only);
													});
													$('select',this).each(function(){
															$(this).prop('disabled',read_only);
													});
											});
											nom_modifiable=read_only;
									}

// fonction pour dire à l'utilisateur que les lignes de vente sont non modifiables tant les 3 premiers champs ne sont pas saisies

								function alert_sur_saisie()
								{
											$('select','.remplir_en_premier').each(function(){
													if($(this).val()=='')
													{
															alert("Veuillez remplir les 3 premiers champs avant toute saisie");
															$(this).focus();
															return false;
													}
											});
								}

// fonction pour savoir si les 3 premiers champs sont bien remplis
	
								function premiers_champs_remplis()
								{		champs_remplis=true;
										$('select','.remplir_en_premier').each(function(){
												if($(this).val()=='')
												{
														champs_remplis=false;
														return false;
												}
										});
										return champs_remplis;
								}

// partie pour obliger la saisie des 3 premiers champs avant la saisie des lignes de vente

									
							$('.ligne_vente').mouseenter(function(){
									if(premiers_champs_remplis())
									{
											read_only_lignes_vente(false);
									}
									else
									{
											alert_sur_saisie();
									}
							});
							

// fonction reset formulaire

									function reset_formulaire()
									{
											if(!lignes_vente_vierge())
											{
													var c = confirm('Attention la modification des 3 premiers champs entraine la réinitialisation des lignes de vente');
													if(c)
													{
															$('.ligne_vente').each(function(){
																	$('input',this).each(function(){
																			$(this).val('');
																	});
																	$('select',this).each(function(){
																			$(this).val('');
																	});
															});
															$('#montant_total').val('');
													}
											}
									}

// partie qui gère l'ajout et la suppression de ligne de vente
		// fonction qui met à jour les indics des for, des names et des id de toutes les lignes devente
		function maj_indice_lignes_vente()
		{
				if($('.ligne_vente').length!==0)
				{
						$('.ligne_vente').each(function(num_ligne){
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

		// on supprime la ligne du bouton Delete lorsque l'on clique sur le bouton delete et on met à jour les indices des for, des names et des id
		$('.suppression_ligne').click(function(){
				if($('.ligne_vente').length!==1)
				{
						var ligne_cmde_associe = $(this).parents('.ligne_vente')[0];// on sélectionne la ligne à supprimer
						$(ligne_cmde_associe).remove();// on la supprime
						maj_indice_lignes_vente(); // on met à jour les indices des lignes de vente
				}
				else
				{
						alert('Impossible de supprimer toutes les lignes de vente : il doit y avoir au moins une !');
				}
		});

		//clonage de la première ligne de vente afin de pouvoir l'insérer à volonté par la suite
		var clone_first_ligne_vente = clone_ligne('.ligne_vente:eq(0)');
		// ajoute une ligne de vente lorsque l'on clique sur le bouton "Ajouter ligne de vente"
		$('#ajout_ligne_vente').click(function(){
				var clone = clone_ligne(clone_first_ligne_vente);	
				$('.ligne_vente:last').after(clone);
				maj_indice_lignes_vente(); // on met à jour les indices des lignes de vente
				$('#devise').trigger('change');
		});



// lorsque qu'on clique sur le champ montant totale ou que l'on change de devise, on calcule et on charge le montant total de la vente dans le champ qui lui est consacré si c'est possible 
									function calcul_montant_final()
									{
											var montant_total = 0;
											var calcul_possible = true;
											$('.ligne_vente').each(function(num_ligne){
															
													var qte_vendu = $('input:eq(0)',$(this));
													var prix_unitaire = $('input:eq(3)',$(this));
													if(isNaN($(qte_vendu).val()) || $(qte_vendu).val()=="")
													{
															alert('Veuillez remplir correctement le champ quantité vendu de la ligne n°'+(num_ligne+1));
															$('#montant_total').val('');
															calcul_possible=false;
															return false;
													}
													if(isNaN($(prix_unitaire).val()) || $(prix_unitaire).val()=="")
													{
															alert('Veuillez remplir correctement le champ prix unitaire de la ligne n°'+(num_ligne+1));
															$('#montant_total').val('');
															calcul_possible=false;
															return false;
													}
															montant_total+=$(qte_vendu).val()*$(prix_unitaire).val();

											});
											if(calcul_possible)
													$('#montant_total').val(montant_total);
											else
													return(false);
									}


									$('#calcul_montant').click(function(){
											calcul_montant_final();
									});



// partie soumission du formulaire lorque l'on clique sur "enregistrer"
						// pour connaitre le bouton de soumission du formulaire
								var buttonpressed;
								$('[type="submit"]').click(function() {
										buttonpressed = $(this).attr('value');
								})

								// soumission du formulaire
								$('form:eq(0)').on('submit',function(e){

										e.preventDefault();
				//première partie : vérification du bon remplissage des champs		



				// deuxième partie, si champs bien remplis alors on envoie le formulaire
										
										var id_vente={}; // pour récupérer l'id de la vente que l'on insère à la soumission du formulaire. Cela servira dans le cas de la vente immédiate pour la saisie des IMEI
										// tab infos_vente qui contient les données à envoyer à saving_ventes.php
										var infos_vente = $(this).serializeArray();
										infos_vente.push({name: 'fonction', value: buttonpressed });
										infos_vente.push({name: 'nbre_ligne_vente', value: $('.ligne_vente').length });
										// on recalcule le montant totale 
										$('#calcul_montant').trigger('click');
										// Envoi de la requête HTTP en mode asynchrone
										$.ajax({
												dataType: "json",
												url: 'traitement_bdd/saving_ventes.php', // Le nom du fichier indiqué dans le formulaire
												type: 'POST', // La méthode indiquée dans le formulaire (get ou post)
												data: infos_vente, 
												success: function(retour) { // Je récupère la réponse du fichier PHP
														if(retour[0]) // si il y pas d'erreur
														{
																var maj_client={};// ce tableau contient les données pour préremplir le formulaire de maj des données client
																$('form:eq(0)')[0].reset();
																if(buttonpressed=='vente_immediate')
																{
																		maj_client['id_vente']=retour[1]; // on ajoute la ref de la vente dans le cas d'une vente immédiate afin de pouvoir saisr les IMEI après maj des données clients
																		maj_client['fonction']='maj_client_immediate'; // permet de définir le comportement du formulaie de saisie des clients. C'est grâce à cette infos que l'on redirige vers saisie_imei par la suite
																}
																else if(buttonpressed=='a_livrer')
																{
																		maj_client['fonction']='maj_client_expe';// permet de définir le comportement du formulaire de saisie des clients 
																}
																else if(buttonpressed=='a_retirer_en_boutique')
																{
																		maj_client['fonction']='retirer_boutique';// permet de définir le comportement du formulaire de saisie des clients
																		
																}
																// on remplit le tableau avec les infos du client
																maj_client['pseudo']=$('#pseudo').val();
																maj_client['prenom']=$('#prenom').val();
																maj_client['nom']=$('#nom').val();
																console.log(maj_client);
//																post('saisie_clients.php',maj_client);// on redirige vers saisie_clients.php

														}
														else //si il y a une erreur
														{
																alert(retour[1]);
														}
												}
										});
								});
						


				});
