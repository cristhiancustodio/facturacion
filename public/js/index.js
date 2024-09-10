$("#formulario").on("submit", function (event) {
    event.preventDefault();
    let data = new FormData(this);

    let codigo = data.get("codigo");
    let nombre = data.get("nombre");
    let precio = parseFloat(data.get("precio") || 0);
    let id_bodega = data.get("id_bodega");
    let id_sucursal = data.get("id_sucursal");
    let id_moneda = data.get("id_moneda");
    let descripcion = data.get("descripcion");

    let regex_codigo = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/;

    if (codigo == '') {
        alert("El código del producto no puede estar en blanco.");
        return false;
    } else if (!(codigo.length >= 5 && codigo.length <= 15)) {
        alert("El código del producto debe tener entre 5 y 15 caracteres.");
        return false;
    } else if (!(regex_codigo.test(codigo))) {
        alert("El código del producto debe contener letras y números");
        return false;
    }


    if (nombre == '') {
        alert("El nombre del producto no puede estar en blanco.");
        return false;
    }
    else if (!(nombre.length >= 2 && nombre.length <= 50)) {
        alert("El nombre del producto debe tener entre 2 y 50 caracteres.");
        return false;
    }


    if (id_bodega == '') {
        alert("Debe seleccionar una bodega.");
        return false;
    }
    if (id_sucursal == '') {
        alert("Debe seleccionar una sucursal para la bodega seleccionada.");
        return false;
    }
    if (id_moneda == '') {
        alert("Debe seleccionar una moneda para el producto.");
        return false;
    }

    let regex_precio = /^\d+(\.\d{1,2})?$/;

    if (precio < 0) {
        alert("El precio debe de ser positivo");
        return false;
    } else if (precio == '') {
        alert("El precio del producto no puede estar en blanco.");
        return false;
    } else if (!regex_precio.test(precio)) {
        alert("El precio del producto debe ser un número positivo con hasta dos decimales.");
        return false;
    }

    if ($(".material_producto:checked").length < 2) {
        alert("Debe seleccionar al menos dos materiales para el producto.");
        return false;
    }


    if (descripcion == '') {
        alert("La descripción del producto no puede estar en blanco.");
        return false;
    } else if (!(descripcion.length >= 10 && descripcion.length <= 1000)) {
        alert("La descripción del producto debe tener entre 10 y 1000 caracteres");
        return false;
    }


    $.ajax({
        type: "POST",
        url: "src/controller/RegistrarFormulario.php",
        data: data,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (response) {
            let data = response;
            if (data.estado === 'exito') {
                alert(data.mensaje || '');
                /**Una vez registrado limpio el formulario para otro registro */

                window.location.reload();
                $('#formulario')[0].reset();

                /**Tambien se limpia la sucursal */
                let select_sucursal = $("#id_sucursal");
                select_sucursal.empty();
                select_sucursal.append("<option value=''>Seleccione</option>");
                
            } else {
                alert(data.mensaje || '');
            }
        },
        error: function (response, estado, error) {

            console.error('Error en la solicitud:', estado, error);
        }
    });
});


/**
 * La validacion se hizo cuando el usuario salga del input con onblur
 * recien ahi es donde buscara si el codigo no existe
 */
const verificaCodigoRegistrado = (event) => {
    let data = {
        "codigo": event.value,
    }
    $.ajax({
        type: "GET",
        url: "src/controller/Validaciones.php",
        data: data,
        dataType: "json",
        success: function (response) {
            if ((response.estado || 0) == 1) {
                alert("El código del producto ya está registrado.");
                $("#codigo").val('');
            }
        },
        error: function (estado, error) {
            console.error('Error en la solicitud:', estado, error);
        }
    });

}
/**
 * Para el cambio de Bodega
 */
const obtenerSucural = (event) => {
    const data = {
        'id_bodega': event.value,
    }
    $.ajax({
        type: "POST",
        url: "src/controller/Sucursal.php",
        data: data,
        dataType: "JSON",
        success: function (response) {
            let respuesta = response;
            let select_sucursal = $("#id_sucursal");
            select_sucursal.empty();
            select_sucursal.append("<option value=''>Seleccione</option>");

            respuesta.resultado.forEach(function (sucursal) {
                select_sucursal.append(`<option value="${sucursal.id_sucursal}">${sucursal.descripcion}</option>`);
            });
        },
        error: function (estado, error) {
            console.error('Error en la solicitud de sucursal', estado, error);
        }
    });

}