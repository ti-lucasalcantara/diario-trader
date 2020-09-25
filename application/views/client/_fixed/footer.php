

            <div class="footer"> 
                <div class="float-right">&copy; Todos os direitos reservados</div>
                <div><?=APPLICATION_NAME?> - <?=date('Y')?></div>
            </div>

        </div>
    </div>
</body>

    <script>
        $(function(){
            let response_type       = '<?=$this->session->flashdata('response_type')?>';
            let response_message    = '<?=$this->session->flashdata('response_message')?>';
            let response_title      = '<?=$this->session->flashdata('response_title')?>';

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
