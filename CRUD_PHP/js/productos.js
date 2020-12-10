
var url = "./../controlador/producto.controlador.php";

$(document).ready(function() {
    Consultar();
})

function Consultar() {
    $.ajax({
        data: { "accion": "CONSULTAR" },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done(function(response) {
        var html = "";
        $.each(response, function(index, data) {
            html += "<tr>";
            html += "<td>" + data.descripcion + "</td>";
            html += "<td>" + data.idProveedor + "</td>";
            html += "<td>" + data.idCategoria + "</td>";
            html += "<td>" + data.precio + "</td>";
            html += "<td>" + data.stock + "</td>";
            html += "<td>" + data.fecha_ingreso + "</td>";
            html += "<td>";
            html += "<button class='btn btn-warning mr-1' onclick='ConsultarPorId(" + data.idProducto + ");'><span class='fa fa-edit'></span></button>"
            html += "<button class='btn btn-danger' onclick='Eliminar(" + data.idProducto + ");'><span class='fa fa-trash'></span></button>"
            html += "</td>";
            html += "</tr>";
        });

        document.getElementById("productos").innerHTML = html;
        $('#tablaProductos').DataTable();
    }).fail(function(response) {
        console.log(response);
    });
}

function ConsultarPorId(idProducto) {
    $.ajax({
        url: url,
        data: { "idProducto": idProducto, "accion": "CONSULTAR_ID" },
        type: 'POST',
        dataType: 'json'
    }).done(function(response) {
        document.getElementById('descripcion').value = response.descripcion;
        document.getElementById('id_proveedor').value = response.idProveedor;
        document.getElementById('id_categoria').value = response.idCategoria;
        document.getElementById('precio').value = response.precio;
        document.getElementById('stock').value = response.stock;
        document.getElementById('fecha_ingreso').value = response.fecha_ingreso;
        document.getElementById('idProducto').value = response.idProducto;
        BloquearBotones(false);
    }).fail(function(response) {
        console.log(response);
    });
}

function Guardar() {
    $.ajax({
        url: url,
        data: retornarDatos("GUARDAR"),
        type: 'POST',
        dataType: 'json'
    }).done(function(response) {
        if (response == "OK") {
            MostrarAlerta("Éxito!", "Datos guardados con éxito", "success");
        } else {
            MostrarAlerta("Error!", response, "error");
        }
        Limpiar();
        Consultar();
    }).fail(function(response) {
        console.log(response);
    });
}

function Modificar() {
    
    $.ajax({
        url: url,
        data: retornarDatos("MODIFICAR"),
        type: 'POST',
        dataType: 'json'
    }).done(function(response) {
        if (response == "OK") {
            MostrarAlerta("Éxito!", "Datos actualizados con éxito", "success");
        } else {
            MostrarAlerta("Error!", response, "error");
        }
        Limpiar();
        Consultar();
    }).fail(function(response) {
        console.log(response);
    });
}

function Eliminar(idProducto) {

    $.ajax({
        url: url,
        data: { "idProducto": idProducto, "accion": "ELIMINAR" },
        type: 'POST',
        dataType: 'json'
    }).done(function(response) {
        if (response == "OK") {
            MostrarAlerta("Éxito!", "Datos eliminados con éxito", "success");
        } else {
            MostrarAlerta("Error!", response, "error");
        }
        Consultar();
    }).fail(function(response) {
        console.log(response);
    });
}

function Validar() {
    nombres = document.getElementById('nombres').value;
    apellidos = document.getElementById('apellidos').value;
    direccion = document.getElementById('direccion').value;
    fechaNacimiento = document.getElementById('fechanacimiento').value;
    telefono = document.getElementById('telefono').value;

    if (nombres == "" || apellidos == "" || direccion == "" ||
        fechaNacimiento == "" || telefono == "") {
        return false;
    }
    return true;
}

function retornarDatos(accion) {
    return {
        "descripcion": document.getElementById('descripcion').value,
        "id_proveedor": document.getElementById('id_proveedor').value,
        "id_categoria": document.getElementById('id_categoria').value,
        "precio": document.getElementById('precio').value,
        "stock": document.getElementById('stock').value,
        "fecha_ingreso": document.getElementById('fecha_ingreso').value,
        "accion": accion,
        "idProducto": document.getElementById("idProducto").value
    };
}

function Limpiar() {
    document.getElementById('descripcion').value = "";
    document.getElementById('id_proveedor').value = "";
    document.getElementById('id_categoria').value = "";
    document.getElementById('precio').value = "";
    document.getElementById('stock').value = "";
    document.getElementById('fecha_ingreso').value = "";
    BloquearBotones(true);
}

function BloquearBotones(guardar) {
    if (guardar) {
        document.getElementById('guardar').disabled = false;
        document.getElementById('modificar').disabled = true;
    } else {
        document.getElementById('guardar').disabled = true;
        document.getElementById('modificar').disabled = false;
    }
}

function MostrarAlerta(titulo, descripcion, tipoAlerta) {
    Swal.fire(
        titulo,
        descripcion,
        tipoAlerta
    );
}