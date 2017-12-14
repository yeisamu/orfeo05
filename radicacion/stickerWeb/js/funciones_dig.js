/**Función que permite enviar formualrios por jquery**/
function enviar_formulario(id_form)
{
//console.error('-->prueba'); 
   if ($('#observa').val() != '' && $('#upload').val() != '') {
        $(id_form).submit();    
    } else {
	alert('Debe escribir un asunto y seleccionar un archivo');
    }
}

/*
 * Función que permite validar si se ha seleccionado
 * algún radicado de la lista
 *
*/

function checkSelectedRecord(id_form) {

//console.error('-->prueba1'); 
	if($('input:radio[name="valRadio"]').is(':checked')) {
		enviar_formulario(id_form);
	} else {
		alert('Debe seleccionar un radicado');
	}
}

function addFormAttribute(id_form) {
	var form = $(id_form);
	var attribute=$('input[name=valRadio]:checked', id_form).val();
	var selection = $('#asociar').val();
//console.error('-->prueba2');
	if (selection == 'si') {
		form.attr("action", "form_dig_asoc.php?action=asociar&radicado="+attribute);
		console.log(selection);
	} 
	if (selection == 'no') {
		form.attr("action", "form_dig_asoc.php?action=anexar&radicado="+attribute);
		console.log(selection);
	} 
	if (selection == 'print') {
		$('#print').attr("href", "generar_plantilla_sticker.php?radicado="+attribute);
		console.log(selection);
	} 
	if (selection == 'reemplazar') {
		form.attr("action", "form_dig_asoc.php?action=reemplazar&radicado="+attribute);
		console.log(selection);
	}
}

/*
 * Función de autocompletado para datos de radicación
*/


/*TO-DO documentar esta función*/
function detectClick(record) {
    var sticker = $(id_sticker);
console.error('-->prueba3');
    sticker.click(function() {
	$.ajax({
                url:"./record_data.php?radicado="+record,
                type:"POST",
                dataType:"json"
            }).done(function(data){
		console.log('hizo click en sticker '+index);
        	sticker.barcode(record,"code39",{barWidth:1, barHeight:15, fontSize:0});
		sticker.append("<div class='div_img'><img src='../logoEntidad.gif' width='70px' height='30px'></div>");
		sticker.append('<div align="left">Radicado No. '+data[0]+'<br/></div>');
		sticker.append('<div align="left">Asunto: '+data[1].substr(0,42)+'<br/></div>');
		sticker.append('<div align="left">Us. Rad: '+data[2].substr(0,15)+' Dep: '+data[3].substr(0,20)+'<br/></div>');
		sticker.append('<div align="left">Fecha: '+data[4]+'<br/></div>');
		sticker.append('<div align="left">Destino: '+data[5].substr(0,42)+'<br/></div>');
		sticker.append('<div align="left">Remitente: '+data[6].substr(0,42)+'</div>');
           });
    });
}

