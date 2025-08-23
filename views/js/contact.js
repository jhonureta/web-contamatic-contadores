
// Utilidad para mostrar/ocultar
const setVisibleBtn = (el, visible) => {
    el.style.display = visible ? "" : "none";
};

// Cache de elementos
const cbContador = document.getElementById("cboxContador");
const cbSistema = document.getElementById("cboxSistema");
const abrirModalCuestionario = document.getElementById("abrirModalCuestionario");
const btnReg = document.getElementById("btnRegistroEmpresarioSis");
const btnPres = document.getElementById("btnPresentacion");

// Lógica central en un solo lugar
const updateVisilityBtnUI = () => {
    if (cbContador.checked) {
        setVisibleBtn(abrirModalCuestionario, true);
        setVisibleBtn(btnReg, false);
        setVisibleBtn(btnPres, false);
        return;
    }
    if (cbSistema.checked) {
        setVisibleBtn(abrirModalCuestionario, false);
        setVisibleBtn(btnReg, true);
        setVisibleBtn(btnPres, false);
        return;
    }
    // Ninguno marcado
    setVisibleBtn(abrirModalCuestionario, false);
    setVisibleBtn(btnReg, false);
    setVisibleBtn(btnPres, true);
};

// Un solo handler para ambos
cbContador.addEventListener("change", updateVisilityBtnUI);
cbSistema.addEventListener("change", updateVisilityBtnUI);


function validarDatosEmpresarioSistema() {
    const nombreapellido = document.getElementById("nombreapellidoEmpresarioSis").value.trim() ?? "";
    const ciudad = document.getElementById("ciudadEmpresarioSis").value.trim() ?? "";
    const telefono = document.getElementById("telefonoEmpresarioSis").value.trim() ?? "";
    const cargo = document.getElementById("cargoEmpresarioSis").value.trim() ?? "";
    const cbContador = document.getElementById('cboxContador');
    const cbSistema = document.getElementById('cboxSistema');

    if (nombreapellido === "" || telefono === "" || ciudad === "" || cargo === "") {
        showFlashMessage("info", "Por favor complete todos los campos.", 1)
        return false;
    }

    const telefonoRegex = /^\d{10,13}$/;
    if (!telefonoRegex.test(telefono)) {
        showFlashMessage("info", "Por favor ingrese un número de teléfono válido.", 1)
        return false;
    }
    if (!cbContador.checked && !cbSistema.checked) {
        showFlashMessage("info", "Por favor debe seleccionar almenos una opcion de solicitud.", 1)
        return false;
    }

    return true;
}


abrirModalCuestionario.addEventListener("click", async () => {
    if (!validarDatosEmpresarioSistema()) return;
    $("#modalEmpresario").hide();
    $("#modalCuestionario").show();
});


function showFlashMessage(type, message, id) {
    const flashContainer = document.getElementById(`flash-container-${id}`);
    const flashMessage = document.createElement('div');
    flashMessage.className = `flash-message ${type}`;
    flashMessage.textContent = message;

    flashContainer.appendChild(flashMessage);

    setTimeout(() => {
        flashMessage.style.animation = 'fadeOut 0.5s ease forwards';
    }, 3000);

    setTimeout(() => {
        flashMessage.remove();
    }, 3500);
}
