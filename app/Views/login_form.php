<section id="sectionLogin">
    <div class="card">
        <div class="card-body">
            <h1><?php echo $titre;?></h1>
            <h2 class="text-muted"><?php echo $soustitre;?></h2>
            <?php echo form_open('admin/login'); ?>
                <div class="row">
                    <div class="col-md-1 text-end">
                        <i class="fa-solid fa-user align-bottom"></i>
                    </div>
                    <div class="col-md-7">
                        <?php

                            $input = array(
                                'name'          => 'login',
                                'placeholder'   => 'Nom d\'utilisateur',
                                'class'         => 'form-control'
                            );
                            echo form_input($input);

                        ?>
                    </div>
                </div>
                <?php if (isset($erreurs) && array_key_exists('login',$erreurs)) { ?>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-7">
                            <?php echo "<span class='text-danger'><i class='fa-solid fa-triangle-exclamation'></i> ".$erreurs['login'].'</span><br>'; ?>
                        </div>
                    </div>
                <?php } ?>
                <br>

                <div class="row">
                    <div class="col-md-1 text-end">
                        <i class="fa-solid fa-key align-bottom"></i>
                    </div>
                    <div class="col-md-7">
                        <?php

                            $inputpwd = array(
                                'name'          => 'pwd',
                                'placeholder'   => 'Mot de passe',
                                'class'         => 'form-control',
                                'id'            => 'pwd'
                            );
                            echo form_password($inputpwd);

                        ?>
                    </div>
                </div>
                <?php if (isset($erreurs) && array_key_exists('pwd',$erreurs)) { ?>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-7">
                            <?php echo "<span class='text-danger'><i class='fa-solid fa-triangle-exclamation'></i> ".$erreurs['pwd'].'</span><br>'; ?>
                        </div>
                    </div>
                <?php } ?>
                <br>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <?php

                            $subm = array(
                                'type'      => 'submit',
                                'content'   => 'Se connecter',
                                'class'     => 'btn btn-success',
                                'id'        => 'btnLogin'
                            );
                            echo form_button($subm);

                        ?>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>