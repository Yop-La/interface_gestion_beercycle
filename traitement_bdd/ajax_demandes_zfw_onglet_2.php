<?php
			function array_push_assoc($array, $key, $value){
					$array[$key] = $value;
					return $array;
			}
 		 // le but de ce fichier est d'élaborer un programme capable de  mettre au format json les données d'une requête afin de les utiilse dans une watable

  		header ('Content-type:text/html; charset=utf-8');
			include("connexion.php");
			

			// ici la requête doit forcément utiliser des allias pour les tables
			// lorsque que deux champs de tables différentes portent le même nom, il faut leur donner des allias. Ce n'est que dans ce cas qu'il faut leur donner des allias
			$requete_sql="select ref_dde_zfw, libelle, dz.user_id as fuser  , cd.user_id as suser,dz.date_demande, dz.date_dern_maj, p.commentaire, p.modele from canal_de_distribution as cd  ,demande_zfw as dz, produit as p where cd.ref_canal_distrib = dz.ref_canal_distrib and dz.ref_produit=p.ref_produit"; 

		function remplir_watable_avec_requete($requete,$connexion_bdd)
		{
				// on sélectionne ici dans la requête le nom des tables 

							// on sélectionne tous ce qu'il y entre from et where
							preg_match('#from(.+)where#',$requete,$match);

							// on récupère dans le tableau $nom_tables tout les noms des tables
							$tampon = preg_replace('#\s+as\s+\w+|\s+|\s+$#','',$match[1]);
							$nom_tables = preg_split('#,#',$tampon);

							// on récupère dans le tableau $allias_tables tout les allias des tables
							$tampon = preg_replace('#\w+\s+as\s+|\s+|\s+$#','',$match[1]);
							$allias_tables = preg_split('#,#',$tampon);
				// pour sélectionner les noms ou les allias des colonnes des tables sélectionnées dans la requête
							// on instancie le tableau nom_champs_requete qui va contenir le nom de tout les champs du tableau.
							// Un champ est ici soit le nom de la colonne soit son allias
							$nom_champs_requete = array();
							$reponse = $connexion_bdd->query($requete);
							$row = $reponse->fetch();
							$i = 0;
							foreach($row as $cle => $element)
							{
									if($i%2==0)
											array_push($nom_champs_requete,$cle);
									$i++;
							}

				 // pour pouvoir lier l'allias d'un champ au nom exacte de sa colonne et à sa table. Pour se faire, on va stocker ses 3 infos dans le tableau $alias_nom_champ_nom_table. Cette table contient uniquement les champs avec allias
							
							// on capture dans select_from[1] tous ce qu'il y a entre select et from
							preg_match('#select(.+)from#',$requete,$select_from);
							//on capture les déclaration des allias
							preg_match_all('#(\w+\.\w+\s+as\s+\w+)#',$select_from[1],$declas_allias);
							$allias_nom_champ_nom_table=array();
							foreach($declas_allias[1] as $decla_allias)
							{
									// on récupère les 3 données d'intérêt : l'alias du champ, son nom, sa table
									preg_match('#^(\w+).(\w+)\s+as\s+(\w+)#',$decla_allias,$infos_allias_champ);
									$allias_table = $infos_allias_champ[1];
									$nom_champ = $infos_allias_champ[2];
									$allias_champ = $infos_allias_champ[3];
									
									// on récupère le nom de la table à partir de son allias
									$nom_table=$nom_tables[array_search($allias_table,$allias_tables)];
						
									// on stocke ses informations dans un tableau que l'on va mettre dans le tableau
									$tab_tampon=array();
									array_push($tab_tampon,$nom_table);
									array_push($tab_tampon,$nom_champ);
									array_push($tab_tampon,$allias_champ);
									array_push($tab_tampon,$allias_table);

									// on lie le nom de la table, le nom du champ et son alias dans un tableau : $allias_nom_champ_nom_table
									array_push($allias_nom_champ_nom_table,$tab_tampon);

							}

				// contruction du tableau $nom_champs_exactes qui contient le nom exacte des champs ( et pas leur alias )
							
							$nom_champs_exactes=array();
							foreach($nom_champs_requete as $nom_champ_requete)
							{
									$remplissage=false;
									foreach($allias_nom_champ_nom_table as $idem_courant)					
									{
											if(strcmp($nom_champ_requete,$idem_courant[2])==0)
											{
													if($remplissage==false)
													{
															$remplissage=true;
															array_push($nom_champs_exactes,$idem_courant[1]);
													}
											}
									}
									if($remplissage==false)
									{
											array_push($nom_champs_exactes,$nom_champ_requete);
									}
							}
					
				// tableau qui associe à un champ de la requête sa table d'origine : $champ_to_table
					

						$champ_to_table=array();
						foreach($nom_champs_requete as $nom_champ_requete)
						{
								$champ_traite=false;
								foreach($allias_nom_champ_nom_table as $courant)
								{
										if(strcmp($nom_champ_requete,$courant[2])==0)
										{
												$champ_traite=true;
												if(array_key_exists($courant[1],$champ_to_table)==false)
												{
														$tampon=array();
														array_push($tampon,$courant[0]);
														$champ_to_table=array_push_assoc($champ_to_table,$courant[1],$tampon);					
												}
												else
												{
														array_push($champ_to_table[$courant[1]],$courant[0]);
												}
										}
								}
								if($champ_traite==false)
								{
										$champ_traite=true;	
										foreach($nom_tables as $nom_table)
										{
												$champs_table_courante = $connexion_bdd->query("SHOW COLUMNS from ".$nom_table );
												while($champ_table_courante = $champs_table_courante -> fetch())
												{		
														if(strcmp($champ_table_courante[0],$nom_champ_requete)==0)
														{
																$champ_to_table=array_push_assoc($champ_to_table,$nom_champ_requete,$nom_table);					
														}
												}

										}

								}
						}
							
					// On va construire un tableau champs qui va contenir des infos sur les champs de la requête, chaque élement de ce tableau sera un tableau de 4 cases dont la première sera le nom du champ, la deuxième, le type du champ ( varchar, int ou double , date ), la troisième nous dira s'il agit d'une clé primaire ou non et enfin la quatrième nous donnera l'allias du champ

							$champs=array();
							foreach($nom_tables as $nom_table)
							{
									$champs_table_courante = $connexion_bdd->query("SHOW COLUMNS from ".$nom_table );
									while($champ_table_courante = $champs_table_courante -> fetch())
									{
											
											
											if(in_array($champ_table_courante[0],$nom_champs_exactes))
											{
													// on vérifie que le champ est bien un champ de la requête
													$tabs=$champ_to_table[$champ_table_courante[0]];
													$type=gettype($tabs);
													$provenance=false;
													if(strcmp($type,"string")==0 and strcmp($nom_table,$tabs)==0)
															$provenance=true;
													if(strcmp($type,"array")==0 and in_array($nom_table,$tabs))
															$provenance=true;
													if($provenance==true)	
													{
															$champ = array();
															$remplissage=false;
																
															// on récupère toutes les infos sur le champ courant dans champ
															array_push($champ,$champ_table_courante[0]);
															array_push($champ,$champ_table_courante[1]);
															array_push($champ,$champ_table_courante[3]);
																	
															foreach($allias_nom_champ_nom_table as $idem_courant)					
															{
																	if(strcmp($champ_table_courante[0],$idem_courant[1])==0 and strcmp($nom_table,$idem_courant[0])==0)
																	{
																			if($remplissage==false)
																			{
																					$remplissage=true;
																					array_push($champ,$idem_courant[2]);
																			}
																	}
															}
															if($remplissage==false)
															{
																	array_push($champ,$champ_table_courante[0]);
															}
																	
															// on ajoute ce champ courant à table des champs
															array_push($champs,$champ);
													}
											}
									}
							}


							$reponse = $connexion_bdd->query($requete);
							
							// on va d'abord reconstituer le champ col: de l'objet json que watable va utilisé
							$index=1;
							$nbre_col_tot=(count($champs));
							echo '{ cols: {';
						// on boucle sur les colonnes
							foreach($champs as $col)
							{
									echo $col[3].': {';
									echo 'index: '.$index.',';
									if(preg_match("#varchar#",$col[1]))
											echo 'type: "string"';
									elseif(preg_match("#int#",$col[1]))
											echo 'type: "number"';
									else
											echo 'type: "date"';	
									if($index!=$nbre_col_tot)
											echo ',';
									elseif(preg_match("#PRI#",$col[2]))
											echo ',';
									if(preg_match("#PRI#",$col[2]) and $index==$nbre_col_tot)
										echo 'unique: true';
									elseif(preg_match("#PRI#",$col[2]) and $index!=$nbre_col_tot)
										echo 'unique: true,';
									if($index==$nbre_col_tot)
										echo '}';
									else
										echo '},';
									$index++;
							}
							echo "},";
							echo 'rows: [';
							$nbreligne=1;
							$nbre_row_tot=$reponse->rowCount();
							// on reconstitue maintenant la partie rows de l'objet json que l'on va envoyer
							// on boucle sur les lignes
							while ($row = $reponse->fetch())
							{
									echo '{';
									$nbre_col=1;
									// on boucle sur les colonnes
									foreach($champs as $col)
									{
											if(preg_match("#varchar#",$col[1]))
													echo $col[0].': "'.$row[$col[3]].'"';
											elseif(preg_match("#int#",$col[1]))
													echo $col[0].': '.$row[$col[3]];
											else{	
													echo $col[0].': '.(strtotime($row[$col[3]])*1000);

											}
											if($nbre_col!=($nbre_col_tot))
											{
													echo ',';
											}
											$nbre_col++;
											
									}
									if($nbreligne==$nbre_row_tot)
										echo '}';
									else
										echo '},';
									$nbreligne++;
							}
							echo ']}';
		}
		remplir_watable_avec_requete($requete_sql,$bdd);
?>
