<body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>">ScrumIT</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
            <li><a href="<?php echo base_url(); ?>backlog"><i class="fa fa-list-alt"></i> Backlog</a></li>
            <li><a href="<?php echo base_url(); ?>sprints"><i class="fa fa-table"></i> Sprints</a></li>
            <li><a href="<?php echo base_url(); ?>listDevs"><i class="fa fa-users"></i> Liste des contributeurs</a></li>
            <li><a href="<?php echo base_url(); ?>git"><i class="fa fa-github"></i> Git</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->userdata('nameDev') ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>projects"><i class="fa fa-folder"></i> Mes Projets</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>logout"><i class="fa fa-power-off"></i> Déconnexion</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

