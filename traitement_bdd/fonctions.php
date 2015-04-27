<?php
		
		// fonction pour vérifier que post est un entier
		function verif_entier($post)
		{
				if (is_numeric($post) && (intval(0 + $post) == $post)) {
						return true;
				} else {
						return false;
				}
		}

		// fonction pour vérifier post est un double
		function verif_double($post)
		{
				if(is_numeric($post)) {
						return true;
				} else {
						return false;
				}
		}

		// fonction pour vérifier que post n'est pas une chaîne vide

		function verif_chaine_non_vide($post)
		{
				if($post!='') {
						return true;
				} else {
						return false;
				}
		}

?>
