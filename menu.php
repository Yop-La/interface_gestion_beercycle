			<?php
				
					
				/* cette fonction gère le menu et les titres de toutes les pages. Elle propose un menu et un titre adapéte à la page */
				function afficherMenuEtTitre($droit,$page)
				{


				
						/* tableau des titres de page dont le contenu change en fonction de la page */
						$titre_page = array(
								'access'=> 'Portal Access',
								'acceuil' => 'Home page');
					
						/* fonction mise en forme menu qui va mettre en surbrillance dans le menu la page courante */
						function forme_menu($toDesign,$page)
						{
								if($toDesign==$page)
								{
									return 'class="Bold"';
								}
						}

			?>
						<nav class="row navbar navbar-default">
							<ul class="nav navbar-nav">
								<li> <a <?php echo forme_menu('access',$page)?> href="#">Portal Access</a></li>
								<li> <a <?php echo forme_menu('acceuil',$page)?> href="#">Home page</a> </li>
								<li class="dropdown">
									<a data-toggle="dropdown" href="#" <?php echo forme_menu('admin',$page)?> >Administration<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="#">Ajouter une devise</a></li>
										<li><a href="#">Mettre à jour les cours</a></li>
										<li><a href="#">Ajouter un utilisateur</a></li>
										<li><a href="#">Ajouter des fournisseurs</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a data-toggle="dropdown" href="#" <?php echo forme_menu('commandeBEE',$page)?> >Gestion des commandes BEE<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="#">Saisie des commandes fournisseurs</a></li>
										<li><a href="#">Gestion des expédétions de BEE vers ZFW</a></li>
										<li><a href="#">Réception des commandes de BEE</a></li>
										<li><a href="#">Bilan produit commandés/réceptionnés</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a data-toggle="dropdown" href="#" <?php echo forme_menu('commandeZFW',$page)?> >Gestion des commandes ZFW<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="#">Demandes de ZFW</a></li>
										<li><a href="#">Report sur les ventes</a></li>
										<li><a href="#">Réception des commandes de ZFW</a></li>
										<li><a href="#">Bilan produit commandés/réceptionnées</a></li>
										<li><a href="#">Produis en cours d'expédition</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a data-toggle="dropdown" href="#" <?php echo forme_menu('Ventes',$page)?> >Ventes et produits<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="#">Saisie des ventes</a></li>
										<li><a href="#">Mise à jour du catalogue</a></li>
										<li><a href="#">Expéditions vers les clients</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a data-toggle="dropdown" href="#" <?php echo forme_menu('Facture',$page)?> >Facturation<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="#">Facturation de ZFW par BEE</a></li>
										<li><a href="#">Etat des facturations de BEE</a></li>
										<li><a href="#">Facturation de BEE par les fournisseurs</a></li>
										<li><a href="#">Etat des facturations des fournisseurs</a></li>
									</ul>
								</li>
							</ul>
						</nav>
						<h2 class="row col-lg-offset-4 col-lg-4">
			<?php
						echo $titre_page[$page];
						echo '</h2>';
				}
			?>
