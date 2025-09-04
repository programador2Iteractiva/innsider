<?php

/**
 * Taxonomy template Events Nationals
 *
 * @package Connexo
 */

$taxonomy = get_queried_object();
$cuttentTaxonomyId = $taxonomy->term_taxonomy_id;
$cuttentTaxonomyParentId = $taxonomy->parent;

?>
<?php $catId = $taxonomy->term_id ?>

<?php $ContentRegisterAcademy = get_term_meta($cuttentTaxonomyParentId, 'Content_Register_Academy', true); ?>
<?php $urlCatRedirect = get_term_link($catId); ?>

<?php if ($ContentRegisterAcademy === '1'): ?>

    <?php if (!is_user_logged_in()): ?>

        <?php $login_url = wp_login_url($urlCatRedirect); ?>
        <?php $linkCatRedirect = $login_url; ?>
        <script>
            window.location.href = '<?php echo $linkCatRedirect; ?>';
        </script>

    <?php endif ?>

<?php endif; ?>

<?php $ContentRegisterAcademysub = get_term_meta($catId, 'Content_Register_Academy', true); ?>
<?php $urlCatRedirect = get_term_link($catId); ?>

<?php if ($ContentRegisterAcademysub === '1'): ?>

    <?php if (!is_user_logged_in()): ?>

        <?php $login_url = wp_login_url($urlCatRedirect); ?>
        <?php $linkCatRedirect = $login_url; ?>
        <script>
            window.location.href = '<?php echo $linkCatRedirect; ?>';
        </script>

    <?php endif ?>

<?php endif; ?>



<div class="container mx-2 mx-lg-auto px-0">
    <div class="container mt-4 mx-0 px-0 pb-4">
        <?php custom_breadcrumbs(); ?>
    </div>
</div>

<?php $descriptioonCategory = $taxonomy->description; ?>
<?php $subtitleCategory = get_field('title_for_description_complementary', $taxonomy); ?>
<?php $bannerCategory = get_field('Category_Image_Banner', $taxonomy); ?>
<?php $bannerCategoryMovil = get_field('Category_Image_Banner_Movil', $taxonomy); ?>
<?php $subDescriptioonCategory = get_field('subdescription_complementary', $taxonomy); ?>



<?php /* template con el contenido de las subcategoria de la categoria princiapl "Eventos Nacionales" term_id 6 */ ?>
<?php if (!empty($cuttentTaxonomyParentId) && $cuttentTaxonomyParentId == 6): ?>

    <div class="container third-background-taxonomy mt-lg-3 mt-3 p-3 pt-4 pt-lg-5 p-lg-5">
        <div class="container banner-taxonomy-academy d-lg-block d-none" data-aos="zoom-in">
            <?php if (isset($bannerCategory) && !empty($bannerCategory)): ?>
                <img src="<?= esc_url(wp_get_attachment_url($bannerCategory)); ?>" alt="banner-sub-eventos"
                    class="bg-taxonomy-academy">
            <?php endif; ?>
            <div class="wrapper-taxonomy-academy"></div>
        </div>
        <div class="container banner-taxonomy-academy d-block d-lg-none" data-aos="zoom-in">
            <?php if (isset($bannerCategoryMovil) && !empty($bannerCategoryMovil)): ?>
                <img src="<?= esc_url(wp_get_attachment_url($bannerCategoryMovil)); ?>" alt="banner-sub-eventos"
                    class="bg-taxonomy-academy">
            <?php endif; ?>
            <div class="wrapper-taxonomy-academy"></div>
        </div>
        <div class="container mt-4">
            <div class="row m-0 p-0">
                <?php if (isset($subtitleCategory) && !empty($subtitleCategory)): ?>
                    <h2 class="NotoSans-Bold title-color text-uppercase d-none d-lg-block mx-0 p-0"><?= $subtitleCategory; ?>
                    </h2>
                    <h5 class="NotoSans-Bold title-color text-uppercase d-block d-lg-none mx-0 p-0"><?= $subtitleCategory; ?>
                    </h5>
                <?php endif ?>
                <?php if (isset($subDescriptioonCategory) && !empty($subDescriptioonCategory)): ?>
                    <h5 class="NotoSans-SemiBold description-color line-height-2 text-align-justify d-none d-lg-block mx-0 p-0">
                        <?= $subDescriptioonCategory; ?>
                    </h5>
                    <p class="NotoSans-SemiBold description-color  text-align-justify d-block d-lg-none mx-0 p-0 ">
                        <?= $subDescriptioonCategory; ?>
                    </p>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-0">
        <div class="container mt-4 mx-lg-0 mx-2 px-0 pb-4">
            <div class="row m-0 p-0">

                <?php
                $listPostAcademy = new WP_Query(
                    [
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'academia',
                                'field' => 'id',
                                'terms' => $taxonomy->term_id,
                            )
                        ),
                        'orderby' => 'post_date',
                        'order' => 'ASC',
                        'posts_per_page' => -1,
                        'post_status' => 'publish'
                    ]
                );
                ?>

                <?php if (isset($listPostAcademy) && !empty($listPostAcademy)): ?>
                    <?php if ($listPostAcademy->have_posts()): ?>
                        <?php while ($listPostAcademy->have_posts()):
                            $listPostAcademy->the_post() ?>

                            <?php $SubtitleModule = get_field('Subtitle_Module'); ?>
                            <?php $postActivityId = get_the_ID(); ?>

                            <?php if ($taxonomy->term_id != 20): ?>
                                <h3 class="NotoSans-Bold title-color"><?= the_title() ?></h3>
                            <?php endif; ?>

                            <h2 class="NotoSans-Bold m-0 text-uppercase text-linear-gradient"><?= $SubtitleModule; ?></h2>

                            <div class="col-12 mx-1" id="linea">
                                <hr>
                            </div>

                            <?php $listContentModules = get_field('list_of_content_module'); ?>

                            <?php if (isset($listContentModules) && !empty($listContentModules)): ?>

                                <?php $counter = 0; ?>

                                <?php foreach ($listContentModules as $listContentModule): ?>

                                    <?php $imageModuleAcademy = $listContentModule['Img_Video_Mod']; ?>
                                    <?php $titleModuleAcademy = $listContentModule['Title_Video_Mod']; ?>
                                    <?php $speakerModuleAcademy = $listContentModule['Name_Speaker_Mod']; ?>
                                    <?php $descriptionModuleAcademy = $listContentModule['Description_Module']; ?>
                                    <?php $urlModuleAcademy = $listContentModule['URL_Video_Module']; ?>

                                    <div
                                        class="col-12 col-md-4 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3 d-flex flex-column justify-content-start align-items-center card-taxonomies-subcategory-academy-events-two m-0 p-0 mt-3 mb-3">
                                        <a class="custom-width"
                                            href="<?php echo get_permalink($postActivityId) . '?module_id=' . $postActivityId . '&content_id=' . $counter . '&tax=' . $taxonomy->term_id; ?>"
                                            onclick="saveLogsClick('Clic en tarjeta `<?= $titleModuleAcademy ?>`');"
                                            style="text-decoration: none;">
                                            <div class="mb-4 figure">
                                                <?php if ($imageModuleAcademy): ?>
                                                    <?php echo wp_get_attachment_image($imageModuleAcademy, 'full', '', ['style' => 'object-fit: fill']); ?>
                                                <?php endif ?>
                                            </div>
                                           <div class="mt-1 p-0 d-flex flex-column justify-content-center align-items-center" style="min-height: 250px;">
                                                <div class="w-75 p-2 mb-4 btn-view-now text-center">
                                                    <i class="fa-regular fa-circle-play mx-2"></i>
                                                    Ver ahora
                                                </div>
                                                <?php if ($titleModuleAcademy): ?>
                                                    <h5 class="NotoSans-Bold title-color text-center"><?= $titleModuleAcademy; ?></h5>
                                                <?php endif; ?>
                                                <div class="mt-auto">
                                                    <?php if ($speakerModuleAcademy): ?>
                                                        <p class="NotoSans-Regular description-color text-center mb-0"><?= $speakerModuleAcademy; ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <?php $counter++; ?>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        <?php endwhile; ?>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>

        <?php if ($taxonomy->term_id == 20): ?>
            <?php
            // ID único para evitar choques si insertas más de un bloque en la misma página
            $ACC_ID = 'accs_' . uniqid();
            ?>
            <style>
                /* ===== Acordeón simple (sin dependencias) ===== */
                .accs-wrap {
                    max-width: 960px;
                    margin: 24px auto;
                    padding: 0 12px;
                }

                .accs-accordion {
                    display: flex;
                    flex-direction: column;
                    gap: 16px;
                }

                .accs-item {
                    border: none;
                    margin: 2rem;
                }

                .accs-header {
                    display: flex;
                    flex-direction: column;
                    padding: 0;
                    margin: 0;
                    border: 0;
                    background: transparent;
                    cursor: pointer;
                    width: 100%;
                    text-align: center;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    position: relative;
                    z-index: 2;
                }

                .accs-banner {
                    display: block;
                    width: 80%;
                    height: auto;
                    border-radius: 12px;
                    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .08);
                }

                .accs-deploy-btn {
                    position: absolute;
                    width: 4rem;
                    height: auto;
                    left: 50%;
                    bottom: 0;
                    transform: translate(-50%, 50%);
                    z-index: 3;
                }

                .accs-panel {
                    display: none;
                    background: #f4f7fe;
                    border-radius: 12px;
                    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .06);
                    color: #00186c;
                    margin-top: -3rem;
                    padding: 7rem;
                }

                .accs-item.abierto .accs-panel {
                    display: block;
                }

                .leadish {
                    font-size: 1.3rem;
                }

                .q-title {
                    font-size: 5rem;
                }

                .q-subtitle {
                    font-size: 1.2rem;
                }

                .q-number {
                    font-weight: bold;
                }

                /* ===== Media Queries para manejo responsive ===== */

                /* Pantallas pequeñas (teléfonos) */
                @media (max-width: 576px) {
                    .accs-item {
                        margin: 1rem;
                    }

                    .accs-banner {
                        width: 100%;
                    }

                    .accs-deploy-btn {
                        width: 3rem;
                    }

                    .accs-panel {
                        margin-top: -2.5rem;
                        padding: 7rem 3rem ;
                    }

                    .q-title {
                        font-size: 3rem;
                    }

                    .q-subtitle {
                        font-size: 1rem;
                    }
                }

                /* Pantallas medianas (tabletas) */
                @media (min-width: 577px) and (max-width: 992px) {
                    .accs-item {
                        margin: 1.5rem;
                    }

                    .accs-banner {
                        width: 90%;
                    }

                    .accs-deploy-btn {
                        width: 3.5rem;
                    }

                    .q-title {
                        font-size: 4rem;
                    }

                    .q-subtitle {
                        font-size: 1.1rem;
                    }
                }

            </style>

            <div class="accs-wrap">
                <div id="<?php echo $ACC_ID; ?>" class="accs-accordion" role="tablist">

                    <!-- ITEM 1 -->
                    <article class="accs-item" data-id="carlos">
                        <button class="accs-header" type="button" aria-expanded="false"
                            aria-controls="<?php echo $ACC_ID; ?>_panel_carlos" id="<?php echo $ACC_ID; ?>_header_carlos">

                            <img class="accs-banner" alt="Carlos Montealegre"
                                src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/CO25UMA00064_Banner_Mobile_Carlos.png">

                            <img class="accs-deploy-btn" alt="Desplegar"
                                src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/CO25UMA00064_Boton_desplegar.png">

                        </button>
                        <div class="accs-panel" id="<?php echo $ACC_ID; ?>_panel_carlos" role="region"
                            aria-labelledby="<?php echo $ACC_ID; ?>_header_carlos" >
                            <div class="mb-4 justify-content-center d-flex-column" >
                                <div class="q-title d-flex justify-content-center align-items-center gap-5">
                                    <span class="q-number">1.</span>
                                    <div class=" fw-bold q-subtitle">¿Quisiera conocer específicamente en qué se <br />
                                        innova? ¿Qué les transformó el servicio?</div>
                                </div>
                                <p class="leadish mt-2">
                                    EI proceso que realizamos de innovación guiados por Novo
                                    Nordisk ya fue innovación en sí, porque nos permitió poner en
                                    práctica por primera vez un proceso incluyendo a las personas
                                    de campo para pensar diferente y encontrar soluciones en
                                    equipo donde se aplicaron nuevas ideas para hacer que las
                                    relaciones, servicios o entornos sean más empáticos, cercanos,
                                    comprensivos y centrados en los usuarios.
                                </p>
                                <p class="leadish mt-2">
                                    EI servicio cambió por mejoras organizativas en estructura
                                    sencillas tales como el cambio de lugar de macetas en la sala de
                                    espera que permitió facilitar el bienestar y ambiente de cara a
                                    los pacientes y en la prácticas en el trato al cliente externo
                                    partiendo del reconocimiento de la importancia del cliente
                                    interno que hicieron eI servicio más humano, empático,
                                    eficiente o personalizado.
                                </p>
                                <div class="q-title d-flex justify-content-center align-items-center gap-5">
                                    <span class="q-number">2.</span>
                                    <div class="q-subtitle fw-bold">¿Quisiera conocer específicamente en qué se <br />
                                        innova? ¿Qué les transformó el servicio?</div>
                                </div>
                                <p class="leadish mt-2">
                                    EI proceso demoró aproximadamente 6 meses desde que se
                                    planteó la necesidad y se dio inició la planeación de las sesiones
                                    con los equipos de las diferentes sedes de la Regional, se pasó a
                                    la implementación de las sesiones y en el siguiente paso se
                                    obtuvieron los resultados de cada uno de los equipos en su
                                    proceso propio de innovación para posteriormente realizar la
                                    medición de los resultados posterior a la puesta en marcha de
                                    las ideas innovadoras.
                                </p>
                                <div class="q-title d-flex justify-content-center align-items-center gap-5">
                                    <span class="q-number">3.</span>
                                    <div class="q-subtitle fw-bold">Pregunta Bucaramanga a partir de la charla del jefe<br />
                                        Montealegre: Satisfacción va de la mano con la<br />
                                        adherencia a tratamientos. ¿Han llegado a medir<br />
                                        adherencia y/o resultados en los pacientes?</div>
                                </div>
                                <p class="leadish mt-2">
                                    Se tienen indicadores de resultado relacionados con logro de
                                    metas clínicas que efectivamente son mejores en las sedes en
                                    donde se observa mayor resultado en satisfacción de usuarios.
                                </p>
                                <p class="leadish mt-2">
                                    Se mejoró cumplimiento de tratamientos médicos o terapias,
                                    Participación activa en su cuidado y Confianza en el equipo de
                                    salud
                                </p>
                                <div class="q-title d-flex justify-content-center align-items-center gap-5">
                                    <span class="q-number">4.</span>
                                    <div class="q-subtitle fw-bold">¿Cómo miden la satisfacción? ¿Con encuestas?</div>
                                </div>
                                <p class="leadish mt-2">
                                    EI NPS, o Net Promoter Score (Puntuación Neta del Promotor),
                                    es una métrica utilizada para medir la lealtad de los clientes
                                    hacia una marca, producto o servicio. Se basa en la respuesta a
                                    una única pregunta clave:
                                </p>
                                <ul class="leadish">
                                    <li>"En una escala de 0 a 10, ¿qué tan probable es que
                                        recomiendes nuestra empresa/producto/servicio a un amigo
                                        o colega?"</li>
                                </ul>
                                <div class="leadish d-flex w-100 fw-bold">
                                    Cálculo del NPS
                                </div>
                                <div class="leadish">
                                    Las respuestas se dividen en tres categorías:
                                </div>
                                <ul class="leadish">
                                    <li>Promotores (puntuaciones de 9 a 10): muy
                                        satisfechos que probablemente harán recomendaciones y
                                        contribuirán al crecimiento del negocio.</li>
                                    <li>Pasivos (puntuaciones de 7 a 8): Son clientes satisfechos,
                                        pero no 10 suficientemente entusiastas como para
                                        recomendar la marca. Pueden ser susceptibles a la
                                        competencia.</li>
                                    <li>Críticos (puntuaciones de 0 a 6): Son los clientes
                                        insatisfechos. Pueden dañar la reputación de la marca a
                                        través de comentarios negativos.</li>
                                </ul>
                                <p class="leadish mt-2">
                                    EI cálculo del NPS se realiza restando el porcentaje de críticos
                                    del porcentaje de promotores: NPS=%Promotores—%Críticos
                                    Realizar encuestas de NPS de manera regular puede ayudar a
                                    las empresas a rastrear cambios en la lealtad del cliente a 10
                                    largo del tiempo y a medir el impacto de nuevas iniciativas o
                                    cambios en el servicio.
                                </p>
                                <div class="q-title d-flex justify-content-center align-items-center gap-5">
                                    <span class="q-number">5.</span>
                                    <div class="q-subtitle fw-bold">¿Ese impacto también se mide en adherencia a<br />
                                        tratamiento y logro de metas en tratamiento?</div>
                                </div>
                                <p class="leadish mt-2">
                                    Se presentó un impacto directo en la adherencia al tratamiento
                                    y el logro de metas clínicas, se fortaleció la relación terapéutica,
                                    donde mejoró la comunicación, aumentando el compromiso del
                                    paciente con su proceso de salud. generando confianza en eI
                                    equipo de salud
                                </p>
                            </div>

                        </div>
                    </article>

                    <!-- ITEM 2 -->
                    <article class="accs-item" data-id="ana">
                        <button class="accs-header" type="button" aria-expanded="false"
                            aria-controls="<?php echo $ACC_ID; ?>_panel_carlos" id="<?php echo $ACC_ID; ?>_header_carlos">

                            <img class="accs-banner" alt="Carlos Montealegre"
                                src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/CO25UMA00064_Banner_Mobile_Catalina.png">

                            <img class="accs-deploy-btn" alt="Desplegar"
                                src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/CO25UMA00064_Boton_desplegar.png">

                        </button>
                        <div class="accs-panel" id="<?php echo $ACC_ID; ?>_panel_carlos" role="region"
                            aria-labelledby="<?php echo $ACC_ID; ?>_header_carlos">
                            <div class="mb-4 justify-content-center d-flex-column" style="padding: 7rem;">
                                <div class="q-title d-flex justify-content-center align-items-center gap-5">
                                    <span class="q-number">1.</span>
                                    <div class=" fw-bold q-subtitle">¿Cómo ha influido la globalización en la adaptación <br />
                                        y aplicación de intervenciones en la salud pública?</div>
                                </div>
                                <p class="leadish mt-2">
                                    La globalización ha influido profundamente en la adaptación y
                                    aplicación de intervenciones en salud pública, tanto positiva
                                    como negativamente:
                                </p>
                                <ul class="leadish">
                                    <li>Ha facilitado el intercambio rápido de evidencia científica,
                                        tecnologías en salud y buenas prácticas entre países. Esto ha
                                        permitido adaptar intervenciones exitosas a contextos
                                        locales, como se evidenció durante la pandemia de COVID-19
                                        con la rápida adopción de medidas de vigilancia, diagnóstico
                                        y vacunación</li>
                                    <li>Organismos como la OMS han promovido estrategias
                                        globales, como el Plan de Acción Nacional de Seguridad
                                        Sanitaria (PANSS), que orientan a los países en laF
                                        implementación de capacidades esenciales de salud pública,
                                        adaptadas a sus contextos nacionales pero alineadas con
                                        estándares internacionales</li>
                                    <li>Ha impulsado alianzas entre gobiernos, ONGs, sector
                                        privado y organismos multilaterales, 10 que ha fortalecido la
                                        implementación de intervenciones integradas y sostenibles</li>
                                    <li>A pesar de los avances, la globalización también ha
                                        exacerbado inequidades en salud. Las poblaciones más
                                        vulnerables, especialmente en países de bajos ingresos,
                                        enfrentan barreras para acceder a los beneficios de las
                                        intervenciones globales, como medicamentos o tecnologías
                                        de punta</li>
                                    <li>La globalización ha reforzado la noción de que la salud es un
                                        derecho humano y un bien público global, 10 que ha
                                        motivado a los países a adoptar políticas de promoción de la
                                        salud más inclusivas y sostenibles</li>
                                </ul>
                                <p class="leadish mt-2">
                                    En resumen, la globalización ha sido un catalizador para la
                                    innovación, cooperación y estandarización en salud pública,
                                    pero también ha planteado desafíos en equidad, sostenibilidad
                                    y adaptación local. La ciencia de la implementación juega un
                                    papel clave para traducir estas oportunidades globales en
                                    acciones efectivas y contextualizadas.
                                </p>
                            </div>
                        </div>
                    </article>

                    <!-- ITEM 3 -->
                    <article class="accs-item" data-id="daniela">
                        <button class="accs-header" type="button" aria-expanded="false"
                            aria-controls="<?php echo $ACC_ID; ?>_panel_carlos" id="<?php echo $ACC_ID; ?>_header_carlos">

                            <img class="accs-banner" alt="Carlos Montealegre"
                                src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/CO25UMA00064_Banner_Mobile_Daniela.png">

                            <img class="accs-deploy-btn" alt="Desplegar"
                                src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/CO25UMA00064_Boton_desplegar.png">

                        </button>
                        <div class="accs-panel" id="<?php echo $ACC_ID; ?>_panel_carlos" role="region"
                            aria-labelledby="<?php echo $ACC_ID; ?>_header_carlos">
                            <div class="mb-4 justify-content-center d-flex-column" style="padding: 7rem;">
                                <div class="q-title d-flex justify-content-center align-items-center gap-5">
                                    <span class="q-number">1.</span>
                                    <div class=" fw-bold q-subtitle">¿Cómo han manejado la adherencia de los <br />
                                        pacientes al programa de obesidad?</div>
                                </div>
                                <p class="leadish mt-2">
                                    En el HUV hemos abordado la adherencia como un eje
                                    transversal del modelo de atención. Implementamos
                                    estrategias como:
                                </p>
                                <ul class="leadish">
                                    <li>Consultas en simultáneo del equipo multidisciplinario para
                                        reducir tiempos y mejorar la experiencia del paciente.</li>
                                    <li>Acompañamiento telefónico y virtual para seguimiento.</li>
                                    <li>Educación continua y talleres grupales.</li>
                                    <li>Modelo de autogestión de citas para empoderar al usuario.</li>
                                    <li>Priorización de intervenciones centradas en el paciente y su
                                        entorno familiar.</li>
                                    <li>Telemedicina en especialidades como psicología, nutrición y
                                        medicina interna (de control y seguimiento)</li>
                                </ul>
                                <p class="leadish mt-2">
                                    Estas acciones han permitido mejorar la continuidad en eI
                                    proceso, especialmente en pacientes con múltiples barreras
                                    sociales y económicas.
                                </p>
                                <div class="q-title d-flex justify-content-center align-items-center gap-5">
                                    <span class="q-number">2.</span>
                                    <div class=" fw-bold q-subtitle">¿Hay diferencia en la adherencia al programa<br />
                                        en pacientes con régimen subsidiado y<br />
                                        contributivo?</div>
                                </div>
                                <p class="leadish mt-2">
                                    Sí, hemos identificado diferencias, especialmente en el acceso
                                    oportuno a servicios complementarios, transporte y recursos
                                    terapéuticos en el régimen subsidiado. Sin embargo, nuestro
                                    modelo busca cerrar esa brecha a través de:
                                </p>
                                <ul class="leadish">
                                    <li>Coordinación con trabajo social para apoyos logísticos.</li>
                                    <li>Red de aliados comunitarios para educación y seguimiento.</li>
                                    <li>Priorización en la agenda para evitar deserción. A
                                        pesar de las diferencias estructurales del sistema, cuando se
                                        garantiza continuidad asistencial, la motivación y adherencia
                                        clínica puede ser comparable entre regímenes.</li>
                                </ul>
                                <div class="q-title d-flex justify-content-center align-items-center gap-5">
                                    <span class="q-number">3.</span>
                                    <div class=" fw-bold q-subtitle">Todos sabemos la importancia de la obesidad<br />
                                        actualmente y el alto costo de la misma, pero ¿qué<br />
                                        estrategias usar para que las EPS, o mejor, el Estado<br />
                                        priorice esta patología?</div>
                                </div>
                                <p class="leadish mt-2 fw-bold">
                                    Gestión del dato y caracterización poblacional:
                                </p>
                                <p class="leadish mt-2">
                                    Es fundamental contar con sistemas de información robustos
                                    que permitan identificar, estratificar y seguir a la población con
                                    obesidad. La caracterización por niveles de riesgo, edad,
                                    régimen, comorbilidades y consumo de servicios permite
                                </p>
                                <p class="leadish mt-2">
                                    orientar intervenciones costo-efectivas y definir paquetes de
                                    atención ajustados a las necesidades reales del territorio.
                                </p>
                                <p class="leadish mt-2 fw-bold">
                                    Medición de carga de enfermedad:
                                </p>
                                <p class="leadish mt-2">
                                    Implementar herramientas que midan eI impacto de la
                                    obesidad en términos de años de vida ajustados por
                                    discapacidad (AVAD), costos por complicaciones evitables y uso
                                    de servicios especializados. Esto permite traducir la magnitud
                                    clínica de la enfermedad en lenguaje económico comprensible
                                    para EPS y tomadores de decisión.
                                </p>
                                <p class="leadish mt-2 fw-bold">
                                    Participación en mesas técnicas e intersectoriales:
                                </p>
                                <p class="leadish mt-2">
                                    Es clave que instituciones como el HUV participen activamente
                                    en mesas de planeación territorial y comités de enfermedades
                                    crónicas, aportando evidencia del impacto de la obesidad, no
                                    solo en salud, sino en productividad laboral, educación y
                                    seguridad social.
                                </p>
                                <p class="leadish mt-2 fw-bold">
                                    Articulación con el sector público y privado:
                                </p>
                                <p class="leadish mt-2">
                                    Promover alianzas con EPS, entes territoriales, universidades y
                                    el sector productivo, con el objetivo de generar estrategias
                                    conjuntas de prevención, tratamiento y seguimiento. La
                                    obesidad debe ser entendida como un problema multicausal
                                    ue exi e res uestas multisectoriales.
                                </p>
                                <p class="leadish mt-2 fw-bold">
                                    Evidenciar el impacto económico de la inacción:
                                </p>
                                <p class="leadish mt-2">
                                    Es necesario visibilizar que no intervenir la obesidad genera
                                    altos costos directos (hospitalizaciones, medicamentos,
                                    atención de comorbilidades) e indirectos (incapacidad laboral,
                                    pensiones prematuras, pérdida de productividad). La evidencia
                                    económica debe convertirse en una herramienta de presión
                                    para priorizar recursos y políticas públicas específicas.
                                </p>
                                <div class="q-title d-flex justify-content-center align-items-center gap-5">
                                    <span class="q-number">4.</span>
                                    <div class=" fw-bold q-subtitle">¿Qué indicadores son útiles al mostrar la <br />
                                        importancia de tu programa de obesidad? Más<br />
                                        que calidad de vida, ya que para los entes<br />
                                        territoriales y EPS se requieren indicadores que<br />
                                        impacten costos.</div>
                                </div>
                                <p class="leadish mt-2 fw-bold">
                                    Reducción de hospitalizaciones y urgencias por
                                    comorbilidades asociadas:
                                </p>
                                <ul class="leadish">
                                    <li>Disminución en reingresos por descompensaciones
                                        metabólicas (DM2, HTA, dislipidemias).</li>
                                    <li>Menor uso de servicios de urgencias por complicaciones
                                        prevenibles.</li>
                                </ul>
                                <p class="leadish mt-2 fw-bold">
                                    Disminución del consumo de medicamentos de alto costo:
                                </p>
                                <ul class="leadish">
                                    <li>Control de enfermedades crónicas que permite suspender o
                                        reducir dosis de antihipertensivos, hipoglucemiantes e
                                        hipolipemiantes.</li>
                                    <li>Indicadores de des prescripción tras intervención exitosa.</li>
                                </ul>
                                <p class="leadish mt-2 fw-bold">
                                    Reducción del ausentismo e incapacidades laborales:
                                </p>
                                <ul class="leadish">
                                    <li>Número de días de incapacidad evitados por paciente
                                        intervenido.</li>
                                    <li>Tasa de reincorporación laboral postratamiento integral.</li>
                                </ul>
                                <p class="leadish mt-2 fw-bold">
                                    Ahorro proyectado por paciente intervenido vs. no
                                    intervenido: </p>
                                <ul class="leadish">
                                    <li>Cálculos comparativos de costos directos e indirectos
                                        evitados.</li>
                                    <li>Proyección del retorno de inversión (ROI) del programa.</li>
                                </ul>
                                <p class="leadish mt-2 fw-bold">
                                    Indicadores de eficiencia operativa del programa:</p>
                                <ul class="leadish">
                                    <li>Porcentaje de adherencia al plan de atención.</li>
                                    <li>Tiempo promedio entre ingreso y resolución clínica
                                        (farmacológica o quirúrgica).</li>
                                    <li>Porcentaje de pacientes con seguimiento activo a 6 y 12
                                        meses.</li>
                                </ul>
                                <p class="leadish mt-2 fw-bold">
                                    Impacto en carga de enfermedad del territorio:</p>
                                <ul class="leadish">
                                    <li>Disminución en prevalencia de obesidad grado III y
                                        enfermedades asociadas.</li>
                                    <li>AVAD evitados y ganancia en años de vida saludable.</li>
                                </ul>
                                <div class="q-title d-flex justify-content-center align-items-center gap-5">
                                    <span class="q-number">5.</span>
                                    <div class=" fw-bold q-subtitle">Es cierto que hablamos de obesidad, pero ¿por <br />
                                        qué aún sentimos que hay tantas barreras,<br />
                                        especialmente en eI régimen subsidiado, si se<br />
                                        cuenta con programas bien estructurados?<br />
                                        ¿Qué estrategias tenemos frente a esto?</div>
                                </div>
                                <ul class="leadish">
                                    <li class="fw-bold">Las barreras persisten por:</li>
                                    <ul class="leadish">
                                        <li>Subfinanciación de la atención primaria y especializada.</li>
                                        <li>Fragmentación de servicios y débil articulación territorial.</li>
                                        <li>Baja priorización de la obesidad como enfermedad.</li>
                                        <li>Carga social asociada al paciente con obesidad.</li>
                                    </ul>
                                    <li class="fw-bold">Desde el HUV, enfrentamos esto con:</li>
                                    <ul class="leadish">
                                        <li>Articulación de redes integradas con IPS de primer nivel.</li>
                                        <li>Formación continua a profesionales de la red para
                                            mejorar la remisión oportuna.</li>
                                        <li>Rutas ágiles de priorización para usuarios con
                                            comorbilidades.</li>
                                        <li>Fortalecimiento de alianzas con entes territoriales y
                                            or anizaciones comunitarias.</li>
                                    </ul>
                                </ul>
                                <div class="q-title d-flex justify-content-center align-items-center gap-5">
                                    <span class="q-number">6.</span>
                                    <div class=" fw-bold q-subtitle">Dra. Daniela, ¿ya tienen experiencia o han<br />
                                        pensado en estructurar una ruta para el<br />
                                        abordaje de la población infantil?</div>
                                </div>
                                <ul class="leadish">
                                    <li>Sí. Aunque el programa del HUV ha tenido enfoque en
                                        población adulta, dada la necesidad y el aumento de la
                                        incidencia de obesidad en los niños y adolescentes, hemos
                                        avanzado en la estructuración de una línea de intervención
                                        pediátrica, ya gestionamos la ruta de atención, algoritmos
                                        de atención y guía de práctica clínicas</li>
                                    <li>Actualmente, tenemos como plan desarrollar las siguientes
                                        actividades:</li>
                                    <ul class="leadish">
                                        <li>Evaluación multidisciplinaria adaptada a la edad.
                                            (16 años en delante, como etapa inicial).</li>
                                        <li>Involucramiento de cuidadores y entorno escolar.</li>
                                        <li>Educación nutricional y emocional para padres e hijos.</li>
                                        <li>Articulación con servicios de pediatría, endocrinología,
                                            nutrición sicolo ía infantil.</li>
                                    </ul>
                                </ul>
                                <div class="q-title d-flex justify-content-center align-items-center gap-5">
                                    <span class="q-number">7.</span>
                                    <div class=" fw-bold q-subtitle">¿Qué estrategias considera más efectivas para<br />
                                        educar a la población sobre la obesidad desde<br />
                                        la atención primaria?</div>
                                </div>
                                <p class="leadish mt-2">
                                    Las más efectivas han sido:</p>
                                <ol class="leadish">
                                    <li><strong>Formación continua al equipo de salud del primer nivel:</strong><br />
                                        Capacitar a médicos, enfermeros, nutricionistas y
                                        promotores de salud en el enfoque de la obesidad como
                                        enfermedad crónica, eliminando prejuicios y promoviendo el
                                        uso de guías clínicas actualizadas con lenguaje centrado en
                                        el paciente.</li>
                                    <li><strong>Identificación y tamizaje oportuno en el territorio:</strong><br />
                                        Implementar herramientas de tamizaje comunitario y
                                        escolar que permitan detectar tempranamente el exceso de
                                        peso, riesgos metabólicos y factores psicosociales,
                                        vinculando al paciente a rutas integrales desde etapas
                                        iniciales.</li>
                                    <li><strong>Educación comunitaria con enfoque cultural y familiar:</strong><br />
                                        Desarrollar actividades educativas en entornos naturales del
                                        paciente (escuelas, barrios, lugares de trabajo), usando un
                                        lenguaje cercano, adaptado al contexto cultural, y
                                        promoviendo la participación activa de la familia como
                                        agente protector.</li>
                                    <li><strong>Uso de tecnologías y canales digitales:</strong> Fortalecer eI acceso
                                        a contenidos educativos a través de redes sociales,
                                        plataformas móviles y mensajes SMS, con información
                                        verificada sobre hábitos saludables, riesgos de la obesidad y
                                        mitos comunes.</li>
                                    <li><strong>Articulación con sectores educativos, sociales y laborales:</strong>
                                        nvolucrar instituciones educativas, centros comunitarios y
                                        mpresas para promover entornos saludables, incluyendo
                                        limentación adecuada, actividad física y bienestar
                                        mocional como parte del día a día.</li>
                                    <li><strong>Testimonios y redes de apoyo entre pacientes:</strong>
                                        Fomentar espacios donde las personas con obesidad puedan
                                        compartir su experiencia y recibir acompañamiento
                                        psicoeducativo, 10 que reduce el estigma y aumenta la
                                        adherencia a procesos de cambio.</li>
                                </ol>
                            </div>
                        </div>
                    </article>

                </div>
            </div>

            <script>
                (function () {
                    var root = document.getElementById('<?php echo $ACC_ID; ?>');
                    if (!root) return;

                    var items = Array.prototype.slice.call(root.querySelectorAll('.accs-item'));

                    function abrir(item) {
                        // Cierra los demás
                        items.forEach(function (it) {
                            if (it !== item && it.classList.contains('abierto')) {
                                it.classList.remove('abierto');
                                var btnC = it.querySelector('.accs-header');
                                if (btnC) { btnC.setAttribute('aria-expanded', 'false'); }
                            }
                        });
                        // Abre el actual
                        item.classList.add('abierto');
                        var btn = item.querySelector('.accs-header');
                        if (btn) { btn.setAttribute('aria-expanded', 'true'); }
                    }

                    function toggle(item) {
                        if (item.classList.contains('abierto')) {
                            item.classList.remove('abierto');
                            var btn = item.querySelector('.accs-header');
                            if (btn) { btn.setAttribute('aria-expanded', 'false'); }
                        } else {
                            abrir(item);
                        }
                    }

                    items.forEach(function (item) {
                        var headerBtn = item.querySelector('.accs-header');
                        if (!headerBtn) return;
                        headerBtn.addEventListener('click', function () {
                            toggle(item);
                        });
                    });
                })();
            </script>
        <?php endif; ?>

    </div>

    <?php $codePromomats = get_field('description_complementary', $taxonomy) ?>

    <div class="container m-lg-5 mx-lg-auto m-3 px-0">
        <?php if (isset($codePromomats) && !empty($codePromomats)): ?>
            <h5 class="NotoSans-Bold title-color"><?= $codePromomats; ?></h5>
        <?php endif ?>
    </div>

<?php /* template con el contenido de las subcategoria de la categoria princiapl "Cursos de formación" term_id 5 */ ?>
<?php elseif (!empty($cuttentTaxonomyParentId) && $cuttentTaxonomyParentId == 5): ?>

    <div class="container third-background-taxonomy mt-lg-3 mt-3 p-5">
        <div class="container banner-taxonomy-academy" data-aos="zoom-in">
            <?php if (isset($bannerCategory) && !empty($bannerCategory)): ?>
                <img src="<?= esc_url(wp_get_attachment_url($bannerCategory)); ?>" alt="Herramientas"
                    class="bg-taxonomy-academy">
            <?php endif; ?>
            <div class="wrapper-taxonomy-academy"></div>
        </div>
        <div class="container mt-4">
            <div class="row m-0 p-0">
                <?php if (isset($subtitleCategory) && !empty($subtitleCategory)): ?>
                    <h2 class="NotoSans-Bold title-color text-uppercase d-none d-lg-block mx-0 p-0"><?= $subtitleCategory; ?>
                    </h2>
                    <h5 class="NotoSans-Bold title-color text-uppercase d-block d-lg-none mx-0 p-0"><?= $subtitleCategory; ?>
                    </h5>
                <?php endif ?>
                <?php if (isset($subDescriptioonCategory) && !empty($subDescriptioonCategory)): ?>
                    <h5 class="NotoSans-SemiBold description-color line-height-2 text-align-justify d-none d-lg-block mx-0 p-0">
                        <?= $subDescriptioonCategory; ?>
                    </h5>
                    <p class="NotoSans-SemiBold description-color line-height-2 text-align-justify d-block d-lg-none mx-0 p-0">
                        <?= $subDescriptioonCategory; ?>
                    </p>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-0">
        <div class="container mt-4 mx-lg-0 px-0 pb-4">
            <div class="row m-0 p-0">

                <?php
                $listPostAcademyCourse = new WP_Query(
                    [
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'academia',
                                'field' => 'id',
                                'terms' => $taxonomy->term_id,
                            )
                        ),
                        'orderby' => 'post_date',
                        'order' => 'ASC',
                        'posts_per_page' => -1,
                        'post_status' => 'publish'
                    ]
                );
                ?>

                <?php if (isset($listPostAcademyCourse) && !empty($listPostAcademyCourse)): ?>
                    <?php if ($listPostAcademyCourse->have_posts()): ?>
                        <?php while ($listPostAcademyCourse->have_posts()):
                            $listPostAcademyCourse->the_post() ?>




                            <?php $SubtitleModule = get_field('Subtitle_Module_Courses'); ?>
                            <?php $postActivityId = get_the_ID(); ?>

                            <h3 class="NotoSans-Bold title-color mt-5"><?= the_title() ?></h3>
                            <h2 class="NotoSans-Bold m-0 text-uppercase title-color"><?= $SubtitleModule; ?></h2>

                            <div class="col-12 mx-1" id="linea">
                                <hr>
                            </div>

                            <div class="container">

                                <?php $ifContentModuleCourse = get_field('If_Post_Content_Module_Courses'); ?>

                                <?php if (isset($ifContentModuleCourse) && !empty($ifContentModuleCourse)): ?>

                                    <?php $listContentModulesCourse = get_field('list_of_content_module_Courses'); ?>

                                    <?php if (isset($listContentModulesCourse) && !empty($listContentModulesCourse)): ?>

                                        <?php $counter = 0; ?>

                                        <?php foreach ($listContentModulesCourse as $listContentModule): ?>

                                            <?php $imageModuleAcademyCourse = $listContentModule['Img_Video_Mod']; ?>
                                            <?php $titleModuleAcademyCourse = $listContentModule['Title_Video_Mod']; ?>
                                            <?php $secondTitleModuleAcademyCourse = $listContentModule['Second_Title_Video_Mod']; ?>
                                            <?php $speakerModuleAcademyCourse = $listContentModule['Name_Speaker_Mod']; ?>
                                            <?php $typeContentModuleAcademyCourse = $listContentModule['Type_Content_Course']; ?>
                                            <?php $timeContentModuleAcademyCourse = $listContentModule['Time_Content_Course']; ?>
                                            <?php $descriptionModuleAcademyCourse = $listContentModule['Description_Module']; ?>
                                            <?php $urlModuleAcademyCourse = $listContentModule['URL_Video_Module']; ?>

                                            <a href="<?php echo get_permalink($postActivityId) . '?module_id=' . $postActivityId . '&content_id=' . $counter . '&tax=' . $taxonomy->term_id; ?>"
                                                onclick="saveLogsClick('Clic en `<?= the_title() ?>`, `<?= $SubtitleModule; ?>` `<?= isset($titleModuleAcademyCourse) ? $titleModuleAcademyCourse : '' ?><?= isset($secondTitleModuleAcademyCourse) ? ' - ' . $secondTitleModuleAcademyCourse : '' ?>`');"
                                                class="session-a">
                                                <div class="session-row mb-3">
                                                    <div class="<?= ($counter % 2 === 0) ? 'session-icon' : 'session-second-icon'; ?>">
                                                        <?php if (isset($imageModuleAcademyCourse) && !empty($imageModuleAcademyCourse)): ?>
                                                            <div class="image">
                                                                <?php echo wp_get_attachment_image($imageModuleAcademyCourse, 'full', '', ['class' => 'icon-card']); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (isset($titleModuleAcademyCourse) && !empty($titleModuleAcademyCourse)): ?>
                                                            <div class="NotoSans-Regular session-header text-uppercase"><?= $titleModuleAcademyCourse ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if (isset($secondTitleModuleAcademyCourse) && !empty($secondTitleModuleAcademyCourse)): ?>
                                                        <div class="session-content">
                                                            <div class="NotoSans-Regular session-header"><?= $secondTitleModuleAcademyCourse; ?></div>
                                                        </div>
                                                        <div class="session-second-content">
                                                            <?php if (isset($speakerModuleAcademyCourse) && !empty($speakerModuleAcademyCourse)): ?>
                                                                <div class="NotoSans-Bold doctor"><?= $speakerModuleAcademyCourse; ?></div>
                                                            <?php endif ?>
                                                            <?php if (isset($typeContentModuleAcademyCourse) && !empty($typeContentModuleAcademyCourse)): ?>
                                                                <div class="NotoSans-Regular session-subheader"><?= $typeContentModuleAcademyCourse; ?> |
                                                                    <?php if (isset($timeContentModuleAcademyCourse) && !empty($timeContentModuleAcademyCourse)): ?>
                                                                        <?= $timeContentModuleAcademyCourse; ?>
                                                                    <?php endif ?>
                                                                </div>
                                                            <?php endif ?>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="session-content">
                                                            <div class="NotoSans-Bold doctor"><?= $speakerModuleAcademyCourse; ?></div>
                                                            <div class="NotoSans-Regular session-subheader"><?= $typeContentModuleAcademyCourse; ?> |
                                                                <?= $timeContentModuleAcademyCourse; ?>
                                                            </div>
                                                        </div>
                                                        <div class="session-second-content-oth">
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </a>

                                            <?php $counter++; ?>

                                        <?php endforeach; ?>

                                    <?php endif; ?>

                                <?php endif; ?>

                            </div>

                        <?php endwhile; ?>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <?php $codePromomats = get_field('description_complementary', $taxonomy) ?>

    <div class="container m-lg-5 mx-lg-auto m-3 px-0">
        <?php if (isset($codePromomats) && !empty($codePromomats)): ?>
            <h5 class="NotoSans-Bold title-color"><?= $codePromomats; ?></h5>
        <?php endif ?>
    </div>

    <!-- <div class="container">
        <div class="row m-0 pt-5 pb-5 p-0 w-100 h-auto row-section">
            <div class="col-12 d-flex justify-content-center align-items-center container-toolbox">
                <main class="main white">
                    <div class="container">
                        <article class="conpes">
                            <div class="row justify-content-evenly justify-content-md-center">
                                <div class="container-not-found text-center p-5">
                                    <i class="fas fa-exclamation-circle text-white mt-5"></i>
                                    <h2 class="text-not-found text-white mb-5">Aún no hay contenido disponible para este curso.</h2>
                                </div>
                            </div>
                        </article>
                    </div>
                </main>
            </div>

        </div>
    </div> -->
<?php endif; ?>