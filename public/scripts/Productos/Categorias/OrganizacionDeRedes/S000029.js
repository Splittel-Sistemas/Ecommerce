var Empresa = "OP";
var Familia = "GA";
var Instalacion = "PI";
var Prefijo = "SH";
var Clave = document.getElementById('Clave');

let CEspecial = document.getElementById('CEspecial');
let UnidadesG = document.getElementById('UnidadesG');
let PuertaFrontalG = document.getElementById('PuertaFrontalG');
let PuertaTraceraG = document.getElementById('PuertaTraceraG');
let LPuertaFrontalG = document.getElementById('LPuertaFrontalG');
let LPuertaTraceraG = document.getElementById('LPuertaTraceraG');
let AnchoG = document.getElementById('AnchoG');
let ProfundidadG = document.getElementById('ProfundidadG');

let Procesando = false;

function GabinetesPiso() {
    if (Procesando) {
        return;
    }

    Procesando = true;

    if (CEspecial.value == 0) {
        DeshabilitarPropiedadesMG();
        if (AnchoG.value == 800 && (ProfundidadG.value == 1000 || ProfundidadG.value == 1200)) {
            if (ProfundidadG.value == 1000) {
                removerPuertaFrontalV();
                if (PuertaTraceraG.value == 'V') {
                    CodigoGenerado = Empresa + Familia + Instalacion + '8042P' + Prefijo;
                } else {
                    CodigoGenerado = Empresa + Familia + Instalacion + '8042P' + (PuertaFrontalG.value + PuertaTraceraG.value) + Prefijo;
                }
                DirectorioImgProducto = CodigoGenerado;
            } else {
                RemoverPuertas();
                CodigoGenerado = Empresa + Familia + Instalacion + 'DC042P' + Prefijo;
                DirectorioImgProducto = CodigoGenerado;
            }
        } else {
            let combinacionPuertas = '';
            if (PuertaFrontalG.value == 'C' && PuertaTraceraG.value == 'V') {
                combinacionPuertas = 'C';
            } else if (PuertaFrontalG.value == 'C' && PuertaTraceraG.value == 'PD') {
                combinacionPuertas = 'CPD';
            } else if (PuertaFrontalG.value == 'V' && PuertaTraceraG.value == 'V') {
                combinacionPuertas = 'V';
            } else if (PuertaFrontalG.value == 'V' && PuertaTraceraG.value == 'PD') {
                combinacionPuertas = 'VPD';
            }
            CodigoGenerado = Empresa + Familia + Instalacion + UnidadesG.value + (ProfundidadG.value == 600 ? 'O' : 'P') + combinacionPuertas + Prefijo;
            DirectorioImgProducto = CodigoGenerado;
        }
    } else {
        PropiedadesMG();
    }
    ListImgProducto(DirectorioImgProducto);
    ListProductoDescription(DirectorioImgProducto);
    ListProductoAdicional(DirectorioImgProducto);
    showClave(CodigoGenerado);
    existEcommerce_(CodigoGenerado, true);
    CargarProductosRelacionados(CodigoGenerado);
    Procesando = false;
}

function DeshabilitarPropiedadesMG() {
    MostrarPuertas();

    agregarPuertaFrontalV();

    AnchoG.disabled = false;
    ProfundidadG.disabled = false;

    removerProfundidad800();
    if (UnidadesG.value == '022') {
        removerAncho800();
        removerProfundidad1200();
        agregarAncho600();
        agregarProfundidad600();
        agregarProfundidad1000();
    } else {
        agregarAncho600();
        agregarAncho800();

        if (AnchoG.value == 600) {
            agregarProfundidad600();
            agregarProfundidad1000();
            removerProfundidad1200();
        } else {
            removerProfundidad600();
            agregarProfundidad1000();
            agregarProfundidad1200();
        }
    }
}

function PropiedadesMG() {
    CodigoGenerado = Empresa + Familia + Instalacion + 'MG' + UnidadesG.value + 'O' + Prefijo;
    DirectorioImgProducto = CodigoGenerado;

    RemoverPuertas();

    removerAncho800();
    removerProfundidad600();
    removerProfundidad1000();
    removerProfundidad1200();

    agregarAncho600();
    agregarProfundidad800();

    AnchoG.value = 600;
    AnchoG.dispatchEvent(new Event('change'));
    ProfundidadG.value = 800;
    ProfundidadG.dispatchEvent(new Event('change'));

    AnchoG.disabled = true;
    ProfundidadG.disabled = true;
}

function removerProfundidad600() {
    for (let i = 0; i < ProfundidadG.options.length; i++) {
        if (ProfundidadG.options[i].value == 600) {
            ProfundidadG.remove(i);
            break;
        }
    }
}

function agregarProfundidad600() {
    let existe = false;
    for (let i = 0; i < ProfundidadG.options.length; i++) {
        if (ProfundidadG.options[i].value == 600) {
            existe = true;
            break;
        }
    }

    if (!existe) {
        const nuevaOption = document.createElement("option");
        nuevaOption.text = '600';
        nuevaOption.value = 600;
        ProfundidadG.appendChild(nuevaOption);
    }
}

function removerProfundidad800() {
    for (let i = 0; i < ProfundidadG.options.length; i++) {
        if (ProfundidadG.options[i].value == 800) {
            ProfundidadG.remove(i);
            break;
        }
    }
}

function agregarProfundidad800() {
    let existe = false;
    for (let i = 0; i < ProfundidadG.options.length; i++) {
        if (ProfundidadG.options[i].value == 800) {
            existe = true;
            break;
        }
    }

    if (!existe) {
        const nuevaOption = document.createElement("option");
        nuevaOption.text = '800';
        nuevaOption.value = 800;
        ProfundidadG.appendChild(nuevaOption);
    }
}

function removerProfundidad1000() {
    for (let i = 0; i < ProfundidadG.options.length; i++) {
        if (ProfundidadG.options[i].value == 1000) {
            ProfundidadG.remove(i);
            break;
        }
    }
}

function agregarProfundidad1000() {
    let existe = false;
    for (let i = 0; i < ProfundidadG.options.length; i++) {
        if (ProfundidadG.options[i].value == 1000) {
            existe = true;
            break;
        }
    }

    if (!existe) {
        const nuevaOption = document.createElement("option");
        nuevaOption.text = '1000';
        nuevaOption.value = 1000;
        ProfundidadG.appendChild(nuevaOption);
    }
}

function removerProfundidad1200() {
    for (let i = 0; i < ProfundidadG.options.length; i++) {
        if (ProfundidadG.options[i].value == 1200) {
            ProfundidadG.remove(i);
            break;
        }
    }
}

function agregarProfundidad1200() {
    let existe = false;
    for (let i = 0; i < ProfundidadG.options.length; i++) {
        if (ProfundidadG.options[i].value == 1200) {
            existe = true;
            break;
        }
    }

    if (!existe) {
        const nuevaOption = document.createElement("option");
        nuevaOption.text = '1200';
        nuevaOption.value = 1200;
        ProfundidadG.appendChild(nuevaOption);
    }
}

function removerAncho600() {
    for (let i = 0; i < AnchoG.options.length; i++) {
        if (AnchoG.options[i].value == 600) {
            AnchoG.remove(i);
            break;
        }
    }
}

function agregarAncho600() {
    let existe = false;
    for (let i = 0; i < AnchoG.options.length; i++) {
        if (AnchoG.options[i].value == 600) {
            existe = true;
            break;
        }
    }

    if (!existe) {
        const nuevaOption = document.createElement("option");
        nuevaOption.text = '600';
        nuevaOption.value = 600;
        AnchoG.appendChild(nuevaOption);
    }
}

function removerAncho800() {
    for (let i = 0; i < AnchoG.options.length; i++) {
        if (AnchoG.options[i].value == 800) {
            AnchoG.remove(i);
            break;
        }
    }
}

function agregarAncho800() {
    let existe = false;
    for (let i = 0; i < AnchoG.options.length; i++) {
        if (AnchoG.options[i].value == 800) {
            existe = true;
            break;
        }
    }

    if (!existe) {
        const nuevaOption = document.createElement("option");
        nuevaOption.text = '800';
        nuevaOption.value = 800;
        AnchoG.appendChild(nuevaOption);
    }
}

function RemoverPuertas() {
    PuertaFrontalG.style.display = 'none';
    PuertaTraceraG.style.display = 'none';
    LPuertaFrontalG.style.display = 'none';
    LPuertaTraceraG.style.display = 'none';
}

function MostrarPuertas() {
    PuertaFrontalG.style.display = 'inline';
    PuertaTraceraG.style.display = 'inline';
    LPuertaFrontalG.style.display = 'inline';
    LPuertaTraceraG.style.display = 'inline';
}

function removerPuertaFrontalV() {
    for (let i = 0; i < PuertaFrontalG.options.length; i++) {
        if (PuertaFrontalG.options[i].value == 'V') {
            PuertaFrontalG.remove(i);
            break;
        }
    }
}

function agregarPuertaFrontalV() {
    let existe = false;
    for (let i = 0; i < PuertaFrontalG.options.length; i++) {
        if (PuertaFrontalG.options[i].value == 'V') {
            existe = true;
            break;
        }
    }

    if (!existe) {
        const nuevaOption = document.createElement("option");
        nuevaOption.text = 'Ventilada';
        nuevaOption.value = 'V';
        PuertaFrontalG.appendChild(nuevaOption);
    }
}

async function CargarProductosRelacionados(codigo) {
    const tbody = document.querySelector('#inf3 .table-responsive table tbody');

    if (!tbody) {
        return;
    }

    $.ajax({
        url: '../../models/Productos/Gabinetes/ProductosRelacionados.php',
        type: 'POST',
        dataType: 'html',
        data: {
            codigo: codigo
        },
        success: function (respuesta) {
            $(tbody).html(respuesta);
        },
        error: function (xhr, status, error) {
            $(tbody).html(`
                <tr>
                    <td colspan="6" class="text-center text-danger">
                        Ocurrió un error al cargar los productos.
                    </td>
                </tr>
            `);
        }
    });
}

GabinetesPiso();