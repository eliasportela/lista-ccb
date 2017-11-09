function Servico(){
	var ts = $('#servico').val();
		if (ts==5) {
      console.log('1');
      $('#encarregado').prop({
        disabled: false
      });
    }else{
      console.log('2');
      $('#encarregado').prop({
        disabled: true
      });
   }
}