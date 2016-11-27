function tipoServicoInserir(){
		var ts = $('#servico').val();
		if (ts==1) {
			$('#encarregado').attr('disabled','disabled');
		}
		if (ts==2) {
			$('#encarregado').attr('disabled','disabled');
		}
		if (ts==3) {
			$('#encarregado').attr('disabled','disabled');
		}
		if (ts==4) {
			$('#encarregado').attr('disabled','disabled');
		}
		if (ts==5) {
			$('#encarregado').removeAttr('disabled');
		}
		if (ts==6) {
			$('#encarregado').attr('disabled','disabled');
		}
	}

function tipoServicoEditar(){
		var ts = $('#servico_editar').val();
		if (ts==1) {
			$('#encarregado_editar').attr('disabled','disabled');
		}
		if (ts==2) {
			$('#encarregado_editar').attr('disabled','disabled');
		}
		if (ts==3) {
			$('#encarregado_editar').attr('disabled','disabled');
		}
		if (ts==4) {
			$('#encarregado_editar').attr('disabled','disabled');
		}
		if (ts==5) {
			$('#encarregado_editar').removeAttr('disabled');
		}
		if (ts==6) {
			$('#encarregado_editar').attr('disabled','disabled');
		}
	}