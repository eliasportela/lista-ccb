function buscar_igreja(){
      var cidade = $('#cidade').val();
      if(cidade){
        var url = '../buscar_igreja.php?cidade='+cidade;
        $.get(url, function(dataReturn) {
          $('#load_igreja').html(dataReturn);
        });
      }
    }