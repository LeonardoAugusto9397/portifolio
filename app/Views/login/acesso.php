<?php if (!defined('URL')) {
    header("Location: /");
    exit();
} ?>

<div class="signin" style="background-image: url('<?php echo URL . 'assets/images/login/login.jpg'; ?>');">
    <div class="signin-contents">
        <div class="row align-items-center justify-content-center">
            <div class="col-8">
                <h3>DOXO | <strong>RELATÓRIO</strong></h3>
                <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>

                <form method="POST" action="">
                    <?php if(isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset ($_SESSION['msg']);
                    }

                    if(isset($this->Dados['form'])) {
                        $valorForm = $this->Dados['form'];
                    } ?>

                    <div class="">
                        <div class="form-group">
                            <input type="text" class="form-control" name="login" placeholder="Login" autofocus value="<?php if(isset($valorForm['login'])) {echo $valorForm['login']; } ?>">
                            <i class="ik ik-user"></i>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="senha" placeholder="Senha">
                            <i class="ik ik-unlock"></i>
                        </div>
                        <div class="float-right">
                            <input type="submit" name="SendLogin" class="btn btn-primary btn-lg" value="ENTRAR">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>