<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	body{
		font-family:Arial, Helvetica; 
		font-size: 12px;
	}

</style>
</head>
	<body>
		<strong>
			Bonjour <?php echo ucfirst(strtolower($prenom)); ?>
		</strong>
		<br/><br/>
		<p>
			<?php
			if(isset($statut) && $statut == '1'){
			?>

				Votre compte a été créer pour utiliser l'outil d'aide à l'agent DELAMAISON.

			<?php
			}else if(isset($statut) && $statut == '0'){
			?>	

				Votre compte a été créer pour utiliser l'outil d'aide à l'agent DELAMAISON.
				</p>
				<p>Mais il n'est pas encore activé, veuillez aviser votre N+1 pour l'activer.

			<?php
			}else if(isset($statut) && $statut == 'mail_renseigne'){
			?>

				Merci d'avoir renseigner votre adresse E-mail, pour utiliser l'outil d'aide à l'agent DELAMAISON.

			<?php
			}else if(isset($statut) && $statut == 'modif_pass_mail'){
			?>

				Merci d'avoir renseigner votre adresse E-mail et votre mot de passe est modifier, pour utiliser l'outil d'aide à l'agent DELAMAISON.

			<?php
			}
			?>
		</p>
		<p>
			Ci-joint les détails
		</p>
		<h4>
			Information sur votre compte : 
		</h4>
		<ol>
			<li>Matricule : <?php echo $matricule; ?></li>
			<li>Mot de passe : <?php echo $pass; ?></li>
			<li>Lien : <a href="http://aide-agent.vivetic.com:8888/delamaison">http://aide-agent.vivetic.com:8888/delamaison</a></li>
		</ol>
		<p>Cordialement,</p>
		<hr size="0" style=" 
						border-bottom-width: 1px;	
						border-top-style: none;	
						border-right-style: none;	
						border-bottom-style: solid;	
						border-left-style: none;	
						border-bottom-color: #eaeaea; 
						margin-bottom:15px;" 
		/>
		<table border="0" cellpadding="0" cellspacing="0">
		  	<tbody>
		    	<tr>
				      <td valign="top">
				      		<a href="http://www.delamaison.fr" target="_blank">
				      			<img src="cid:logo_mail" alt="delamaison" width="193" height="51" border="0" />
				      		</a><br />
				      </td>
				      <td width="30">&nbsp;</td>
				      <td valign="top" style="
				      			font-family:Arial,Helvetica; 
				      			color:#44486b; 
				      			line-height:14px;"
				      >
					      	<strong>
					      	<span style="
					      			font-size:14px; 
					      			font-weight:bold; 
					      			letter-spacing:1px; "
					      	>
					      		ADMIN
					      	</span><br />
				          	</strong>
				          		<span style="
				          			font-size:11px; 
				          			letter-spacing:1px;"
				          		>
				          				ADMINISTRATION DELAMAISON
						          		<br />
						          		<img src="cid:logo_tel" alt="T" width="13" height="12" border="0" align="absmiddle" />          
						          		:&nbsp;+33 (0)1 xx xx xx xx<br />
						            
						            <strong>	
							            <span 
							            style="
							            	font-size:12px; 
							            	font-weight:bold;"
							          	>
							          		<img src="cid:logo_m" alt="M" width="13" height="13" border="0" align="absmiddle" />
							          	</span>
						          	</strong> 

						          		: +33 (0)6 xx xx xx xx <br />
						          		<img src="cid:logo_skype" alt="skype" width="13" height="13" border="0" align="absmiddle" /> 
						          		adresse_skype 
				          		</span>
				      </td>
				      <td width="30"></td>
				      <td width="15" valign="top" 
				      	background="cid:logo_back">
				      </td>
				      <td width="30"></td>
				      <td valign="top" style="
				      			font-family:Arial, Helvetica; 
				      			color:#44486b; 
				      			line-height:14px;"
				      >
				      	<span style="
				      			font-size:14px; 
				      			font-weight:bold; 
				      			letter-spacing:1px;"
				      	>
				      		delamaison - groupe Adeo
				      	</span>
				      	<br />
				        <span style="
				        	font-size:11px; 
				        	letter-spacing:1px;"
				        >
				        	32 avenue de l'Oc&eacute;anie - BAT C1<br />
				            ZA Courtaboeuf 3<br />
				            91 140 Villejust
				        </span>
				      </td>
		    	</tr>
		  	</tbody>
		</table>

	</body>
</html>