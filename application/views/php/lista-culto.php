<script>
	function buscar_igreja(){
      var cidade = $('#cidade').val();
      if(cidade){
        var url = '<?=base_url('teste?id')?>='+cidade;
        $.get(url, function(dataReturn) {
          $('#load_igreja').html(dataReturn);
        });
      }
    }

    $("#inserir_cidade").click(function()
    {
		var dadosajax = {
			'nome_cidade' : $("#cidade_nome_cidade").val(),
			'id_regiao' : $("#cidade_id_regiao").val()
		};
		pageurl = '<?=base_url('adm/lc/cidade')?>';
		$.ajax({
			//url da pagina
			url: pageurl,
			//parametros
			data: dadosajax,
			//TIpo
			type: 'POST',
			//cache
			cache: false,
			error: function(){
				alert('Erro: Inserir Registro!!');
			},
			success: function(result)
			{
				//se foi inserido com sucesso
				if ($.trim(result) == '1') {
					alert("A cidade foi inserida com sucesso");
				}else{
					alert("Ecorreu um Erro");
				}
			}
		});
	});
</script>