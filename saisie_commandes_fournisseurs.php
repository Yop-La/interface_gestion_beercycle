<?php
	session_start();
	header ('Content-type:text/html; charset=utf-8');
	if(!isset($_SESSION['identification']))
	{
			$_SESSION['identification']=false;
	}
		header ('Content-type:text/html; charset=utf-8');
?>

<!DOCTYPE html>
	<html>
  <head>
		<title> Saisie des commandes fournisseurs</title>
    <meta charset="utf-8">
    <link rel='stylesheet' href='watable/watable.css'/>	
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/tuto.css" rel="stylesheet"> 
 		<script src="bootstrap/js/jquery.js"></script>
    <script src="watable/jquery.watable.js" type="text/javascript" charset="utf-8"></script>
 </head>
  <body>
    <div class="container">
      <?php include("header.php");
      			include("menu.php");
						/* retourne un menu qui change en fonction de la page et du visiteur ( de ses droits ) */
						afficherMenuEtTitre(1,'commandeBEE');
						if($_SESSION['identification'])
						{
			?>

			<aside class="contenu">
					<article>
								<div class="row">
										<h4 style="text-align:center" class="col-lg-offset-3 col-lg-6">Liste des demandes de produits non satisfaites</h4>
								</div>
								<div class="row">
										<div class="col-lg-offset-3">
										<div id="table_dmd"></div>
								</div>
					</article>
					<article>
						<div class="row">
							<h4 style="text-align:center" class="row col-lg-offset-3 col-lg-6">Saisie des commandes fournisseurs</h4>
						</div>
						<div class="row">
							<form class="col-lg-offset-3 col-lg-6 well" id="cmde_fournisseurs">
								<legend> Entête de la commande </legend>
								<div class="row">
									<div class="col-lg-4 col-lg-offset-2">
										<label for="date_commande">Date de la commande</label>
										<input type="date" name=date_commande" id="date_commande" class="form-control">
									</div>
									<div class="col-lg-4">
										<label for="fournisseur">Nom du fournisseur</label>
										<select name="fournisseur" id="fournisseur" class="form-control">
											<option value="fournisseur_1"> Fournisseur n°1 </option>
											<option value="fournisseur_2"> Fournisseur n°2 </option>
											<option value="fournisseur_3"> Fournisseur n°3 </option>
										</select>
									</div>
								</div>
								<legend> Détails de la commande </legend>
								<div class="row">
									<div class="row">
										<label class="col-lg-3">Réf demande zfw</label>
										<label class="col-lg-3">Référence du produit</label>
										<label class="col-lg-3">Quantitée commandée</label>
										<label class="col-lg-3">Prix unitaire</label>
									</div>
								</div>
								<div class="row form-group" id="row1">
									<div class="col-lg-3">
											<input type="text" name="ref_dmd_zfw1" class="form-control form-group" id="ref_dmd_zfw1">
									</div>
									<div class="col-lg-3">
										<select name="ref_produit1" class="form-control" id="ref_produit1">
											<option selected="selected"></option>    
											<option value="produit1"> Produit n°1 </option>
											<option value="produit2"> Produit n°2 </option>
											<option value="produit3"> Produit n°3 </option>
										</select>
									</div>
									<div class="col-lg-3">
										<input type="text" name="qte_cmde1" class="form-control" id="qte_cmde1">
									</div>
									<div class="col-lg-3">
										<input type="text" name="prix_unitaire1" class="form-control" id="prix_unitaire1">
									</div>
								</div>
								<div class="row" id='commandes'>
									<div class="col-lg-4">
										<button class="btn btn-default form-control" type="button" id="ajouter">Ajouter</button>
									</div>
									<div class="col-lg-4">
										<div class="input-group">
											<input type="text" class="form-control" style="text-align:right">
											<span class="input-group-btn">
												<button class="btn btn-default" type="button" id="supprimer">Supprimer</button>
											</span>
										</div>
									</div>
									<div class="col-lg-4">
										<button type="submit" class="btn btn-danger form-control" id="valider"> Valider </button>
									</div>
								</div>
							</form>
						</div>
					</article>

			</aside>

			<?php 
						}else
						{
							echo header('Location: acceuil.php');
						}
					/* Pied de page  */		
      		include("footer.php"); 
			?>
  	</div>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
					

				$(document).ready( function() {



				/* cette partie gère le lien entre le tableau des demandes zfw et le formulaire de saisie des fournisseurs */

				// création d'un indice qui permet de connaitre le nombre de lignes du formulaire de saisie de commandes fournisseurs
				var nbre_lignes_form=1; // il y a par défaut une ligne vide dans le formulaire
		
				// création d'un tableau qui va contenir le nbre de lignes vide du formulaire
				var indices_ligne_vide=[]; // il y a par défaut une ligne vide dans le formulaire
	
				// fonction qui insère une ligne vierge en dernière position dans le formulaire
				// une ligne est une série de champs
				function insert_row(){
							// on clone la dernière ligne
							var ligne_vierge=$('#row'+nbre_lignes_form).clone();
							// on retire la classe form-group à la dernière ligne
							$('#row'+nbre_lignes_form).removeClass('form-group');
							// on met à jour le nbre de lignes car une nouvelle va être inséré
							nbre_lignes_form++;
							// on change l'id de la ligne que l'on va inséré
							ligne_vierge.removeAttr('id');
							ligne_vierge.attr('id','row'+nbre_lignes_form);
							// on insère la ligne
							ligne_vierge.insertBefore($('#commandes'));
							// on modifie les attributs name et id des champs de cette ligne fraichement insérées
							$('#row'+nbre_lignes_form+' [name]').each(function(){
									// modification des id
									id_a_changer=$(this).attr('id');
									$(this).attr('id',id_a_changer.replace(/\d+$/,nbre_lignes_form));
									//modification des valeurs
									$(this).val('');
									// modification des name
									name_a_changer=$(this).attr('name');
									$(this).attr('name',name_a_changer.replace(/\d+$/,nbre_lignes_form));
							});
				}
				
				//function qui supprime la dernière ligne du formulaire
				function delete_row(){
						var num_ligne=$('#commandes input').val();
						if(isNaN($('#commandes input').val())){
								alert('Entrez un numéro de ligne : 1 ou 2 ou 3,etc.');
						}else{
								$('#row'+num_ligne).remove();
								if(num_ligne==nbre_lignes_form){
										$('#row'+nbre_lignes_form).addClass('form-group');
								}
								// on modifie les attributs name et id des champs des lignes qui suivent la ligne supprimée
								// ainsi que l'id dee ces lignes
								for(var i=parseInt(num_ligne)+1;i<=nbre_lignes_form;i++){
										$('#row'+i+' [name]').each(function(){
												// modification des id
												id_a_changer=$(this).attr('id');
												$(this).attr('id',id_a_changer.replace(/\d+$/,(i-1)));
												// modification des name
												name_a_changer=$(this).attr('name');
												$(this).attr('name',name_a_changer.replace(/\d+$/,(i-1)));
										});
										var j=i-1;
										$('#row'+i).attr('id','row'+j);
								}
								nbre_lignes_form--;
						}
				}


				//fonction qui compte le nombre de lignes vide
				function maj_ligne_vide(){
						indices_ligne_vide=[];
						var check=false;
						$('[id*="row"] [name]').each(function(index){
								if(/^ref/.test(this.id) && this.value==''){
										if(check==true && this.value==''){
												indices_ligne_vide.push(this.id.match(/\d+/));
										}
										check=true;

								}else{
										check=false;
								}
						});
				}

				// cette fonction va être appelé à chaque fois que l'on cliquera sur une ligne
				// à chaque clic, on ajoute la ligne du tableau au formulaire de saisie des commandes fournisseurs
				function ajoutOuMAJLigneFormSaisieCmde(data){
						// on récupère le formulaire de saisie des cmdes fournisseurs
						var form_saisie_cmde = document.getElementById('cmde_fournisseurs');
						// on récupère la 1ère ligne de champs de saisie du formulaire qui sert de modèle
						var ligne_champs_modele = document.getElementById('row1');
						maj_ligne_vide();
						// si le nombre de lignes vides n'est pas égale à zéro alors on met à jour celle avec le plus petit indice
						if(indices_ligne_vide.length!=0){
							// on récupère la première ligne vide et on la retire du tableau des lignes vides
							indices_ligne_vide.sort();	
							var first_empty_row = indices_ligne_vide.shift();

							// on met à jour le champ référence produit
							var first_empty_select_ref_prdt= document.getElementById('ref_produit'+first_empty_row);
							
							for(var i=0; i<first_empty_select_ref_prdt.options.length;i++){
								var option=first_empty_select_ref_prdt.options[i]
								if(option.value==data.row.ref_produit){
									first_empty_select_ref_prdt.selectedIndex=option.index;
								}
							}
							// on met à jour le champ référence demande
							document.getElementById('ref_dmd_zfw'+first_empty_row).value=data.row.ref_dde_zfw;
							
							// si le nombre de lignes vide est égale à zéro alors on ajoute une ligne 
							}else{	
								// on insère une ligne vide que l'on va remplir avec les données de la ligne sur qui a été cliquée
								insert_row();

								// on modifie le champ de saisie des références à la demande de produits de zfw graĉe à la ligne cliquée	
								$('[name="ref_dmd_zfw'+nbre_lignes_form+'"]').val(data.row.ref_dde_zfw);
								$('[name="ref_produit'+nbre_lignes_form+'"]').val(data.row.ref_produit);
								
								// on modifie le champ de saisie des produits grâce à la ligne cliquée	
					/*			select_ref_prdt.id=select_ref_prdt.name='ref_produit'+nbre_lignes_form;
								for(var i=0; i<select_ref_prdt.options.length;i++){
									var option=select_ref_prdt.options[i]
									if(option.value==data.row.ref_produit){
										select_ref_prdt.selectedIndex=option.index;
									}
								}*/
	
								// on met le tableau qui contient les lignes vides
								maj_ligne_vide();
							}
				}

				/* fin de la partie */



				/* partie évenementielle des boutons de commandes du formulaire */
    		
				/* si on clique sur ajouter cela ajoute une ligne vide au formulaire */
				$('#ajouter').click(function(){
						insert_row();
						maj_ligne_vide();
						});
				
				/* si on clique sur supprimer cela supprime la dernière ligne du formulaire*/
				$('#supprimer').click(function(){
						delete_row();
						maj_ligne_vide();
						});
                
                //Second example that shows all options.
                var waTable = $('#table_dmd').WATable({	
                //data: generateSampleData(100), //Initiate with data if you already have it
                debug:false,                //Prints some debug info to console
                dataBind: true,             //Auto-updates table when changing data row values. See example below. (Note. You need a column with the 'unique' property)
                pageSize: 8,                //Initial pagesize
                pageSizePadding: true,      //Pads with empty rows when pagesize is not met
                //transition: 'slide',       //Type of transition when paging (bounce, fade, flip, rotate, scroll, slide).Requires https://github.com/daneden/animate.css.
                //transitionDuration: 0.2,    //Duration of transition in seconds.
                filter: true,               //Show filter fields
                sorting: true,              //Enable sorting
                sortEmptyLast:true,         //Empty values will be shown last
                columnPicker: true,         //Show the columnPicker button
                pageSizes: [1,5,8,12,200],  //Set custom pageSizes. Leave empty array to hide button.
                hidePagerOnEmpty: true,     //Removes the pager if data is empty.
                checkboxes: true,           //Make rows checkable. (Note. You need a column with the 'unique' property)
                checkAllToggle:true,        //Show the check-all toggle
                preFill: true,              //Initially fills the table with empty rows (as many as the pagesize).
                //url: '/someWebservice'    //Url to a webservice if not setting data manually as we do in this example
                //urlData: { report:1 }     //Any data you need to pass to the webservice
                //urlPost: true             //Use POST httpmethod to webservice. Default is GET.
                types: {                    //If you want, you can supply some properties that will be applied for specific data types.
                    string: {
                        //filterTooltip: "Giggedi..."    //What to say in tooltip when hoovering filter fields. Set false to remove.
                        //placeHolder: "Type here..."    //What to say in placeholder filter fields. Set false for empty.
                    },
                    number: {
                        decimals: 1   //Sets decimal precision for float types
                    },
                    bool: {
                        //filterTooltip: false
                    },
                    date: {
                      utc: true,            //Show time as universal time, ie without timezones.
                      //format: 'yy/dd/MM',   //The format. See all possible formats here http://arshaw.com/xdate/#Formatting.
                      datePicker: true      //Requires "Datepicker for Bootstrap" plugin (http://www.eyecon.ro/bootstrap-datepicker).
                    }
                },
                actions: {                //This generates a button where you can add elements.
                    filter: true,         //If true, the filter fields can be toggled visible and hidden.
                    columnPicker: true,   //if true, the columnPicker can be toggled visible and hidden.
                    custom: [             //Add any other elements here. Here is a refresh and export example.
                      $('<a href="#" class="refresh"><span class="glyphicon glyphicon-refresh"></span>&nbsp;Refresh</a>'),
                      $('<a href="#" class="export all"><span class="glyphicon glyphicon-share"></span>&nbsp;Export all rows</a>'),
                      $('<a href="#" class="export checked"><span class="glyphicon glyphicon-share"></span>&nbsp;Export checked rows</a>'),
                      $('<a href="#" class="export filtered"><span class="glyphicon glyphicon-share"></span>&nbsp;Export filtered rows</a>'),
                      $('<a href="#" class="export rendered"><span class="glyphicon glyphicon-share"></span>&nbsp;Export rendered rows</a>')
                    ]
                },
                tableCreated: function(data) {    //Fires when the table is created / recreated. Use it if you want to manipulate the table in any way.
                    console.log('table created'); //data.table holds the html table element.
                    console.log(data);            //'this' keyword also holds the html table element.
                },
                rowClicked: function(data) {      //Fires when a row or anything within is clicked (Note. You need a column with the 'unique' property).
                    console.log('row clicked');   //data.event holds the original jQuery event.
                                                  //data.row holds the underlying row you supplied.
                                                  //data.index holds the index of row in rows array (Useful when you want to remove the row)
                                                  //data.column holds the underlying column you supplied.
                                                  //data.checked is true if row is checked. (Set to false/true to have it unchecked/checked)
                                                  //'this' keyword holds the clicked element.


										// création de l'indice qui permet de connaître le nombre de ligne du formulaire
										ajoutOuMAJLigneFormSaisieCmde(data);
                    console.log(data.row.ref_dde_zfw);
                },
                columnClicked: function(data) {    //Fires when a column is clicked
                  console.log('column clicked');  //data.event holds the original jQuery event
                  console.log(data);              //data.column holds the underlying column you supplied
                                                  //data.descending is true when sorted descending (duh)
                },
                pageChanged: function(data) {      //Fires when manually changing page
                  console.log('page changed');    //data.event holds the original jQuery event
                  console.log(data);              //data.page holds the new page index
                },
                pageSizeChanged: function(data) {  //Fires when manually changing pagesize
                  console.log('pagesize changed');//data.event holds teh original event
                  console.log(data);              //data.pageSize holds the new pagesize
                }
            }).data('WATable');  //This step reaches into the html data property to get the actual WATable object. Important if you want a reference to it as we want here.

						var d=
						{
							cols: {
								ref_dde_zfw: {
									index: 1,
									type: "string",
									unique: true
								},
							 ref_produit : {
									index: 2,
									type: "string"
								},
							 date_dde : {
									index: 3,
									type: "date"
								},
							 qte_dde : {
									index: 4,
									type: "number"
								},
							 qte_cde : {
									index: 5,
									type: "number"
								}
							},
							rows: [
								{
									ref_dde_zfw: "2",
									ref_produit: "produit1",
									date_dde: 1428422089852, 
									qte_dde: 4,
									qte_cde: 2

								},
								{
									ref_dde_zfw: "3",
									ref_produit: "produit2",
									date_dde: 1428422089852,
									qte_dde: 4,
									qte_cde: 2

								},
								{
									ref_dde_zfw: "4",
									ref_produit: "produit3",
									date_dde: 1428422089852, 
									qte_dde: 4,
									qte_cde: 2

								}
							]
						};

						waTable.setData(d);
						});

		</script>
  </body>
</html>

