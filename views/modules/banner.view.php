<div class="home-default-banner">
  <div class="container pos-rel">
    <div class="banner-abstract-shape"></div>
    <div class="matrix-vertical">
      <img src="assets/images/matrix_vertical.svg" alt="">
    </div>
    <div class="rectangle-small">
      <img src="assets/images/rectangle_small.svg" alt="">
    </div>
    <div class="row align-items-center">
      <div class="col-lg-7">
        <div class="marketing-banner">
          <div class="title">
            <span>Para contadores y Empresarios.</span>
            <h1 style="text-align: justify;" class="wow">Plataforma del contador.</h1>
            <h1><strong style="color: #282e67;"> Una comunidad que evoluciona contigo</strong></h1>
            <p class="lead" style="text-align: justify;">Somos una comunidad de contadores comprometidos con el crecimiento profesional. Las herramientas que ofrecemos son un valioso aporte colaborativo y gratuito de todos los miembros que integran esta red. Continuamos trabajando de manera constante para desarrollar nuevos recursos que optimicen nuestra labor y faciliten nuestra práctica diaria. Siempre estaremos abiertos a tus conocimientos y sugerencias para seguir mejorando juntos.</p>
            <div class="cta-group">
              <a href="#" class="btn btn-registro" data-bs-toggle="modal" data-bs-target="#registroModal">
                <span class="outer-wrap">
                  <span data-text="Regístrate Gratis">Regístrate Contador <i class="bi bi-arrow-right-circle-fill"></i></span>
                </span>
              </a>
              <a href="#" class="btn btn-busco" data-bs-toggle="modal" data-bs-target="#modalEmpresario">
                <span class="outer-wrap">
                  <span data-text="Busco un Contador">
                    Soy Empresario<br>Busco un Contador <i class="bi bi-arrow-right-circle-fill"></i>
                  </span>
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="banner-img">
          <img src="assets/images/contadora.svg" alt="">
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<b class="screen-overlay"></b>
<!--  Signup Form Start -->
<article class="mobile-offcanvas offcanvas-right" id="signup">
  <button class="btn-close"> <i class="bi bi-x"></i> </button>
  <div class="popup-wrapper" data-lenis-prevent>

    <div class="content">
      <h3>Create an account</h3>
      <div class="social-login-btn">
        <a href="javascript:" class="gm">
          <i class="bi bi-google"></i> With Google
        </a>
        <a href="javascript:" class="fb">
          <i class="bi bi-facebook"></i> With Facebook
        </a>
      </div>

      <div class="or-text">
        <span>Or Signup with your email</span>
      </div>
    </div>

    <div class="form-wrap">
      <div class="">
        <div class="mb-4">
          <input type="text" class="form-control bordered bottom-only" placeholder="Mobile Number or Email">
        </div>
        <div class="mb-4">
          <input type="text" class="form-control bordered bottom-only" placeholder="Full Name">
        </div>
        <div class="mb-4">
          <input type="text" class="form-control bordered bottom-only" placeholder="Username">
        </div>
        <div class="mb-4">
          <input type="text" class="form-control bordered bottom-only" placeholder="Password">
        </div>
        <div class="mb-4 info-form">
          <small>By signing up, you agree to our <a href="javscript:">Terms</a> , <a href="javscript:">Data Policy</a> and <a href="javscript:">Cookies Policy</a>.</small>
        </div>
        <div class="d-grid">
          <button type="button" class="btn btn-outline-primary btn-sm"><span class="outer-wrap"><span data-text="Singup">Singup</span></span></button>
        </div>
      </div>
    </div>
  </div>
</article>

<!--  Signup Form End -->

<!-- Modal con pestañas -->
<div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 1200px; width: 100%;">

    <div class="modal-content" style="border-radius: 10px; max-height: 90vh; height: 100%;">
      <div class="row g-0 h-100">
        <!-- Formulario izquierdo -->
        <div class="col-md-6 p-4">
          <!-- Botón cerrar -->
          <div class="d-flex justify-content-start mb-3">
            <button type="button" class="btn-close me-3" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            <ul class="nav nav-tabs" id="registroTabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="contacto-tab" data-bs-toggle="tab" data-bs-target="#contacto" type="button" role="tab">Información de Contacto</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="cuenta-tab" data-bs-toggle="tab" data-bs-target="#cuenta" type="button" role="tab">Crear Cuenta</button>
              </li>
            </ul>
          </div>
          <div class="tab-content" id="registroTabsContent">
            <!-- TAB 1: Información de contacto -->
            <div class="tab-pane fade show active" id="contacto" role="tabpanel">
              <h5 class="fw-bold mb-3">¿Ya estás registrado?</h5>
              <p class="text-muted small">Únete a nosotros de manera fácil y rápida. <strong>Regístrate Gratis.</strong></p>
              <form method="post" id="datospersonales" action="controller/contacto.ajax.php">
                <div class="mb-3">
                  <label class="form-label text-primary fw-bold">Nombres y Apellidos</label>
                  <input type="text" class="form-control" name="nombres_apellidos" placeholder="Ingrese sus Nombres y Apellidos">
                </div>
                <div class="mb-3">
                  <label class="form-label text-primary fw-bold">Cédula o RUC</label>
                  <input type="text" class="form-control" name="cedula" id="cedula"
                    placeholder="Ingrese su documento"
                    maxlength="13" required
                    pattern="^([0-9]{10}|[0-9]{13})$"
                    title="Ingrese una cédula (10 dígitos) o un RUC (13 dígitos)">
                  <small id="errorCedula" style="color:red; display:none;">Documento inválido. Debe ser 10 o 13 dígitos.</small>
                </div>

                <script>
                  const cedula = document.getElementById("cedula");
                  const errorCedula = document.getElementById("errorCedula");
                  const patternCedula = /^([0-9]{10}|[0-9]{13})$/;

                  cedula.addEventListener("blur", () => {
                    if (!patternCedula.test(cedula.value)) {
                      errorCedula.style.display = "block";
                      cedula.style.borderColor = "red";
                    } else {
                      errorCedula.style.display = "none";
                      cedula.style.borderColor = "green";
                    }
                  });
                </script>
                <div class="mb-3">
                  <label class="form-label text-primary fw-bold">Cantón / Donde desea asignación de clientes</label>
                  <input type="text" class="form-control" name="direccion" placeholder="Ingrese un cantón">
                </div>
                <div class="mb-3">
                  <label class="form-label text-primary fw-bold">Teléfono</label>
                  <input type="text" class="form-control" id="telefono" name="telefono"
                    placeholder="Ingrese su número de teléfono"
                    pattern="^[0-9]{10}$"
                    title="El número debe tener exactamente 10 dígitos"
                    required>
                  <small id="error" style="color:red; display:none;">Número inválido. Debe tener 10 dígitos.</small>
                </div>

                <script>
                  const telefono = document.getElementById("telefono");
                  const error = document.getElementById("error");
                  const pattern = /^[0-9]{10}$/;

                  telefono.addEventListener("blur", () => {
                    if (!pattern.test(telefono.value)) {
                      error.style.display = "block";
                      telefono.style.borderColor = "red";
                    } else {
                      error.style.display = "none";
                      telefono.style.borderColor = "green";
                    }
                  });
                </script>

                <p class="text-danger small mt-3">Llenar datos sección CREAR CUENTA</p>

                <!-- Información de contacto con WhatsApp -->
                <div class="mb-3 mt-4">
                  <div class="d-flex align-items-center p-3 border rounded shadow-sm" style="background-color: #f5f5f5;">
                    <p class="text-muted mb-0">
                      <strong>Atención personalizada para contadores, contáctanos</strong><br>
                      Telf: <a href="https://wa.me/59399 909 7984" target="_blank" class="text-success">
                        +593 99 909 7984</a>
                      <i class="bi bi-whatsapp" style="color: #25D366; font-size: 18px; margin-left: 8px;"></i>
                    </p>
                  </div>
                </div>
              </form>
            </div>

            <!-- TAB 2: Crear cuenta -->
            <div class="tab-pane fade" id="cuenta" role="tabpanel">
              <h5 class="fw-bold mb-3">Mi Cuenta</h5>
              <form method="post" id="registroForm" action="controller/contacto.ajax.php" onsubmit="return validateForm()">
                <div class="mb-3">
                  <label class="form-label text-primary fw-bold">Correo Electrónico</label>
                  <input type="email" class="form-control" name="correo"
                    placeholder="Ingrese su correo"
                    required
                    pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                    title="Ingrese un correo válido, ejemplo: usuario@dominio.com">
                </div>

                <div class="mb-3">
                  <label class="form-label text-primary fw-bold">Usuario temporal</label>
                  <input type="text" class="form-control" name="usuario" placeholder="Ingrese un nombre de usuario" required>
                </div>
                <div class="mb-3">
                  <label class="form-label text-primary fw-bold">Crea una Contraseña</label>
                  <div class="input-group">
                    <input type="password"
                      class="form-control"
                      name="contrasena"
                      id="passwordField"
                      placeholder="Ingrese una clave"
                      required
                      pattern=".{6,}"
                      title="La contraseña debe tener al menos 6 caracteres">
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                      <i class="bi bi-eye"></i>
                    </button>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label text-primary fw-bold">
                    Acerca de tu Experiencia Profesional <small class="text-muted">(opcional)</small>
                    <i class="bi bi-info-circle-fill" title="Cuéntanos tu experiencia..."></i>
                  </label>
                  <textarea class="form-control" name="experiencia" rows="4" placeholder="Cuéntanos cuántos años de experiencia tienes, en qué tipo de industrias has trabajado, qué software de contabilidad dominas, has manejado auditorías internas o externas..."></textarea>
                </div>

                <!-- Solo se muestra en el tab 'Crear Cuenta' -->
                <div class="mb-3">
                  <div class="g-recaptcha" data-sitekey="6Lex3ZUlAAAAAEOKmJwG6BQv651yL2unFSKiPQ6R"></div> <!-- Asegúrate de reemplazar con tu clave -->
                </div>
                <script>
                  document.getElementById("registroForm").addEventListener("submit", function(e) {
                    var captcha = grecaptcha.getResponse();
                    if (captcha.length == 0) {
                      e.preventDefault();
                      alert("Por favor, verifica el captcha antes de enviar.");
                    }
                  });
                </script>
                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                <div id="mensajeRegistro" style="margin-top:15px;"></div>
                <!-- Botón de Enviar solo en 'Crear Cuenta' -->
                <div class="d-grid">
                  <button type="submit" class="btn btn-outline-primary btn-sm">
                    <span class="outer-wrap"><span data-text="Registrarse">Registrarse</span></span>
                  </button>
                </div>
                <script>
                  document.getElementById("registroForm").addEventListener("submit", function(e) {
                    e.preventDefault();

                    // Validar captcha
                    var captcha = grecaptcha.getResponse();
                    if (captcha.length == 0) {
                      alert("Por favor, verifica el captcha antes de enviar.");
                      return;
                    }

                    // Combinar datos de ambos formularios
                    var formDatos = new FormData(document.getElementById("datospersonales")); // primer formulario
                    var formCuenta = new FormData(this); // segundo formulario

                    // Agregar los campos del segundo formulario al primero
                    for (var [key, value] of formCuenta.entries()) {
                      formDatos.append(key, value);
                    }

                    // Enviar al servidor
                    fetch("controller/contacto.ajax.php", {
                        method: "POST",
                        body: formDatos
                      })
                      .then(response => response.json())
                      .then(data => {
                        var mensajeDiv = document.getElementById("mensajeRegistro");

                        if (data.estado) {
                          mensajeDiv.innerHTML = `<div class="alert alert-success">Usuario registrado correctamente. Revisa tu correo electrónico.</div>`;
                          document.getElementById("datospersonales").reset();
                          document.getElementById("registroForm").reset();
                          grecaptcha.reset();
                        } else {
                          mensajeDiv.innerHTML = `<div class="alert alert-danger">${data.mensaje}</div>`;
                        }
                      })
                      .catch(error => console.error("Error:", error));
                  });
                </script>

                <!-- Información adicional -->
                <p class="text-muted small mt-3">
                  Al registrarte, aceptas nuestros <a href="javscript:">Términos</a>, <a href="javscript:">Política de Datos</a> y <a href="javscript:">Política de Cookies</a>.
                </p>
              </form>
            </div>
          </div>
        </div>

        <!-- Imagen derecha -->
        <div class="col-md-6 d-none d-md-flex p-0 align-items-center justify-content-center"
          style="border-top-right-radius: 10px; border-bottom-right-radius: 10px; background-color: #fff;">
          <img src="assets/images/publicidad3.jpeg"
            alt="Publicidad contable"
            class="img-fluid"
            style="max-height: 100%; max-width: 100%; object-fit: contain;" />
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Modal con pestañas 2 -->
<!-- Modal con pestañas 2 -->
<div class="modal fade" id="modalEmpresario" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
  <div class="flash-container" id="flash-container-1">
    <!-- Flash messages will be inserted here -->
  </div>
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 10px; max-height: 90vh;">
      <div class="row g-0">
        <!-- Formulario izquierdo -->
        <div class="col-md-6 p-4" style=" margin-top: 60px; background-color: #ffffff; border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
          <!-- Botón cerrar -->
          <div class="d-flex justify-content-start mb-3">
            <button type="button" class="btn-close me-3" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            <h5 class="fw-bold">Solicita tu Solución Contable</h5>
          </div>
          <!-- Selección de opción -->
          <div class="mb-3">
            <label class="form-label text-primary fw-bold">Selecciona una o dos opciones: Busco</label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="cboxContador">
              <label class="form-check-label" for="cboxContador">
                Contador
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="cboxSistema">
              <label class="form-check-label" for="cboxSistema">
                Sistema Contable / Facturero
              </label>
            </div>
          </div>

          <!-- Campo para Nombres y Apellidos -->
          <div class="mb-3">
            <label class="form-label text-primary fw-bold">Nombres y Apellidos</label>
            <input type="text" class="form-control" id="nombreapellidoEmpresarioSis" placeholder="Ingrese sus Nombres y Apellidos" required>
          </div>

          <!-- Campo para Ciudad -->
          <div class="mb-3">
            <label class="form-label text-primary fw-bold">Ciudad</label>
            <input type="text" class="form-control" id="ciudadEmpresarioSis" placeholder="Ingrese la ciudad de residencia" required>
          </div>

          <!-- Campo para Cargo -->
          <div class="mb-3">
            <label class="form-label text-primary fw-bold">Cargo</label>
            <input type="text" class="form-control" id="cargoEmpresarioSis" placeholder="Ingrese el cargo que ejerce" required>
          </div>

          <!-- Campo para Teléfono -->
          <div class="mb-3">
            <label class="form-label text-primary fw-bold">Teléfono</label>
            <input type="tel" class="form-control" id="telefonoEmpresarioSis" placeholder="Ingrese su número de teléfono" pattern="[0-9]{10}" title="El teléfono debe contener 10 dígitos numéricos" required>
          </div>

          <!-- Botón para completar el cuestionario -->
          <div class="d-grid" id="containerButtonEmpresario">
            <button class="btn btn-success px-4" id="btnPresentacion" disabled>Enviar Información</button>
            <button class="btn btn-success px-4" id="abrirModalCuestionario" style="display:none;">Completar Cuestionario</button>
            <button class="btn btn-success" id="btnRegistroEmpresarioSis" style="display:none;">Enviar Información</button>
          </div>

        </div>

        <!-- Imagen derecha -->
        <div class="col-md-6 d-none d-md-block p-0">
          <img src="assets/images/publicidadEmpresarioContador.jpg" alt="¿Y necesitas un contador?" class="img-fluid rounded-end" />
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="modalCuestionario">
  <div class="flash-container" id="flash-container-2">
    <!-- Flash messages will be inserted here -->
  </div>
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 10px; max-height: 90vh;">
      <div class="card card_registro p-3 p-md-4">
        <div class="d-flex justify-content-start mb-3">
          <button type="button" class="btn-close me-3" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          <h5 class="fw-bold">Solicita tu Solución Contable</h5>
        </div>
        <div class="row mx-2 mx-md-3 mt-4 mb-3">
          <div class="col-12 py-2 mb-2">
            <div class="form-group">
              <label for="canton" class="form-label fw-semibold">1. ¿En qué cantón, parroquia o cabecera cantonal necesita los servicios del profesional?</label>
              <input type="text" class="form-control" id="cantonCuestionario" required>
            </div>
          </div>

          <div class="col-12 py-2 mb-2">
            <div class="form-group">
              <label for="actividad" class="form-label fw-semibold">2. ¿Cuál es la actividad principal de su negocio y qué tipo de servicios de contabilidad requiere para su control?</label>
              <textarea class="form-control" id="actividadCuestionario" rows="3" required></textarea>
            </div>
          </div>

          <div class="col-12 py-2 mb-2">
            <div class="form-group">
              <label for="autonomo" class="form-label fw-semibold">3. ¿Es usted un trabajador autónomo (persona natural) o forma parte de una sociedad?</label>
              <input type="text" class="form-control" id="autonomoCuestionario" required>
            </div>
          </div>

          <div class="col-12 py-2 mb-1">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="facturas" class="form-label fw-semibold">4. Para tener una idea del tamaño y estructura de su negocio sin revelar información confidencial, por favor proporcione una cantidad aproximada de facturas mensuales tanto de compras como de ventas.</label>
                </div>
              </div>

              <div class="col-12 py-2">
                <div class="form-group">
                  <label for="compras" class="form-label sub_pregunta">4.1. Cantidad aproximada de facturas de COMPRAS al mes:</label>
                  <input type="number" class="form-control" id="comprasCuestionario" required>
                </div>
              </div>

              <div class="col-12 py-2">
                <div class="form-group">
                  <label for="ventas" class="form-label sub_pregunta">4.2. Cantidad aproximada de facturas de VENTA al mes:</label>
                  <input type="number" class="form-control" id="ventasCuestionario" required>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 py-2 mb-2">
            <div class="form-group">
              <label for="ruc" class="form-label fw-semibold">5. Por motivos de seguridad tanto para usted como para el profesional, necesitamos el número de Registro Único de Contribuyente (RUC) de su negocio. En caso de tener más de dos empresas o negocios, proporcione únicamente el número de RUC de aquel con mayor movimiento.</label>
              <input type="text" class="form-control" id="rucCuestionario" required>
            </div>
          </div>

          <div class="col-12 py-2 mb-2">
            <div class="form-group">
              <label for="experiencia" class="form-label fw-semibold">6. ¿Cuántos años de experiencia mínima que necesita que tenga el contador?</label>
              <input type="number" class="form-control" id="experienciaCuestionario" required>
            </div>
          </div>

          <div class="col-12 py-2 mb-2">
            <div class="form-group">
              <label for="tiempo" class="form-label fw-semibold">7. ¿Está buscando a un contador a tiempo parcial o a tiempo completo?</label>
              <select class="form-control" id="tiempoCuestionario" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="parcial">Tiempo parcial</option>
                <option value="completo">Tiempo completo</option>
              </select>
            </div>
          </div>

          <div class="col-12 py-2 mb-2">
            <div class="form-group">
              <label for="comunicacion" class="form-label fw-semibold">8. En cuanto a la comunicación con los contadores interesados, ¿preferiría que sean ellos quienes lo contacten a usted o prefiere usted contactarlos?. Si desea que le envien la hoja de vida indicar el correo electronico</label>
              <input type="text" class="form-control" id="comunicacionCuestionario" required>
            </div>
          </div>

          <div class="col-12 py-2 mb-2">
            <div class="form-group">
              <label for="requisitos" class="form-label fw-semibold">9. ¿Hay algún requisito adicional o especificación que desee agregar?. Es importante para nosotros saber cuál es su preferencia</label>
              <textarea class="form-control" id="requisitosCuestionario" rows="3"></textarea>
            </div>
          </div>

          <div class="col-12 text-center py-2">
            <button class="btn btn-primary" id="btnRegistroEmpresario">Enviar Información</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script para mostrar/ocultar contraseña -->
<script>
  function togglePassword() {
    const input = document.getElementById('passwordField');
    input.type = input.type === 'password' ? 'text' : 'password';
  }
</script>


<!-- En tu <head> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Antes de </body> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>