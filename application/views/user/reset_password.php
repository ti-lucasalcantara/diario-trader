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
            <h3>Recuperção de senha</h3>
            <p>Crie uma nova senha</p>
            <form class="m-t" role="form" id="form" action="<?=base_url()?>user/savePassword" method="post" autocomplete="off">
                
                <input type="hidden" name="encrypt_mail" value="<?=set_value('encrypt_mail', $encrypt_mail)?>">
                <input type="hidden" name="user_id" value="<?=set_value('user_id', $user_id)?>">

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
                
                <button type="submit" id="btn_send" class="btn btn-primary block full-width mb-5"><i class="fa fa-check"></i> Salvar nova senha</button>

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


