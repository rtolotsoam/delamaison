<!-- NAVBAR -->
<div class="navbar navbar-fixed-top navbar-primary main" role="navigation">
    <div class="navbar-header pull-left">
        <div class="navbar-brand">
            <div class="pull-left hidden">
                <a href="" class="toggle-button toggle-sidebar btn-navbar"><i class="fa fa-bars"></i></a>
            </div>
            <a href="#" class="appbrand innerL logo_brand"> <?php /*echo "FTE";*/ echo img('logo_head.png','logo-delamaison');  ?> </a>
        </div>
    </div>

    <?php if(isset($titre) &&  $titre =="ACCUEIL TRAITEMENT"){ ?>
    <ul class="nav navbar-nav navbar-left" style="position : relative; left: 250px;">
        <li class=" hidden-xs">
            <form class="navbar-form navbar-left" role="search">
                <div class="input-group">
                    <input type="text" id="text_search" class="form-control" placeholder="Entrez votre recherche de processus ..." />
                    <div class="input-group-btn">
                     <button type="submit" class="btn btn-inverse"  onclick="search(<?php echo $traitement; ?>); return false;"><i class="fa fa-search"></i></button> 
                    </div>
                    <span data-layout="top" data-type="alert" data-toggle="notyfy" id="msg_search"></span>

                    <span data-layout="top" data-type="warning" data-toggle="notyfy" id="msg_error"></span>
                </div>
            </form>
        </li>
    </ul> 
    <?php } ?>
  
   <?php if(isset($titre) &&  $titre !="TRAITEMENT"){ ?>
        <ul class="nav navbar-nav navbar-right hidden-xs">
            <?php 
            if($level =="admin"){
            ?>
                <?php if($gest_g == 1){ ?>
                <li><a href="<?php echo site_url('back/accueil_admin/normal'); ?>" class="menu-icon"><i class="fa fa-home"></i><span class="text_couleur"> Processus</span></a></li>
                <?php } ?>
                <?php if($gest_u == 1){ ?>
                <li><a href="<?php echo site_url('back/utilisateur'); ?>" class="menu-icon"><i class="fa fa-user"></i><span class="text_couleur"> Utilisateurs</span></a></li>
                <?php } ?>
                <li><a href="<?php echo site_url('front/historique'); ?>" class="menu-icon"><i class="fa fa-pencil-square-o"></i><span class="text_couleur"> Historique</span></a></li>
                <li><a href="<?php echo site_url('front/deconnexion'); ?>" class="menu-icon"><i class="fa fa-sign-out"></i><span class="text_couleur"> Déconnexion</span></a></li>
            <?php 
            }else{
            ?>  
                <?php if($titre != "ACCUEIL CATEGORIE"){ ?>
                <?php if($titre =="ACCUEIL TRAITEMENT"){ ?>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle user" data-toggle="dropdown">
                        <i class="fa fa-user"></i>
                        <span class="hidden-xs hidden-sm"> &nbsp; <?php echo ascii_to_entities($prenom); ?> </span> 
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu list">
                        <li>
                            <a href="#profil_user" data-toggle="modal" style="color: white;">Votre profil &nbsp; <i style="color: white;" class="fa fa-eye pull-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <li><a href="<?php echo site_url('front/accueil_traitement/normal'); ?>" class="menu-icon"><i class="fa fa-home"></i><span class="text_couleur"> Accueil</span></a></li>
                <li><a href="<?php echo site_url('front/historique'); ?>" class="menu-icon"><i class="fa fa-pencil-square-o"></i><span class="text_couleur"> Historique</span></a></li>
                <?php } ?>
                <li><a href="<?php echo site_url('front/deconnexion'); ?>" class="menu-icon"><i class="fa fa-sign-out"></i><span class="text_couleur"> Déconnexion</span></a></li>
            <?php 
            }
            ?>
        </ul>
    <?php  }else{ ?>
        <ul class="nav navbar-nav navbar-right hidden-xs">
            <li><a href="#modal-accueil" data-toggle="modal" class="menu-icon"><i class="fa fa-home"></i><span class="text_couleur"> Accueil</span></a></li>
        </ul>
    <?php  } ?>
</div>
<!-- END NAVBAR -->