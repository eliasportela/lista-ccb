	$(document).ready(function(){
		//Igreja inicializando bloqueada
		$('#igreja_sel').prop('disabled',true);
		$('#igreja_sel').selectpicker('refresh');
		//encarregado 
		var servico = $('#servico').val()
		if(servico != 5){
			$('#encarregado_sel').prop('disabled',true);
			$('#encarregado_sel').selectpicker('refresh');
		}
		
	});

	function atualizar_cidade(){
	  var regiao = $('#cidade_id_regiao').val();
	  if(regiao){
        var url = 'http://localhost/codeIgniter/listaccb/adm/lc/buscar-cidade?id='+regiao;
        $.get(url, function(dataReturn) {
          $('#load_cidade').html(dataReturn);
          $('#cidade_sel').selectpicker('refresh');
          //alert(dataReturn);
        });
      }
    };

	function buscar_igreja(){
      var cidade = $('#cidade_sel').val();
      if(cidade){
        var url = 'http://localhost/codeIgniter/listaccb/adm/lc/buscar-igreja?id='+cidade;
        $.get(url, function(dataReturn) {
          $('#load_igreja').html(dataReturn);
          $('#igreja_sel').prop('disabled',false);
          $('#igreja_sel').selectpicker('refresh');
        });
      }
    }

    $("#inserir_cidade").click(function()
    {
		var dadosajax = {
			'nome_cidade' : $("#cidade_nome_cidade").val(),
			'id_regiao' : $("#cidade_id_regiao").val()
		};
		pageurl = 'http://localhost/codeIgniter/listaccb/adm/lc/inserir-cidade';
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
				alert('Erro em sua conexao com a internet ou essa cidade ja se encontra cadastrada!!');
			},
			success: function(result)
			{
				//se foi inserido com sucesso
				if ($.trim(result) == '1') {
					atualizar_cidade();
				}else{
					alert("Erro em sua conexao com a internet");
				}
			}
		});
	});

	// Funcao para desbloquear o cadastro do encarregado
	function mudaServico(){
		var servico = $('#servico').val();
		if (servico != 5) {
			$('#encarregado_sel').prop('disabled',true);
			$('#encarregado_sel').selectpicker('refresh');
		}else{
			$('#encarregado_sel').prop('disabled',false);
			$('#encarregado_sel').selectpicker('refresh');
		}
	}