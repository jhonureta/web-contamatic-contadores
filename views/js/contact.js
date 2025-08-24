// Utilidad para mostrar/ocultar
const setVisibleBtn = (el, visible) => {
  el.style.display = visible ? "" : "none";
};

// Cache de elementos
const cbContador = document.getElementById("cboxContador");
const cbSistema = document.getElementById("cboxSistema");
const abrirModalCuestionario = document.getElementById(
  "abrirModalCuestionario"
);
const btnReg = document.getElementById("btnRegistroEmpresarioSis");
const btnPres = document.getElementById("btnPresentacion");
const modalEm = document.getElementById("modalEmpresario");
const modalEmpresario = new bootstrap.Modal(modalEm, {
  backdrop: true, // fondo bloquea clicks fuera
  keyboard: true, // Esc cierra
  focus: false, // evitar loop si tu tema rompe el focus trap
});
const modalEl = document.getElementById("modalCuestionario");
const modalCuestionario = new bootstrap.Modal(modalEl, {
  backdrop: true, // fondo bloquea clicks fuera
  keyboard: true, // Esc cierra
  focus: false, // evitar loop si tu tema rompe el focus trap
});

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
  const nombreapellido =
    document.getElementById("nombreapellidoEmpresarioSis").value.trim() ?? "";
  const ciudad =
    document.getElementById("ciudadEmpresarioSis").value.trim() ?? "";
  const telefono =
    document.getElementById("telefonoEmpresarioSis").value.trim() ?? "";
  const cargo =
    document.getElementById("cargoEmpresarioSis").value.trim() ?? "";
  const cbContador = document.getElementById("cboxContador");
  const cbSistema = document.getElementById("cboxSistema");

  if (
    nombreapellido === "" ||
    telefono === "" ||
    ciudad === "" ||
    cargo === ""
  ) {
    showFlashMessage("info", "Por favor complete todos los campos.", 1);
    return false;
  }

  const telefonoRegex = /^\d{10,13}$/;
  if (!telefonoRegex.test(telefono)) {
    showFlashMessage(
      "info",
      "Por favor ingrese un número de teléfono válido.",
      1
    );
    return false;
  }
  if (!cbContador.checked && !cbSistema.checked) {
    showFlashMessage(
      "info",
      "Por favor debe seleccionar almenos una opcion de solicitud.",
      1
    );
    return false;
  }

  return true;
}

abrirModalCuestionario.addEventListener("click", async () => {
  if (!validarDatosEmpresarioSistema()) return;
  // Espera a que el primero termine de cerrarse antes de abrir el segundo
  modalEm.addEventListener(
    "hidden.bs.modal",
    function onHidden() {
      modalEm.removeEventListener("hidden.bs.modal", onHidden);
      modalCuestionario.show();
    },
    { once: true }
  );

  modalEmpresario.hide();
});

modalEl.addEventListener("hidden.bs.modal", () => {
  // Quita cualquier backdrop que haya quedado
  document.querySelectorAll(".modal-backdrop").forEach((b) => b.remove());
});

modalEl.addEventListener("shown.bs.modal", () => {
  $("#tiempoCuestionario").select2({
    dropdownParent: $("#modalCuestionario"),
  });
});

function showFlashMessage(type, message, id) {
  const flashContainer = document.getElementById(`flash-container-${id}`);
  const flashMessage = document.createElement("div");
  flashMessage.className = `flash-message ${type}`;
  flashMessage.textContent = message;

  flashContainer.appendChild(flashMessage);

  setTimeout(() => {
    flashMessage.style.animation = "fadeOut 0.5s ease forwards";
  }, 3000);

  setTimeout(() => {
    flashMessage.remove();
  }, 3500);
}

document
  .getElementById("btnRegistroEmpresarioSis")
  .addEventListener("click", async () => {
    try {
      if (!validarDatosEmpresarioSistema()) return;

      document.getElementById("btnRegistroEmpresarioSis").disabled = true;
      const nombreapellido =
        document.getElementById("nombreapellidoEmpresarioSis").value.trim() ??
        "";
      const ciudad =
        document.getElementById("ciudadEmpresarioSis").value.trim() ?? "";
      const telefono =
        document.getElementById("telefonoEmpresarioSis").value.trim() ?? "";
      //const correo = document.getElementById("correoEmpresarioSis").value.trim() ?? "";
      const cargo =
        document.getElementById("cargoEmpresarioSis").value.trim() ?? "";

      const formData = new FormData();
      formData.append("generarRegistroEmpresarioSis", true);
      formData.append("nombre", nombreapellido);
      formData.append("telefono", telefono);
      formData.append("correo", "");
      formData.append("ciudad", ciudad);
      formData.append("cargo", cargo);
      formData.append("tipo", "SISTEMA");

      const response = await fetch("controller/contacto.ajax.php", {
        method: "POST",
        body: formData,
      });

      if (!response.ok) throw new Error("Error en la solicitud.");
      const data = await response.json();
      if (data.status == "ERROR") {
        showFlashMessage("error", data.message, 1);
        document.getElementById("btnRegistroEmpresarioSis").disabled = false;
        return;
      }
      showFlashMessage("success", "Solicitud enviada correctamente", 1);
      $("#btnRegistroEmpresarioSis").html("SOLICITUD ENVIADA");
      $("#btnRegistroEmpresarioSis").attr(
        "style",
        "background:#0043ff;color:white"
      );
      document.getElementById("btnRegistroEmpresarioSis").disabled = false;
      limpiarCamposEmpresario();
    } catch (error) {
      showFlashMessage("error", error.message, 1);
      console.error(error);
    }
  });

function limpiarCamposEmpresario() {
  document.getElementById("nombreapellidoEmpresarioSis").value = "";
  document.getElementById("ciudadEmpresarioSis").value = "";
  document.getElementById("telefonoEmpresarioSis").value = "";
  document.getElementById("cargoEmpresarioSis").value = "";
}

function limpiarCamposCuestionario() {
  document.getElementById("cantonCuestionario").value = "";
  document.getElementById("actividadCuestionario").value = "";
  document.getElementById("autonomoCuestionario").value = "";
  document.getElementById("comprasCuestionario").value = "";
  document.getElementById("ventasCuestionario").value = "";
  document.getElementById("rucCuestionario").value = "";
  document.getElementById("experienciaCuestionario").value = "";
  document.getElementById("tiempoCuestionario").value = "";
  document.getElementById("comunicacionCuestionario").value = "";
  document.getElementById("requisitosCuestionario").value = "";
}

document
  .getElementById("btnRegistroEmpresario")
  .addEventListener("click", async () => {
    try {
      if (!validarDatosEmpresarioSistema()) return;
      if (!validarCuestionarioContador()) return;

      document.getElementById("btnRegistroEmpresario").disabled = true;

      const nombreapellido =
        document.getElementById("nombreapellidoEmpresarioSis").value.trim() ??
        "";
      const ciudad =
        document.getElementById("ciudadEmpresarioSis").value.trim() ?? "";
      const telefono =
        document.getElementById("telefonoEmpresarioSis").value.trim() ?? "";
      const cargo =
        document.getElementById("cargoEmpresarioSis").value.trim() ?? "";
      const jsonCuest = JSON.stringify(buildJsonCuestionarioContador());
      const cbContador = document.getElementById("cboxContador");
      const cbSistema = document.getElementById("cboxSistema");
      let tipo = "CONTADOR";
      if (cbContador.checked && cbSistema.checked) {
        tipo = "CONTADOR-SISTEMA";
      }

      const formData = new FormData();
      formData.append("generarRegistroEmpresario", true);
      formData.append("nombre", nombreapellido);
      formData.append("telefono", telefono);
      formData.append("correo", "");
      formData.append("ciudad", ciudad);
      formData.append("cargo", cargo);
      formData.append("tipo", tipo);
      formData.append("jsonCuest", jsonCuest);

      const response = await fetch("controller/contacto.ajax.php", {
        method: "POST",
        body: formData,
      });

      if (!response.ok) throw new Error("Error en la solicitud.");
      const data = await response.json();
      if (data.status == "ERROR") {
        showFlashMessage("error", data.message, 2);
        document.getElementById("btnRegistroEmpresario").disabled = false;
        return;
      }
      showFlashMessage("success", "Solicitud enviada correctamente", 2);
      document.getElementById("abrirModalCuestionario").disabled = true;
      $("#abrirModalCuestionario").html("SOLICITUD ENVIADA");
      $("#abrirModalCuestionario").attr(
        "style",
        "background:#0043ff;color:white"
      );
      setTimeout(() => {
        limpiarCamposEmpresario();
        limpiarCamposCuestionario();
        modalCuestionario.hide();
      }, 2000);
    } catch (error) {
      showFlashMessage("error", error.message, 2);
      console.error(error);
    }
  });

function validarCuestionarioContador() {
  const canton =
    document.getElementById("cantonCuestionario").value.trim() ?? "";
  const actividad =
    document.getElementById("actividadCuestionario").value.trim() ?? "";
  const autonomo =
    document.getElementById("autonomoCuestionario").value.trim() ?? "";
  const compras =
    document.getElementById("comprasCuestionario").value.trim() ?? "";
  const ventas =
    document.getElementById("ventasCuestionario").value.trim() ?? "";
  const ruc = document.getElementById("rucCuestionario").value.trim() ?? "";
  const experiencia =
    document.getElementById("experienciaCuestionario").value.trim() ?? "";
  const tiempo =
    document.getElementById("tiempoCuestionario").value.trim() ?? "";
  const comunicacion =
    document.getElementById("comunicacionCuestionario").value.trim() ?? "";
  const requisito =
    document.getElementById("requisitosCuestionario").value.trim() ?? "";

  if (
    canton === "" ||
    actividad === "" ||
    autonomo === "" ||
    compras === "" ||
    ventas === "" ||
    ruc === "" ||
    experiencia === "" ||
    tiempo === "" ||
    comunicacion === "" ||
    requisito === ""
  ) {
    showFlashMessage("info", "Por favor complete todas las preguntas.", 2);
    return false;
  }
  if (isNaN(compras)) {
    showFlashMessage("info", "Las compras deden ser un número.", 2);
    return false;
  }
  if (Number(compras) < 0) {
    showFlashMessage("info", "Las compras no pueden ser números negativos.", 2);
    return false;
  }
  if (isNaN(ventas)) {
    showFlashMessage("info", "Las ventas deden ser un número.", 2);
    return false;
  }
  if (Number(ventas) < 0) {
    showFlashMessage("info", "Las ventas no pueden ser números negativos.", 2);
    return false;
  }

  if (Number(experiencia) < 0) {
    showFlashMessage(
      "info",
      "Los años de experiencia no pueden ser números negativos.",
      2
    );
    return false;
  }
  const rucRegex = /^\d{13}$/;
  if (!rucRegex.test(ruc)) {
    showFlashMessage("info", "Por favor ingrese un número de RUC válido.", 2);
    return false;
  }

  return true;
}

function buildJsonCuestionarioContador() {
  const jsonCuestionario = [];
  jsonCuestionario.push(
    {
      pregunta: document.querySelector('label[for="canton"]').textContent,
      respuesta: document.getElementById("cantonCuestionario").value,
    },
    {
      pregunta: document.querySelector('label[for="actividad"]').textContent,
      respuesta: document.getElementById("actividadCuestionario").value,
    },
    {
      pregunta: document.querySelector('label[for="autonomo"]').textContent,
      respuesta: document.getElementById("autonomoCuestionario").value,
    },
    {
      pregunta: document.querySelector('label[for="compras"]').textContent,
      respuesta: document.getElementById("comprasCuestionario").value,
    },
    {
      pregunta: document.querySelector('label[for="ventas"]').textContent,
      respuesta: document.getElementById("ventasCuestionario").value,
    },
    {
      pregunta: document.querySelector('label[for="ruc"]').textContent,
      respuesta: document.getElementById("rucCuestionario").value,
    },
    {
      pregunta: document.querySelector('label[for="experiencia"]').textContent,
      respuesta: document.getElementById("experienciaCuestionario").value,
    },
    {
      pregunta: document.querySelector('label[for="tiempo"]').textContent,
      respuesta: document.getElementById("tiempoCuestionario").value,
    },
    {
      pregunta: document.querySelector('label[for="comunicacion"]').textContent,
      respuesta: document.getElementById("comunicacionCuestionario").value,
    },
    {
      pregunta: document.querySelector('label[for="requisitos"]').textContent,
      respuesta: document.getElementById("requisitosCuestionario").value,
    }
  );
  return jsonCuestionario;
}
