$(function(){
    $("#seleccionar_todos").on('change',function(){
        $('table tbody :checkbox').attr("checked",$("#seleccionar_todos").is(':checked'));
    })

    $(".eliminar_seleccionados").on('click',function(event){
        event.preventDefault()
        $(".form_lista").submit();
    })
    
    var counter = 2;
 
    $("#addButton").click(function () {
        
        document.getElementById('contador').innerHTML='<div><input id="numerocampos" name="numerocampos" type="hidden" value="'+counter+'" /></div>';
 
        if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
        }   
        
        $('<div id="TextBoxDiv'+counter+'">'+
            '<label for="nombre">Campo'+counter+'</label>'+
            '<input id="campo'+counter+'" type="text" name="campo'+counter+'">'+
            '<label for="tipo">Tipo'+counter+'</label>'+
            '<select id="tipocampo'+counter+'" name="tipocampo'+counter+'">'+
            '<option value="1">int</option>'+
            '<option value="2">text</option>'+
            '</select>'+
            '<p>__________________________________________________________________</p>'+
            '</div>').appendTo('#TextBoxesGroup'); 
 
        counter++;
        
    })
 
    $("#removeButton").click(function () {
        if(counter==1){
            alert("No hay mas campos para eliminar");
            return false;
        }   
 
        counter--;
 
        $("#TextBoxDiv" + counter).remove();
 
    })
 
    $("#getButtonValue").click(function () {
        if(counter >1){
            var msg = '';
            for(i=1; i<counter; i++){
                msg += "\n Campo #" + i + " : " + $('#campo' + i).val() + "  Tipo Campo: " + $('#tipocampo' + i).val();
            }
            alert(msg);
        }
        else{
            alert('No hay campos para mostrar');
        }
    })
     
});