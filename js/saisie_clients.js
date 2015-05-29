$(function() {
		switch(erreur_post) {
    case 0:
        alert("Le post fonction n'est pas définie ! \n Veuillez refaire votre saisie");
				window.location.replace("identification_client.php");
        break;
    case 1:
        alert("Tous les post pour mettre à jour les données client nécessaire à l'expédition ne sont pas tous non vides \n Veuillez refaire votre saisie");
				window.location.replace("identification_client.php");
				break;
    case 2:
        alert("Tous les post pour mettre à jour les données client nécessaire à la vente immédiate ne sont pas tous non vides \n Veuillez refaire votre saisie");
				window.location.replace("identification_client.php");
				break;
    case 3:
        alert("Le post 'fonction' ne contient pas une valeur attendue \n Veuillez refaire votre saisie");
    case 4:
        alert("Tous les post pour mettre à jour les données client nécessaire à la remise du produit en boutique ne sont pas tous non vides \n Veuillez refaire votre saisie");
				window.location.replace("identification_client.php");
				break;
    default:
        alert('Vous pouvez commencer votre saisie');
		} 

		var cas_maj_client = ["maj_client_expe","maj_client_immediate","retirer_boutique"];// ce tableau nous toutes les valeurs de la variable fonction qu'on doit mettre à jour les données du client
		if(fonction=='insert_client')
		{
				// pour connaitre le bouton de soumission du formulaire
				var buttonpressed;
				$('[type="submit"]').click(function() {
						buttonpressed = $(this).attr('id');
				})

		// soumission du formulaire lorque l'on clique sur "enregistrer"
				$('form:eq(0)').on('submit',function(e){

						e.preventDefault();
		//première partie : vérification du bon remplissage des champs		



		// deuxième partie, si champs bien remplis alors on envoie le formulaire
						
						// Envoi de la requête HTTP en mode asynchrone
						$.ajax({
								dataType: "json",
								url: 'traitement_bdd/saving_client.php', // Le nom du fichier indiqué dans le formulaire
								type: 'POST', // La méthode indiquée dans le formulaire (get ou post)
								data: $(this).serialize()+'&fonction='+fonction, 
								success: function(retour) { // Je récupère la réponse du fichier PHP
										if(retour[0]) // si il y pas d'erreur
										{
												alert(retour[1]);
												var preremplir_vente={};
												preremplir_vente['pseudo']=$('#pseudo').val();
												preremplir_vente['prenom']=$('#prenom').val();
												preremplir_vente['nom']=$('#nom').val();
												$('form:eq(0)')[0].reset();
												if(buttonpressed=='saisie_vente')
												{	
														// on redirige vers saisie_vente si on il y a un clique sur saisie de la vente
														post('saisie_ventes.php',preremplir_vente);
												}
										}
										else //si il y a une erreur
										{
												alert(retour[1]);
												alert('Veuillez refaire votre saisie');
												window.location.replace("identification_client.php");
										}
								}
						});
				});
		}
		else if(cas_maj_client.indexOf(fonction)!=-1)
		{
				// on préremplit le formulaire avec les données de la base. A ce stade, les infos de la personne qui va acheter le produit sont soit dans la table client, soit dans la table prospect

				// tableau qui permet à partir du nom d'un champ de la table client de trouver l'id du chmap correspondant le formulaire
						var champ_table_to_champ_form_client={};
						champ_table_to_champ_form_client['username']='pseudo';
						champ_table_to_champ_form_client['email']='mail';


						
						$.ajax({
								dataType: "json",
								url: 'traitement_bdd/saisie_clients_remplissage_form.php',
								type: 'POST', // La méthode indiquée dans le formulaire (get ou post)
								data: $('form').serialize(), 
								success: function(retour) { 
										if(retour[0])
										{
												for(var id_champ in retour[1])
												{
														if(id_champ in champ_table_to_champ_form_client)
																$("#"+champ_table_to_champ_form_client[id_champ]).val(retour[1][id_champ]);
														else
														{
																$("#"+id_champ).val(retour[1][id_champ]);
														}
												}
										}
										else //si il y a une erreur
										{
												alert(retour[1]);
												alert('Veuillez refaire votre saisie');
												window.location.replace("identification_client.php");
										}
								}
						});



				// soumission du formulaire lorque l'on clique sur "enregistrer"
						$('form:eq(0)').on('submit',function(e){

								e.preventDefault();
				//première partie : vérification du bon remplissage des champs		



				// deuxième partie, si champs bien remplis alors on envoie le formulaire
								
								// Envoi de la requête HTTP en mode asynchrone
								$.ajax({
										dataType: "json",
										url: 'traitement_bdd/saving_client.php', // Le nom du fichier indiqué dans le formulaire
										type: 'POST', // La méthode indiquée dans le formulaire (get ou post)
										data: $(this).serialize()+'&fonction='+fonction, 
										success: function(retour) { // Je récupère la réponse du fichier PHP
												if(retour[0]) // si il y pas d'erreur
												{
														alert(retour[1]);
														$('form:eq(0)')[0].reset();
														if(fonction == 'maj_client_expe' || fonction == 'retirer_boutique')
														{
																window.location.replace("identification_client.php");
														}
														else if(fonction == 'maj_client_immediate')
														{
																pour_imei={};
																pour_imei['id_vente']=id_vente;				
																post('saisie_imei.php',pour_imei);
														}
												
												}
												else //si il y a une erreur
												{
														alert(retour[1]);
														alert('Veuillez refaire votre saisie');
														window.location.replace("identification_client.php");
												}
										}
								});
						});
				}
		
});
