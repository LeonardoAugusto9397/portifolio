<!--- Menu Superior --->
<nav class="navbar navbar-expand fixed-top">
    <div class="navbar-brand">
        <span class="ik ik-menu"></span>
    </div>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link" data-toggle="dropdown">
                <div class="navbar-user-logo float-left">
                    <img src="<?php echo URL . 'assets/images/default/user_icon.svg'; ?>" width="32" height="32">
                </div>
                <div class="navbar-info float-right">
                    <h5><?php echo $_SESSION['usuario_login']; ?></h5>
                    <?php if(isset($_SESSION['usuario_empresa_filial']) AND (!empty($_SESSION['usuario_empresa_filial']))) { ?>
                        <span><?php echo $_SESSION['usuario_empresa_filial']; ?></span>
                    <?php } else { ?>
                        <span>DOXO</span>
                    <?php } ?>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="<?php echo URL . 'configuration/banco'; ?>" class="dropdown-item">
                    <span class="ik ik-settings"></span>
                    <span>Configurações</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo URL . 'login/logout'; ?>" class="dropdown-item">
                    <span class="ik ik-power"></span>
                    <span>Sair</span>
                </a>
            </div>
        </li>
    </ul>
</nav>

<!--- Menu Lateral --->
<nav class="sidebar" id="sidebar">
    <div class="sidebar-header text-center">
        <img src="<?php echo URL . 'assets/images/default/logo_doxo.png'; ?>" width="70" height="43" alt="">
    </div>
    <div class="sidebar-lavel">Navigation</div>
    <div class="sidebar-item">
        <a href="<?php echo URL . 'home/index'; ?>">
            <i class="ik ik-home"></i>
            <span>Home</span>
        </a>
    </div>
    
    <!--- Relatórios --->
    <div class="sidebar-item">
        <a href="<?php echo URL . 'relatorio/dashboard'; ?>">
            <i class="ik ik-bar-chart-2"></i>
            <span>Relatórios</span>
        </a>
    </div>
                          
    <!--- Financeiro --->
    <!--<div class="sidebar-item">
        <a href="#financeiro" class="has-sub" data-toggle="collapse">
            <i class="ik ik-layers"></i>
            <span>Financeiro</span>
        </a>
        <div class="collapse sidebar-submenu" id="financeiro">
            <a class="sidebar-submenu-item" href="<?php echo URL . 'financeiro/'; ?>">Borderô</a>
            <a class="sidebar-submenu-item" href="<?php echo URL . 'financeiro/'; ?>">Estoque</a>
            <a class="sidebar-submenu-item" href="<?php echo URL . 'financeiro/'; ?>">Fornecedores</a>
            <a class="sidebar-submenu-item" href="<?php echo URL . 'financeiro/'; ?>">Gorjeta</a>
            <a class="sidebar-submenu-item" href="<?php echo URL . 'financeiro/'; ?>">Nota Fiscal</a>
        </div>
    </div>-->

    <!---- Produtos ---->
    <div class="sidebar-item">
        <a href="#produto" class="has-sub" data-toggle="collapse">
            <i class="ik ik-edit-1"></i>
            <span>Produtos</span>
        </a>
        <div class="collapse sidebar-submenu" id="produto">
            <a class="sidebar-submenu-item" href="<?php echo URL . 'produto/grupo'; ?>">Grupos</a>
            <a class="sidebar-submenu-item" href="<?php echo URL . 'produto/venda'; ?>">Produtos</a>
            <a class="sidebar-submenu-item" href="<?php echo URL . 'produto/tributacao'; ?>">Produtos Tributação</a>
        </div>
    </div>

    <!----- Pessoa ----->
    <div class="sidebar-item">
        <a href="#pessoa" class="has-sub" data-toggle="collapse">
            <i class="ik ik-users"></i>
            <span>Pessoas</span>
        </a>
        <div class="collapse sidebar-submenu" id="pessoa">
            <a class="sidebar-submenu-item" href="<?php echo URL . 'pessoa/perfil'; ?>">Perfil</a>
            <a class="sidebar-submenu-item" href="<?php echo URL . 'pessoa/usuario'; ?>">Usuários</a>
        </div>
    </div>

    <!-- Operacional -->
    <div class="sidebar-item">
        <a href="#operacional" class="has-sub" data-toggle="collapse">
            <i class="ik ik-monitor"></i>
            <span>Operacional</span>
        </a>
        <div class="collapse sidebar-submenu" id="operacional">
            <!--<a class="sidebar-submenu-item" href="<?php echo URL . 'operacional/combos'; ?>">Combos</a>-->
            <a class="sidebar-submenu-item" href="<?php echo URL . 'operacional/impressao'; ?>">Fila Impressão</a>
            <a class="sidebar-submenu-item" href="<?php echo URL . 'operacional/mesas'; ?>">Mesas</a>
            <a class="sidebar-submenu-item" href="<?php echo URL . 'operacional/observacoes'; ?>">Observações</a>
            <a class="sidebar-submenu-item" href="<?php echo URL . 'operacional/pdv'; ?>">PDV</a>
            <a class="sidebar-submenu-item" href="<?php echo URL . 'operacional/recebimento-formas'; ?>">Recebimento Formas</a>
            <a class="sidebar-submenu-item" href="<?php echo URL . 'operacional/eventos'; ?>">Taxa Serviço</a>
            <a class="sidebar-submenu-item" href="<?php echo URL . 'operacional/tributacao'; ?>">Tributação</a>
        </div>
    </div>
    
    <!---- Delivery ---->
    <div class="sidebar-item">
        <a href="#delivery" class="has-sub" data-toggle="collapse">
            <i class="ik ik-map-pin"></i>
            <span>Delivery</span>
        </a>
        <div class="collapse sidebar-submenu" id="delivery">
            <a class="sidebar-submenu-item" href="<?php echo URL . 'delivery/area-atuacao'; ?>">Área Atuação</a>
            <a class="sidebar-submenu-item" href="<?php echo URL . 'delivery/frete'; ?>">Frete</a>
        </div>
    </div>

    <!---- Eventos ---->
    <!--<div class="sidebar-item">
        <a href="<?php echo URL . 'schedule/list'; ?>">
            <i class="ik ik-calendar"></i>
            <span>Meus Eventos</span>
        </a>
    </div>-->
</nav>