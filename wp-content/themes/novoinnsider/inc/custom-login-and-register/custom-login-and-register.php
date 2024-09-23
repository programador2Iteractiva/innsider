<?php 
/**
 * Function to create new user in novo-innsider
*/

function novo_inssider_create_user()
{

    check_ajax_referer('ajax_check', 'nonce');

    $name = sanitize_text_field($_POST['name']);
    $lastName = sanitize_text_field($_POST['lastName']);
    $document = sanitize_text_field($_POST['document']);
    $confirmDocument = sanitize_text_field($_POST['confirmDocument']);
    $email = sanitize_text_field($_POST['email']);
    $username = sanitize_user(explode('@', $email)[0] . substr(md5(microtime()), 0, 4));

    if ($document !== $confirmDocument) {
        wp_send_json_error(['message' => 'Los campos de documento de identidad no coinciden'], 404);
    }

    if(email_exists($email)){
        wp_send_json_error(['message' => 'El correo ingresado ya esta en uso'], 404);
    }

    $dataUser = wp_insert_user(
        array(
            'user_pass' => $document,
            'user_email' => $email,
            'user_login' => $username,
            'first_name' => $name,
            'last_name' => $lastName
        )
    );

    if (is_wp_error($dataUser)) {
        wp_send_json_error(['message' => 'Error al crear el usuario, inténtalo de nuevo'], 404);
    }

    add_user_meta($dataUser, 'document_number', $document);

    $phone = sanitize_text_field($_POST['phone']);
    add_user_meta($dataUser, 'phone', $phone);

    $speciality = sanitize_text_field($_POST['speciality']);
    add_user_meta($dataUser, 'speciality', $speciality);

    $institution = sanitize_text_field($_POST['institution']);
    add_user_meta($dataUser, 'institution', $institution);

    $otherInstitution = sanitize_text_field($_POST['other_institution']);
    if(isset($otherInstitution) && !empty($otherInstitution)){
        add_user_meta($dataUser, 'other_institution', $otherInstitution);
    }
    
    $positionInstitution = sanitize_text_field($_POST['positionInstitution']);
    add_user_meta($dataUser, 'positionInstitution', $positionInstitution);

    $country = sanitize_text_field($_POST['country']);
    add_user_meta($dataUser, 'country', $country);

    $city = sanitize_text_field($_POST['city']);
    add_user_meta($dataUser, 'city', $city);

    $checkTerms = sanitize_text_field($_POST['checkTerms']);
    add_user_meta($dataUser, 'checkTerms', $checkTerms);

    $dataTreatment = sanitize_text_field($_POST['dataTreatment']);
    add_user_meta($dataUser, 'dataTreatment', $dataTreatment);

    wp_send_json(['message' => "Registro exitoso Dr(a). {$lastName}."]);

}

add_action('wp_ajax_nopriv_create_user', 'novo_inssider_create_user');
add_action('wp_ajax_create_user', 'novo_inssider_create_user');


/**
 * Function login after register
 */
function novo_inssider_login_after_register()
{
    check_ajax_referer('ajax_check', 'nonce');

    $document_number = sanitize_text_field($_POST['document']);
    $email = sanitize_email($_POST['email']);

    global $wpdb;

    $table_users    = $wpdb->prefix . 'users';
    $table_usermeta = $wpdb->prefix . 'usermeta';

    $validate_user = $wpdb->prepare(
        "SELECT
            u.ID,
            u.user_email,
            um_first_name.meta_value AS first_name,
            um_last_name.meta_value AS last_name,
            um_document_number.meta_value AS document_number,
            um_phone.meta_value AS phone,
            um_institution.meta_value AS institution,
            um_speciality.meta_value AS speciality,
            um_positionInstitution.meta_value AS position_institution,
            u.user_registered
        FROM {$table_users} u
        LEFT JOIN {$table_usermeta} um_first_name ON u.ID = um_first_name.user_id AND um_first_name.meta_key = 'first_name'
        LEFT JOIN {$table_usermeta} um_last_name ON u.ID = um_last_name.user_id AND um_last_name.meta_key = 'last_name'
        LEFT JOIN {$table_usermeta} um_document_number ON u.ID = um_document_number.user_id AND um_document_number.meta_key = 'document_number'
        LEFT JOIN {$table_usermeta} um_phone ON u.ID = um_phone.user_id AND um_phone.meta_key = 'phone'
        LEFT JOIN {$table_usermeta} um_institution ON u.ID = um_institution.user_id AND um_institution.meta_key = 'institution'
        LEFT JOIN {$table_usermeta} um_speciality ON u.ID = um_speciality.user_id AND um_speciality.meta_key = 'speciality'
        LEFT JOIN {$table_usermeta} um_positionInstitution ON u.ID = um_positionInstitution.user_id AND um_positionInstitution.meta_key = 'position_institution'
        WHERE um_document_number.meta_value = %s AND u.user_email = %s;",
        $document_number,
        $email
    );

    $results = $wpdb->get_results($validate_user);

    if ( count( $results ) > 0 ) {

        $user_document      = $results[0]->document_number;
        $user_email         = $results[0]->user_email;

        // Datos de inicio de sesión
        $usuario = $user_email;
        $contrasena = $user_document;

        // Arreglo de argumentos para iniciar sesión
        $credenciales = array(
            'user_login'    => $usuario,
            'user_password' => $contrasena,
            'remember'      => true // Opcional: para mantener la sesión iniciada
        );

        // Intentar iniciar sesión
        $usuario = wp_signon($credenciales, false);

        $user_data = [
            'status' => 1,
            'message' => 'Usuario con logeo'
        ];

        return wp_send_json( $user_data );

    }
    else {
        $user_data = [
            'status' => 0,
            'message' => 'Usuario no existe'
        ];

        return wp_send_json( $user_data );
    }

}

add_action('wp_ajax_nopriv_login_after_register', 'novo_inssider_login_after_register');
add_action('wp_ajax_login_after_register', 'novo_inssider_login_after_register');



/**
 * Function Login Page
 *
 * @param $login_url
 * @param $redirect
 * @param $force_reauth
 *
 * @return mixed
 */
function novo_inssider_login_page($login_url, $redirect, $force_reauth)
{
    $encoded_redirect = urlencode($redirect);

    return home_url('/login/?redirect_to=' . $encoded_redirect);
}

add_filter('login_url', 'novo_inssider_login_page', 10, 3);

/**
 * Function return Login Page ID
 */
function novo_inssider_login_page_id()
{
    global $wpdb;
    $login_page_id = "";
    $result = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "posts WHERE post_type = 'page' AND post_name = 'login'");

    foreach ($result as $page) {
        $login_page_id = $page->ID;
    }

    return $login_page_id;
}

/**
 * Function Name: front_end_login_fail.
 * Description: This redirects the failed login to the custom login page instead of default login page with a modified url
 **/
add_action('wp_login_failed', 'front_end_login_fail');
function front_end_login_fail($username)
{
// Getting URL of the login page
    $referrer = $_SERVER['HTTP_REFERER'];
// if there's a valid referrer, and it's not the default log-in screen
    if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
        wp_redirect(get_permalink(novo_inssider_login_page_id()) . "?login=failed");
        exit;
    }
}

/**
 * Function Name: check_username_password.
 * Description: This redirects to the custom login page if user name or password is   empty with a modified url
 **/
add_action('authenticate', 'check_username_password', 1, 3);
function check_username_password($login, $username, $password)
{
// Getting URL of the login page

if (isset($_SERVER['HTTP_REFERER'])) {
    $referrer = $_SERVER['HTTP_REFERER'];
}

// if there's a valid referrer, and it's not the default log-in screen
    if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
        if ($username == "" || $password == "") {
            wp_redirect(get_permalink(novo_inssider_login_page_id()) . "?login=empty");
            exit;
        }
    }
}

// Restrict back-end for administrators only
function novo_inssider_restrict_admin_area_by_rol() {
    if ( ! current_user_can( 'manage_options' ) && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
        wp_redirect( site_url() );
        exit;
    }
}
add_action( 'admin_init', 'novo_inssider_restrict_admin_area_by_rol', 1 );

function novo_inssider_hide_admin_bar($content)
{
//    return ( current_user_can('manage_options') ) ? $content : false;
    return false;
}

add_filter('show_admin_bar', 'novo_inssider_hide_admin_bar');

/**
 * Function get list specialities
*/
function novo_inssider_get_specialities()
{
    global $wpdb;

    $specialities = $wpdb->get_results('select name_speciality from wp_speciality order by name_speciality ASC');

    return $specialities;
}

/**
 * Function get list position_institution
*/
function novo_inssider_get_position_institution()
{
    global $wpdb;

    $positionInstitution = $wpdb->get_results('select name_pos_institution from wp_position_institution order by name_pos_institution ASC');

    return $positionInstitution;
}



/**
 * Function get list institutions
 */
function novo_inssider_get_institutions()
{

    check_ajax_referer('ajax_check', 'nonce');

    global $wpdb;

    $inputInstitution = isset($_POST['institution']) ? sanitize_text_field($_POST['institution']) : '';

    $institutions = $wpdb->prepare(
        "SELECT institution_name FROM wp_institutions WHERE institution_name LIKE %s ORDER BY institution_name ASC LIMIT 10",
        $inputInstitution . '%'
    );

    $results = $wpdb->get_results($institutions, ARRAY_A);

    // Generar el HTML de respuesta
    $html = "";
    if (!empty($results)) {
        foreach ($results as $row) {
            $html .= "<li onclick=\"saveClickImput('" . esc_js($row["institution_name"]) . "')\">" . esc_html($row["institution_name"]) . "</li>";
        }
    }

    echo json_encode($html, JSON_UNESCAPED_UNICODE);
    // Finalizar el script
    wp_die();
    
}

add_action('wp_ajax_nopriv_get_institutions', 'novo_inssider_get_institutions');
add_action('wp_ajax_get_institutions', 'novo_inssider_get_institutions');

/**
 * Function get list countries
*/

function novo_inssider_get_countries()
{
    global $wpdb;

    $countries = $wpdb->get_results('select * from wp_country order by name_country');

    return $countries;
}


/**
 * Function get list cities
*/

function novo_innsider_get_cities()
{

    // check_ajax_referer('ajax_check', 'nonce');

    // global $wpdb;

    // $code_country = $_POST['codeCountry'];


    // $cities = $wpdb->get_results("select name_city from wp_city where code_country = '{$code_country}' order by name_city asc");

    // $html = "<select class='form-select' name='city' id='city' required>";
    // foreach ($cities as $city) {

    //     $html = $html . "<option value='$city->name_city'>$city->name_city</option>";
    // }

    // echo $html . "</select>";


    check_ajax_referer('ajax_check', 'nonce');

    global $wpdb;

    $codeCities = isset($_POST['cities']) ? sanitize_text_field($_POST['cities']) : '';
    $codeCountry = isset($_POST['countryValue']) ? sanitize_text_field($_POST['countryValue']) : '';

    $cities = $wpdb->prepare(
        "SELECT name_city FROM wp_city WHERE code_country = %s AND name_city LIKE %s ORDER BY name_city ASC LIMIT 5",
        $codeCountry, 
        $codeCities . '%'
    );

    $results = $wpdb->get_results($cities, ARRAY_A);

    // Generar el HTML de respuesta
    $html = "";
    if (!empty($results)) {
        foreach ($results as $city) {
            $html .= "<li onclick=\"saveClickCities('" . esc_js($city["name_city"]) . "')\">" . esc_html($city["name_city"]) . "</li>";
        }
    }

    echo json_encode($html, JSON_UNESCAPED_UNICODE);
    // Finalizar el script
    wp_die();

}

add_action('wp_ajax_nopriv_get_cities', 'novo_innsider_get_cities');
add_action('wp_ajax_get_cities', 'novo_innsider_get_cities');


/**
 * Function to create user coNNexo in novo-innsider
*/

function novo_inssider_create_user_connexo($dat = null)
{

    $name = $dat['name'];
    $lastName = $dat['lastName'];
    $document = $dat['document'];
    $email = $dat['email'];
    $username = sanitize_user(explode('@', $dat['name'])[0] . substr(md5(microtime()), 0, 4));

    if(email_exists($email)){
        wp_send_json_error(['message' => 'El correo ingresado ya esta en uso'], 404);
    }

    $dataUser = wp_insert_user(
        array(
            'user_pass' => $document,
            'user_email' => $email,
            'user_login' => $username,
            'first_name' => $name,
            'last_name' => $lastName
        )
    );

    if (is_wp_error($dataUser)) {
        wp_send_json_error(['message' => 'Error al crear el usuario, inténtalo de nuevo','message' => $dataUser], 404);
    }

    add_user_meta($dataUser, 'document_number', $document);

    $phone = sanitize_text_field($dat['phone']);
    add_user_meta($dataUser, 'phone', $phone);

    $speciality = sanitize_text_field($dat['speciality']);
    add_user_meta($dataUser, 'speciality', $speciality);

    $institution = sanitize_text_field($dat['institution']);
    add_user_meta($dataUser, 'institution', $institution);

    $otherInstitution = sanitize_text_field($dat['other_institution']);
    if(isset($otherInstitution) && !empty($otherInstitution)){
        add_user_meta($dataUser, 'other_institution', $otherInstitution);
    }
    
    $positionInstitution = sanitize_text_field($dat['positionInstitution']);
    add_user_meta($dataUser, 'positionInstitution', $positionInstitution);

    $country = sanitize_text_field($dat['country']);
    add_user_meta($dataUser, 'country', $country);

    $city = sanitize_text_field($dat['city']);
    add_user_meta($dataUser, 'city', $city);

    $checkTerms = sanitize_text_field($dat['checkTerms']);
    add_user_meta($dataUser, 'checkTerms', $checkTerms);

    $dataTreatment = sanitize_text_field($dat['dataTreatment']);
    add_user_meta($dataUser, 'dataTreatment', $dataTreatment);

}

add_action('wp_ajax_nopriv_create_user', 'novo_inssider_create_user');
add_action('wp_ajax_create_user', 'novo_inssider_create_user');


?>