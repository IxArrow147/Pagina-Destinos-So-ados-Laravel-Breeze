<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Tratamiento de Datos Personales | TourSystem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/landing_page.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/politica_privacidad.css') }}" />
</head>
<body>
    <!-- Barra superior -->
    <div class="pp-topbar">
        <div class="container pp-topbar__inner">
            <a href="{{ route('landing_page') }}" class="pp-logo">
                <i class="fa-solid fa-earth-americas"></i> <span>TourSystem</span>
            </a>
            <a href="{{ route('landing_page') }}" class="btn btn-outline-primary btn-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver al inicio
            </a>
        </div>
    </div>

    <!-- Encabezado -->
    <header class="pp-hero">
        <div class="container">
            <div class="pp-hero__icon"><i class="fa-solid fa-shield-halved"></i></div>
            <h1>Política de Tratamiento de Datos Personales</h1>
            <p>
                En {{ config('privacy.responsable') }} cuidamos tu información. Aquí te explicamos qué datos
                recolectamos, para qué los usamos y cómo puedes ejercer tus derechos.
            </p>
            <div class="pp-badges">
                <span class="pp-badge"><i class="fa-solid fa-code-branch me-1"></i> Versión {{ config('privacy.version') }}</span>
                <span class="pp-badge"><i class="fa-regular fa-calendar me-1"></i> Vigente desde el {{ config('privacy.fecha_vigencia') }}</span>
                <span class="pp-badge"><i class="fa-solid fa-scale-balanced me-1"></i> Ley 1581 de 2012</span>
            </div>
        </div>
    </header>

    <main class="container">

        <!-- Resumen rápido -->
        <section class="pp-summary row g-3 mb-4">
            <div class="col-6 col-lg-3">
                <div class="pp-summary-card">
                    <i class="fa-solid fa-database"></i>
                    <h3>Qué recolectamos</h3>
                    <p>Tu nombre, correo y una contraseña cifrada.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="pp-summary-card">
                    <i class="fa-solid fa-bullseye"></i>
                    <h3>Para qué</h3>
                    <p>Crear tu cuenta, darte acceso y enviarte correos de seguridad.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="pp-summary-card">
                    <i class="fa-solid fa-user-check"></i>
                    <h3>Tus derechos</h3>
                    <p>Consultar, corregir o eliminar tus datos cuando quieras.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="pp-summary-card">
                    <i class="fa-solid fa-lock"></i>
                    <h3>Cómo los protegemos</h3>
                    <p>HTTPS, contraseñas cifradas y almacenamiento privado.</p>
                </div>
            </div>
        </section>

        <div class="row g-4">

            <!-- Índice -->
            <aside class="col-lg-3 d-none d-lg-block">
                <nav class="pp-toc">
                    <h4>Contenido</h4>
                    <a href="#responsable"><span>1</span> Responsable</a>
                    <a href="#datos"><span>2</span> Datos que recolectamos</a>
                    <a href="#finalidad"><span>3</span> Finalidad</a>
                    <a href="#autorizacion"><span>4</span> Autorización</a>
                    <a href="#derechos"><span>5</span> Tus derechos</a>
                    <a href="#ejercer"><span>6</span> Cómo ejercerlos</a>
                    <a href="#terceros"><span>7</span> Terceros</a>
                    <a href="#seguridad"><span>8</span> Seguridad</a>
                    <a href="#vigencia"><span>9</span> Vigencia</a>
                </nav>
            </aside>

            <!-- Contenido -->
            <div class="col-lg-9">
                <section id="responsable" class="pp-section">
                    <div class="pp-section__head">
                        <div class="pp-section__icon"><i class="fa-solid fa-building"></i></div>
                        <div><small>Sección 1</small><h2>Responsable del tratamiento</h2></div>
                    </div>
                    <p>
                        Esta política se adopta en cumplimiento de la Ley Estatutaria 1581 de 2012 y sus normas
                        reglamentarias (Decreto 1377 de 2013, compilado en el Decreto 1074 de 2015) sobre protección
                        de datos personales en Colombia.
                    </p>
                    <ul class="pp-list">
                        <li><i class="fa-solid fa-circle-check"></i><span><strong>Razón social:</strong> {{ config('privacy.responsable') }} (plataforma TourSystem)</span></li>
                        @if(config('privacy.domicilio'))
                            <li><i class="fa-solid fa-location-dot"></i><span><strong>Domicilio:</strong> {{ config('privacy.domicilio') }}</span></li>
                        @endif
                        @if(config('privacy.telefono'))
                            <li><i class="fa-solid fa-phone"></i><span><strong>Teléfono:</strong> {{ config('privacy.telefono') }}</span></li>
                        @endif
                        <li><i class="fa-solid fa-envelope"></i><span><strong>Correo para ejercer sus derechos:</strong>
                            <a href="mailto:{{ config('privacy.correo') }}" class="pp-link">{{ config('privacy.correo') }}</a>
                        <li><i class="fa-solid fa-globe"></i><span><strong>Sitio web:</strong> {{ config('app.url') }}</span></li>
                    </ul>
                </section>

                <section id="datos" class="pp-section">
                    <div class="pp-section__head">
                        <div class="pp-section__icon"><i class="fa-solid fa-database"></i></div>
                        <div><small>Sección 2</small><h2>Datos personales que recolectamos</h2></div>
                    </div>
                    <ul class="pp-list">
                        <li><i class="fa-solid fa-circle-check"></i><span>Nombre completo y correo electrónico, que usted ingresa al registrarse.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span>Contraseña, que se almacena cifrada (hash) y que ni el personal puede ver.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span>Fecha y versión de la política que usted aceptó al registrarse.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span>Dirección IP y navegador asociados a su sesión activa, necesarios para mantenerla segura.</span></li>
                    </ul>
                    <div class="pp-note"><i class="fa-solid fa-circle-info me-1"></i> No recolectamos datos sensibles ni datos de menores de edad.</div>
                </section>

                <section id="finalidad" class="pp-section">
                    <div class="pp-section__head">
                        <div class="pp-section__icon"><i class="fa-solid fa-bullseye"></i></div>
                        <div><small>Sección 3</small><h2>Finalidad del tratamiento</h2></div>
                    </div>
                    <p>Sus datos se usan únicamente para:</p>
                    <ul class="pp-list">
                        <li><i class="fa-solid fa-circle-check"></i><span>Crear y administrar su cuenta de usuario.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span>Autenticarlo y permitirle acceder a la plataforma según su rol.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span>Enviarle correos de seguridad, como el enlace para recuperar su contraseña.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span>Proteger la plataforma y detectar errores técnicos.</span></li>
                    </ul>
                    <div class="pp-note"><i class="fa-solid fa-ban me-1"></i> No vendemos sus datos ni los usamos para publicidad.</div>
                </section>

                <section id="autorizacion" class="pp-section">
                    <div class="pp-section__head">
                        <div class="pp-section__icon"><i class="fa-solid fa-file-signature"></i></div>
                        <div><small>Sección 4</small><h2>Autorización</h2></div>
                    </div>
                    <p>
                        Al registrarse, usted debe aceptar esta política de forma expresa marcando la casilla de autorización.
                        Guardamos la fecha y la versión de la política aceptada como prueba de su autorización.
                        Sin esta autorización no es posible crear la cuenta.
                    </p>
                </section>

                <section id="derechos" class="pp-section">
                    <div class="pp-section__head">
                        <div class="pp-section__icon"><i class="fa-solid fa-user-check"></i></div>
                        <div><small>Sección 5</small><h2>Derechos del titular</h2></div>
                    </div>
                    <p>Como titular de los datos, usted tiene derecho a:</p>
                    <ul class="pp-list">
                        <li><i class="fa-solid fa-circle-check"></i><span>Conocer, actualizar y rectificar sus datos personales.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span>Solicitar prueba de la autorización que otorgó.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span>Ser informado del uso que se ha dado a sus datos.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span>Presentar quejas ante la Superintendencia de Industria y Comercio por infracciones a la ley.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span>Revocar la autorización y solicitar la supresión de sus datos, cuando no exista un deber legal o contractual de conservarlos.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span>Acceder de forma gratuita a sus datos personales.</span></li>
                    </ul>
                </section>

                <section id="ejercer" class="pp-section">
                    <div class="pp-section__head">
                        <div class="pp-section__icon"><i class="fa-solid fa-envelope-open-text"></i></div>
                        <div><small>Sección 6</small><h2>Cómo ejercer sus derechos</h2></div>
                    </div>
                    <p>
                        Puede escribir a <a href="mailto:{{ config('privacy.correo') }}" class="pp-link">{{ config('privacy.correo') }}</a>
                        indicando su nombre, el correo de su cuenta y lo que solicita.
                        Las consultas se responden en un máximo de 10 días hábiles, prorrogables por 5 días hábiles más
                        con aviso previo. Los reclamos se atienden en un máximo de 15 días hábiles, prorrogables por 8 días hábiles más.
                    </p>
                    <div class="pp-note">
                        <i class="fa-solid fa-user-xmark me-1"></i>
                        Además, usted puede <strong>eliminar su cuenta directamente desde su perfil</strong> en la plataforma
                        (menú de usuario, opción «Mi Perfil»).
                    </div>
                </section>

                <section id="terceros" class="pp-section">
                    <div class="pp-section__head">
                        <div class="pp-section__icon"><i class="fa-solid fa-network-wired"></i></div>
                        <div><small>Sección 7</small><h2>Terceros que procesan datos</h2></div>
                    </div>
                    <p>
                        Para operar la plataforma usamos proveedores tecnológicos que pueden tener sus servidores fuera de Colombia,
                        por lo que el tratamiento puede implicar transferencia internacional de datos:
                    </p>
                    <div class="row g-3">
                        <div class="col-md-6"><div class="pp-provider"><i class="fa-solid fa-server"></i><div><strong>Railway</strong><span>Alojamiento de la aplicación y de la base de datos.</span></div></div></div>
                        <div class="col-md-6"><div class="pp-provider"><i class="fa-solid fa-paper-plane"></i><div><strong>Resend</strong><span>Envío de correos transaccionales (por ejemplo, recuperación de contraseña).</span></div></div></div>
                        <div class="col-md-6"><div class="pp-provider"><i class="fa-solid fa-bug"></i><div><strong>Sentry</strong><span>Registro de errores técnicos. Está configurado para no enviar datos de usuarios, direcciones IP ni cabeceras de las peticiones.</span></div></div></div>
                        <div class="col-md-6"><div class="pp-provider"><i class="fa-solid fa-cloud"></i><div><strong>Backblaze</strong><span>Almacenamiento de archivos de la aplicación, como las fotos de los destinos.</span></div></div></div>
                    </div>
                </section>

                <section id="seguridad" class="pp-section">
                    <div class="pp-section__head">
                        <div class="pp-section__icon"><i class="fa-solid fa-lock"></i></div>
                        <div><small>Sección 8</small><h2>Medidas de seguridad</h2></div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6"><div class="pp-measure"><i class="fa-solid fa-lock"></i><div><strong>HTTPS</strong><span>Conexión cifrada entre su navegador y la plataforma.</span></div></div></div>
                        <div class="col-md-6"><div class="pp-measure"><i class="fa-solid fa-key"></i><div><strong>Contraseñas con hash</strong><span>Nunca se guardan en texto plano.</span></div></div></div>
                        <div class="col-md-6"><div class="pp-measure"><i class="fa-solid fa-user-shield"></i><div><strong>Control de acceso por roles</strong><span>Las funciones administrativas están restringidas.</span></div></div></div>
                        <div class="col-md-6"><div class="pp-measure"><i class="fa-solid fa-box-archive"></i><div><strong>Archivos privados y cifrados</strong><span>Almacenamiento privado, cifrado en reposo.</span></div></div></div>
                        <div class="col-md-6"><div class="pp-measure"><i class="fa-solid fa-code"></i><div><strong>Credenciales fuera del código</strong><span>Los servicios externos usan variables de entorno.</span></div></div></div>
                        <div class="col-md-6"><div class="pp-measure"><i class="fa-solid fa-chart-line"></i><div><strong>Monitoreo</strong><span>Vigilancia de disponibilidad y de errores de la plataforma.</span></div></div></div>
                    </div>
                </section>

                <section id="vigencia" class="pp-section">
                    <div class="pp-section__head">
                        <div class="pp-section__icon"><i class="fa-solid fa-calendar-check"></i></div>
                        <div><small>Sección 9</small><h2>Vigencia y cambios</h2></div>
                    </div>
                    <p>
                        Sus datos se conservan mientras su cuenta esté activa. Si usted elimina su cuenta desde su perfil,
                        se borran de forma permanente su nombre, correo, contraseña, constancia de autorización y sesiones activas.
                        Actualmente no existe información asociada a su cuenta que la ley obligue a conservar; si en el futuro
                        alguna norma exigiera conservar algún dato, solo se conservará ese dato y por el tiempo estrictamente exigido.
                    </p>
                    <p>
                        Si esta política cambia de forma sustancial, lo informaremos en la plataforma.
                        La versión vigente es la {{ config('privacy.version') }}, desde el {{ config('privacy.fecha_vigencia') }}.
                    </p>
                </section>

                <!-- Contacto -->
                <section class="pp-contact">
                    <div class="row align-items-center g-3">
                        <div class="col-md-8">
                            <h2><i class="fa-solid fa-headset me-2"></i>¿Tienes dudas sobre tus datos?</h2>
                            <p class="mb-0">Escríbenos y atenderemos tu consulta o reclamo dentro de los plazos legales.</p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <a href="mailto:{{ config('privacy.correo') }}" class="pp-contact__btn">
                                <i class="fa-solid fa-envelope"></i> Contactar
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <footer class="pp-footer">
        &copy; 2026 {{ config('privacy.responsable') }} — TourSystem. Todos los derechos reservados.
    </footer>

</body>
</html>