<footer class="container">
    <div class="footer-content d-flex justify-content-lg-between justify-content-center align-items-center align-items-lg-start flex-lg-row flex-column">
        <div class="footer-section">
            <h3 class="mb-5 titlesFooter">NOVO NORDISK COLOMBIA S.A.S</h3>
            <p>Contáctenos</p>
            <p>Calle 125 N.° 19-24, Piso 6 Bogotá</p>
            <p>Teléfono: +57 60 1 3149999</p>
        </div>
        <div class="footer-section">
            <h3 class="mb-5 mt-5 mt-lg-0 titlesFooter">ENLACES ÚTILES</h3>
            <ul class="m-0 p-0">
                <li><a href="https://www.novonordisk.com.co/" target="_blank">Acerca de Novo Nordisk</a></li>
                <?php $page = get_page_by_path('terminos-y-condiciones'); ?>
                <?php if($page) : ?>
                    <?php $permalink = get_permalink($page->ID); ?>
                    <li><a href="<?php echo esc_url($permalink); ?>">Términos y condiciones</a></li>
                <?php endif ?>                
            </ul>
        </div>
        <!-- <div class="footer-section">
            <h3 class="mb-5 mt-5 mt-lg-0 titlesFooter">SÍGANOS</h3>
            <ul class="m-0 p-0">
                <li><a href="#">LinkedIn</a></li>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Instagram</a></li>
            </ul>
        </div> -->
        <div class="footer-section">
            <h3 class="mb-5 mt-5 mt-lg-0 titlesFooter">SOPORTE</h3>
            <?php $page = get_page_by_path('ayuda-y-soporte'); ?>
            <?php if($page) : ?>
                <?php $permalink = get_permalink($page->ID); ?>
                <a href="<?php echo esc_url($permalink); ?>">Ayuda y soporte</a>
            <?php endif ?>
        </div>
    </div>
    <div class="footer-bottom pt-5 pb-5 text-center">
        <?php $page = get_page_by_path('terminos-y-condiciones'); ?>
        <?php if($page) : ?>
            <?php $permalink = get_permalink($page->ID); ?>
            <a href="<?php echo esc_url($permalink); ?>" id="open-cookie-settings" class="secondtitleFooter">Términos y condiciones</a>
        <?php endif ?>
        <a href="#" class="secondtitleFooter cky-banner-element" id="open-cookie-settings">Política cookies</a>
        <?php if($page) : ?>
            <?php $permalink = get_permalink($page->ID); ?>
            <a href="<?php echo esc_url($permalink); ?>" class="secondtitleFooter">Política de privacidad</a>
        <?php endif ?>     
        <a href="#" class="secondtitleFooter">Cookie settings</a>
    </div>
    <div class="footer-bottom pt-5 pb-5 d-flex justify-content-center justify-content-center">
        <p class="text-center mx-2 mx-lg-0">En caso de reporte de eventos adversos relacionados con nuestros productos, contactarse con: colombia-safety@novonordisk.com</p>
    </div>
    <p class="text-center mx-3 mx-lg-0">&copy; Copyright 2024 - Novo Nordisk</p>
    <div class="footer-section">
        <p class="text-justify mx-3 mx-lg-0">
            La información contenida en esta plataforma es segmentada de acuerdo con el perfil profesional del usuario. Su distribución u otros usos se encuentran estrictamente prohibidos. Material revisado y aprobado por la Dirección Médica de Asuntos Regulatorios de Novo Nordisk Colombia S.A.S. NIT: 900.557.75-3. Derechos reservados 2024. CO24UMA00023
        </p>
    </div>
</footer>



</body>

</html>