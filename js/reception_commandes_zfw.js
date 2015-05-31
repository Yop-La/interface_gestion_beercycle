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

// gestion de la suppression et de l'ajout des lignes de stocks

		// lorsqu'on clique sur le bouton delete d'une ligne de stock cela la supprime 
				$('.delete_ligne_stock').click(function(){
						var ligne_cmde_associe = $(this).parents('.ligne_cmde');
						var ligne_stock_associe = $(this).parents('.ligne_stock');
						$(ligne_stock_associe).remove();
						maj_indice_lignes_stock(ligne_cmde_associe);
				});
		
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
				$('#ajout_ligne').click(function()
				{
						var clone = clone_ligne(clone_ligne_cmde);	
						$('#fin_des_lignes').before(clone);
						maj_indice_lignes_cmde();
				});

		// function pour mettre à jour les indices des lignes de cmde
				function maj_indice_lignes_cmde()
				{
						if($('.ligne_cmde').length!==0)
						{
								$('.ligne_cmde').each(function(num_ligne){
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

				

				
		});
