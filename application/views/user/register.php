<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?=isset($title_page) ? $title_page.' | ': '';?><?=APPLICATION_NAME?></title>

    <link href="<?=base_url();?>assets/client/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/client/template/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?=base_url();?>assets/client/template/css/animate.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/client/template/css/style.css" rel="stylesheet">

    <style>
        .label-error{
            color:#bb2124 !important;
            margin: 1% 0 !important;
            display:flex;
        }

        .btn-show-password{
            margin: 0 !important;
            padding: 9px 12px 10px !important;
            border: none !important;
            cursor:pointer;

        }

    </style>

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen">
        <div>
            <div>
                <h1 class="logo-name">DT</h1>
            </div>
            <h3>Crie sua conta no Diário de Trader</h3>
            <p>Crie sua conta de forma gratuita!</p>
            <form class="m-t" role="form" id="form" action="<?=base_url()?>user/save" method="post" autocomplete="off">
                
                  

                <div class="form-group">
                    <input type="text" name="name" class="form-control <?=(form_error('name')) ? 'is-invalid' : ''; ?>" placeholder="Qual o seu nome?" value="<?=set_value('name')?>">
                    <?=form_error('name','<small class="form-text text-muted label-error">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control <?=(form_error('email')) ? 'is-invalid' : ''; ?>" placeholder="Utilize seu melhor e-mail" value="<?=set_value('email')?>">
                    <?=form_error('email','<small class="form-text text-muted label-error">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="password" name="password" class="form-control <?=(form_error('password')) ? 'is-invalid' : ''; ?>" placeholder="Defina uma senha" value="<?=set_value('password')?>">
                        <span toggle="password" class="btn-show-password input-group-addon"><i class="fa fa-eye-slash"></i></span>
                    </div>  
                    <?=form_error('password','<small class="form-text text-muted label-error">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="password" name="password_match" class="form-control <?=(form_error('password_match')) ? 'is-invalid' : ''; ?>" placeholder="Confirme a senha" value="<?=set_value('password_match')?>">
                        <span toggle="password_match" class="btn-show-password input-group-addon"><i class="fa fa-eye-slash"></i></span>
                    </div> 
                    <?=form_error('password_match','<small class="form-text text-muted label-error">', '</small>'); ?>
                </div>
                <button type="submit" id="btn_send" class="btn btn-primary block full-width m-b"><i class="fa fa-check"></i> Cadastrar</button>

                <div class="mt-4">
                <a href="<?=base_url()?>recovery-password"><small>Recuperar senha</small></a>
                </div>

                <a class="btn btn-sm btn-white btn-block mt-2" href="<?=base_url()?>login">Já tenho uma conta</a>
            </form>
            <p class="m-t"> <small>Sistema gratuito para cadastro diário dos seus traders</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?=base_url();?>assets/client/template/js/jquery-3.1.1.min.js"></script>
    <script src="<?=base_url();?>assets/client/template/js/popper.min.js"></script>
    <script src="<?=base_url();?>assets/client/template/js/bootstrap.js"></script>

    <!-- Toastr style -->
    <link href="<?=base_url();?>assets/client/template/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <script src="<?=base_url();?>assets/client/template/js/plugins/toastr/toastr.min.js"></script>

</body>

<script>
    $(function(){

        $("#form").attr('autocomplete','off');

        $("#form").submit(function(e){
            $("#btn_send").prop('disabled',true).html("<i class='fa fa-spinner fa-spin'></i> Aguarde...");
        });

        $(".btn-show-password").click(function(e){
            e.preventDefault();
            var input = $("input[name='"+$(this).attr('toggle')+"']");

            if ( input.attr('type') == 'password'){
                input.attr('type', 'text');
                $(this).html('<i class="fa fa-eye"></i>');
            }else{
                input.attr('type', 'password');
                $(this).html('<i class="fa fa-eye-slash"></i>');
            }

        });

        let response_type       = '<?=$this->session->flashdata('toast_type')?>';
        let response_message    = '<?=$this->session->flashdata('toast_message')?>';
        let response_title      = '<?=$this->session->flashdata('toast_title')?>';

        toastr.options = {
            closeButton: true,
            progressBar: true,
            preventDuplicates: true,
            timeOut: 2000,
        }
        if(response_type){
            toastr[response_type](response_message,response_title);
        }
    });
</script>

</html>


