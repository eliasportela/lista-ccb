	$(document).ready(function(){
		//Igreja inicializando bloqueada
		buscar_igreja();
		//encarregado 
		var servico = $('#servico').val()
		if(servico != 5){
			$('#encarregado_sel').prop('disabled',true);
			$('#encarregado_sel').selectpicker('refresh');
		}

		//Inserir a lista
		jQuery('#inserirFile').submit(function(){
			
			var dados = new FormData(this);
			pageurl = base_urla + 'adm/lc/inserir-arquivo';
		
			$.ajax({
			    url: pageurl,
			    type: 'POST',
			    data:  dados,
			    mimeType:"multipart/form-data",
			    contentType: false,
			    cache: false,
			    processData:false,
			    success: function(data, textStatus, jqXHR)
			        {
			             // Em caso de sucesso faz isto...
			             alert("Arquivo da lista inserido com sucesso!")
			        },
			    error: function(jqXHR, textStatus, errorThrown) 
			        {
			        	console.log(jqXHR);
			        }          
			    });

				
			return false;
		});
		
	});

	function atualizar_cidade(city){
	  var regiao = $('#cidade_id_regiao').val();
	  var cidade = city;
	  console.log(cidade);
	  if(regiao){
        var url = base_urla + 'adm/lc/buscar-cidade?id='+regiao+'&ci='+cidade;
        $.get(url, function(dataReturn) {
          $('#load_cidade').html(dataReturn);
          $('#cidade_sel').selectpicker('refresh');
          buscar_igreja();
          //alert(dataReturn);
        });
      }
    };

    function atualizar_anciao(anciao){
    	var id_presbitero = anciao;
	    var url = base_urla + 'adm/lc/buscar-anciao?id='+id_presbitero;
        $.get(url, function(dataReturn) {
          $('#load_anciao').html(dataReturn);
          $('#anciao_sel').selectpicker('refresh');
        });
    };

     function atualizar_encarregado(encarregado){
     	var id_presbitero = encarregado;
	    var url = base_urla + 'adm/lc/buscar-encarregado?id='+id_presbitero;
        $.get(url, function(dataReturn) {
          $('#load_encarregado').html(dataReturn);
          $('#encarregado_sel').selectpicker('refresh');
        });
    };

	function buscar_igreja(id_igreja){
      var cidade = $('#cidade_sel').val();
      var igreja = id_igreja;
      if(cidade){
        var url = base_urla + 'adm/lc/buscar-igreja?id='+cidade;
        $.get(url, function(dataReturn) {
          $('#load_igreja').html(dataReturn);
          console.log('Cidade Atualizada');
          $('#igreja_sel').prop('disabled',false);
          $('#igreja_sel').selectpicker('refresh');
        });
      }
    }

    //Inserir cidade
    $("#inserir_cidade").click(function()
    {
		var dadosajax = {
			'nome_cidade' : $("#cidade_nome_cidade").val(),
			'id_regiao' : $("#cidade_id_regiao").val()
		};
		pageurl = base_urla + 'adm/lc/inserir-cidade';
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
				console.log(result);
				if ($.trim(result) != '0') {
					atualizar_cidade(result);
				}else{
					alert("Erro em sua conexao com a internet");
				}
			}
		});
	});

	 //Inserir Igreja
    $("#inserir_igreja").click(function()
    {
    	var dadosajax = {
			'ds_igreja' : $("#igreja_ds_igreja").val(),
			'id_cidade' : $("#cidade_sel").val()
		};
		console.log(dadosajax);
		pageurl = base_urla + 'adm/lc/inserir-igreja';
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
				alert('Erro em sua conexao com a internet');
			},
			success: function(result)
			{
				//se foi inserido com sucesso
				if ($.trim(result) != '0') {
					buscar_igreja(result);
				}else{
					alert("Essa Igreja ja se encontra cadastrada!!");
				}
			}
		});
	});

		 //Inserir Presbitero
    
	$("#inserir_presbitero").click(function(){
		var funcao = $("#presbitero_id_funcao").val();
		if (funcao == 1){
			inserir_anciao();
			$('#Modal_presbitero').modal('hide');
		}if (funcao == 2){
			inserir_encarregado();
			$('#Modal_presbitero').modal('hide');
		}if(funcao == 0) {
			alert("Selecione se é Encarregado ou Ancião!!");
		}
	});

    function inserir_anciao()
    {
    	
		var dadosajax = {
			'id_funcao' : $("#presbitero_id_funcao").val(),
			'nome_presbitero' : $("#presbitero_nome").val()
		};

		pageurl = base_urla + 'adm/lc/inserir-presbitero';
		
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
				alert('Erro em sua conexao com a internet');
			},
			success: function(result)
			{
				//se foi inserido com sucesso
				console.log(result);
				if ($.trim(result) != '0') {
					atualizar_anciao(result);
				}else{
					alert("Duplicidade no cadastro de Ancião. Verifique se já não existe este nome cadastrado!");
				}
			}
		});
	};

	function inserir_encarregado()
    {
    	var funcao = $("#presbitero_id_funcao").val();
		var dadosajax = {
			'id_funcao' : $("#presbitero_id_funcao").val(),
			'nome_presbitero' : $("#presbitero_nome").val()
		};

		pageurl = base_urla + 'adm/lc/inserir-presbitero';
		
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
				alert('Erro em sua conexao com a internet');
			},
			success: function(result)
			{
				//se foi inserido com sucesso
				console.log(result);
				if ($.trim(result) != '0') {
					atualizar_encarregado(result)
				}else{
					alert("Duplicidade no cadastro de Encarregado. Verifique se já não existe este nome cadastrado!");
				}
			}
		});
	};

	//Inserir cidade
    $("#inserir_aqruquivo").click(function()
    {
		var dadosajax = {
			'id_regiao' : $("#cidade_id_regiao").val()
		};
		pageurl = base_urla + 'adm/lc/inserir-arquivo';
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
				console.log(result);
				if ($.trim(result) != '0') {
					atualizar_cidade(result);
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

	function opcaoCulto(val){
		$('#editarLc').prop('value',val);
		$('#removerLc').prop('value',val);
		$('#opcoesModal').modal('show');
	}

	$("#editarLc").click(function(){
		var valor = $('#editarLc').val();
		window.location.href = 'lista-editar-servicos?id=' + valor;
	});

	$("#removerLc").click(function(){
		var valor = $('#removerLc').val();
		var res = confirm("Deseja Realmente excluir este culto?");
		if (res == true){
			window.location.href = 'lista-remover-servicos?id=' + valor;
		}
	});


	function opcaoLista(val){
		$('#editarLista').prop('value',val);
		$('#removerLista').prop('value',val);
		$('#acessarLista').prop('value',val);
		$('#opcoesModal').modal('show');
	}

	$("#acessarLista").click(function(){
		var valor = $('#acessarLista').val();
		window.location.href = 'lista-inserir?id=' + valor;
	});

	$("#editarLista").click(function(){
		var valor = $('#editarLista').val();
		window.location.href = 'editar-lista?id=' + valor;
	});

	$("#removerLista").click(function(){
		var valor = $('#removerLista').val();
		var res = confirm("Deseja Realmente excluir esta lista?");
		if (res == true){
			window.location.href = 'remover-lista?id=' + valor;
		}
	});
