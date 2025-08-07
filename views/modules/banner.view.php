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
                                <span>Para contadores y Buffets contables.</span>
                                <h1  style="text-align: justify;" class="wow">Plataforma del contador.</h1>
                                <h1><strong style="color: #282e67;"> Una comunidad que evoluciona contigo</strong></h1>
                                <p class="lead">Creamos soluciones digitales que simplifican tu trabajo y te ayudan a brindar un mejor servicio a tus clientes.</p>
                                <div class="cta-group">
                                   <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registroModal">
                                    <span class="outer-wrap"><span data-text="Regístrate Gratis">Regístrate Contador <i class="bi bi-arrow-right-circle-fill"></i></span>
                                    </a>
                                   <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#registroModal2">
                                    <span class="outer-wrap">
                                      <span data-text="Busco un Contador">
                                        Regístrate Empresario<br>Busco un Contador <i class="bi bi-arrow-right-circle-fill"></i>
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
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="row g-0">
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
              <form>
                <div class="mb-3">
                  <label class="form-label text-primary fw-bold">Nombres y Apellidos</label>
                  <input type="text" class="form-control" placeholder="Ingrese sus Nombres y Apellidos">
                </div>
                <div class="mb-3">
                  <label class="form-label text-primary fw-bold">Cédula o RUC</label>
                  <input type="text" class="form-control" placeholder="Ingrese su documento">
                </div>
                <div class="mb-3">
                  <label class="form-label text-primary fw-bold">Cantón / Donde desea asignación de clientes</label>
                  <input type="text" class="form-control" placeholder="Ingrese un cantón">
                </div>
                <div class="mb-3">
                  <label class="form-label text-primary fw-bold">Teléfono</label>
                  <input type="text" class="form-control" placeholder="Ingrese su número de teléfono">
                </div>
                <p class="text-danger small mt-3">Llenar datos sección CREAR CUENTA</p>

                <!-- Información de contacto con WhatsApp -->
                    <div class="mb-3 mt-4">
                    <div class="d-flex align-items-center p-3 border rounded shadow-sm" style="background-color: #f5f5f5;">
                        <p class="text-muted mb-0">
                        <strong>Atención personalizada para contadores, contáctanos</strong><br>
                        Telf: <a href="https://wa.me/593980606086" target="_blank" class="text-success">
                            +593 980606086</a>
                        <i class="bi bi-whatsapp" style="color: #25D366; font-size: 18px; margin-left: 8px;"></i>
                        </p>
                    </div>
                    </div>
              </form>
              
            </div>
            
            

            <!-- TAB 2: Crear cuenta -->
            <div class="tab-pane fade" id="cuenta" role="tabpanel">
              <h5 class="fw-bold mb-3">Mi Cuenta</h5>
              <form>
                <div class="mb-3">
                  <label class="form-label text-primary fw-bold">Correo Electrónico</label>
                  <input type="email" class="form-control" placeholder="Ingrese su correo">
                </div>
                <div class="mb-3">
                  <label class="form-label text-primary fw-bold">Usuario temporal</label>
                  <input type="text" class="form-control" placeholder="Ingrese un nombre de usuario">
                </div>
                <div class="mb-3">
                  <label class="form-label text-primary fw-bold">Crea una Contraseña</label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="passwordField" placeholder="Ingrese una clave">
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
                  <textarea class="form-control" rows="4" placeholder="Cuéntanos cuántos años de experiencia tienes, en qué tipo de industrias has trabajado, qué software de contabilidad dominas, has manejado auditorías internas o externas..."></textarea>
                </div>

                <!-- Solo se muestra en el tab 'Crear Cuenta' -->
                <div class="mb-3">
                  <div class="g-recaptcha" data-sitekey="TU-SITE-KEY"></div> <!-- Asegúrate de reemplazar con tu clave -->
                </div>

                <!-- Botón de Enviar solo en 'Crear Cuenta' -->
                <div class="d-grid">
                  <button type="submit" class="btn btn-outline-primary btn-sm">
                    <span class="outer-wrap"><span data-text="Registrarse">Registrarse</span></span>
                  </button>
                </div>

                <!-- Información adicional -->
                <p class="text-muted small mt-3">
                  Al registrarte, aceptas nuestros <a href="javscript:">Términos</a>, <a href="javscript:">Política de Datos</a> y <a href="javscript:">Política de Cookies</a>.
                </p>
              </form>
            </div>
          </div>
        </div>

        <!-- Imagen derecha -->
        <div class="col-md-6 d-none d-md-block">
          <div class="h-100" style="background-image: url('assets/images/publicidad3.jpeg'); background-size: cover; background-position: center; border-top-right-radius: 10px; border-bottom-right-radius: 10px;"></div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal con pestañas 2 -->
<!-- Modal con pestañas 2 -->
<div class="modal fade" id="registroModal2" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 10px; max-height: 90vh;">
      <div class="row g-0">
        <!-- Formulario izquierdo -->
        <div class="col-md-6 p-4" style="background-color: #ffffff; border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
          <!-- Botón cerrar -->
          <div class="d-flex justify-content-start mb-3">
            <button type="button" class="btn-close me-3" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            <h5 class="fw-bold">Solicita tu Solución Contable</h5>
          </div>
          <form id="registroForm" onsubmit="return validateForm()">
            <!-- Selección de opción -->
            <div class="mb-3">
              <label class="form-label text-primary fw-bold">Selecciona una o dos opciones: Busco</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="contadoOption">
                <label class="form-check-label" for="contadoOption">
                  Contador
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="sistemaOption">
                <label class="form-check-label" for="sistemaOption">
                  Sistema Contable / Facturero
                </label>
              </div>
            </div>

            <!-- Campo para Nombres y Apellidos -->
            <div class="mb-3">
              <label class="form-label text-primary fw-bold">Nombres y Apellidos</label>
              <input type="text" class="form-control" id="nombre" placeholder="Ingrese sus Nombres y Apellidos" required>
            </div>

            <!-- Campo para Ciudad -->
            <div class="mb-3">
              <label class="form-label text-primary fw-bold">Ciudad</label>
              <input type="text" class="form-control" id="ciudad" placeholder="Ingrese la ciudad de residencia" required>
            </div>

            <!-- Campo para Cargo -->
            <div class="mb-3">
              <label class="form-label text-primary fw-bold">Cargo</label>
              <input type="text" class="form-control" id="cargo" placeholder="Ingrese el cargo que ejerce" required>
            </div>

            <!-- Campo para Teléfono -->
            <div class="mb-3">
              <label class="form-label text-primary fw-bold">Teléfono</label>
              <input type="tel" class="form-control" id="telefono" placeholder="Ingrese su número de teléfono" pattern="[0-9]{10}" title="El teléfono debe contener 10 dígitos numéricos" required>
            </div>

            <!-- Botón para completar el cuestionario -->
            <div class="d-grid">
              <button type="submit" class="btn btn-success btn-sm">
                Completar Cuestionario
              </button>
            </div>
          </form>
        </div>

        <!-- Imagen derecha -->
        <div class="col-md-6 d-none d-md-block" style="background-image: url('assets/images/publicidadEmpresarioContador.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
          <!-- Imagen se ajusta automáticamente al contenedor -->
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
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

