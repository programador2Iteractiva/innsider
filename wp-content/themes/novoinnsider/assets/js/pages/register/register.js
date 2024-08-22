import $, { ajax } from 'jquery';
import Swiper from "swiper/bundle";
import "bootstrap";
import Swal from "sweetalert2";


export function saveClickImput(institutionName) {
    // Asignar el valor del li al input
    document.getElementById("institution").value = institutionName;

    // Ocultar la lista
    let list = document.getElementById("lista");
    list.style.display = 'none';


    let selectInstitution = document.getElementById("institution").value;

    if(selectInstitution.trim() === ''){
        const updateOtherInstitution = document.getElementById('input13');

        updateOtherInstitution.classList.add("d-none");

        const idOtherInstitution = document.getElementById('other_institution');

        idOtherInstitution.removeAttribute("required");
    }

    if(selectInstitution == 'Otro'){
        const updateOtherInstitution = document.getElementById('input13');

        updateOtherInstitution.classList.remove("d-none");
        updateOtherInstitution.classList.add("d-block");

        const idOtherInstitution = document.getElementById('other_institution');

        idOtherInstitution.setAttribute("required", "required");

    }else{

        const updateOtherInstitution = document.getElementById('input13');

        updateOtherInstitution.classList.add("d-none");

        const idOtherInstitution = document.getElementById('other_institution');

        idOtherInstitution.removeAttribute("required");
    }

}


export function saveClickCities(citiesName) {
    // Asignar el valor del li al input
    document.getElementById("city").value = citiesName;

    // Ocultar la lista
    let listCity = document.getElementById("listCity");
    listCity.style.display = 'none';

    let selectCities = document.getElementById("city").value;

    if(selectCities.trim() === ''){

        listCity.style.display = 'none';

    }

}

document.addEventListener("DOMContentLoaded", function(){

    /* Call name user to object ajax */
    var nameUser = ajax_object.full_name;

    /* Call all Cookies */
    // function getAllCookies() {
    //     let cookies = document.cookie.split('; ');
    //     let cookieObj = {};
    //     cookies.forEach(cookie => {
    //         let [key, value] = cookie.split('=');
    //         cookieObj[key] = value;
    //     });
    //     return cookieObj;
    // }

    // let allCookies = getAllCookies();
    // console.log('Todas las cookies:', allCookies);

    /* validate the existence of the cookie */
    function getCookie(name) {
        let value = `; ${document.cookie}`;
        let parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    /* create the cookie */
    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); // Time in milliseconds
            expires = "; expires=" + date.toUTCString();
        }
        // Sets the cookie with the name, value and options (expiry and path)
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    /* delete the cookie */
    function deleteCookie(name) {
        // Sets the cookie with the expiration date in the past
        document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
    }

    let alertShown = getCookie('alertShown');

    if(nameUser) {

        if (alertShown === null || alertShown === "false") {
            Swal.fire({
                html: '<h1><span class="Apis-Bold" style="color: #001965;">Bienvenido ' + nameUser + ',</span></h1>'+
                '<p>esto es lo último en Innsider para usted.</p>',
                imageUrl: 'https://upload.wikimedia.org/wikipedia/en/thumb/b/b1/Novo_Nordisk_-_Logo.svg/1200px-Novo_Nordisk_-_Logo.svg.png', // URL de la imagen
                imageWidth: 100,
                imageHeight: 83,
                imageAlt: 'Descripción de la imagen',
                showCloseButton: true,
                showConfirmButton: true,
                showCancelButton: false,
                customClass: {
                    popup: "swal-style-login",
                    confirmButton: 'swal-custom-button'
                },
                width: '595px',
                confirmButtonText: "Continuar",
                color: "#000000",
            });
    
            setCookie("alertShown", "true");
        }
    }else{
        deleteCookie('alertShown');
    }

    var numberDocument = document.getElementById('document');
    var confirmDocument = document.getElementById('confirm-document');

    function handleDocumentValidation()
    {
        if(numberDocument.value !== confirmDocument.value){
            numberDocument.style.border = '2px solid red';
            confirmDocument.style.border = '2px solid red';
        }else{
            numberDocument.style.border = '2px solid green';
            confirmDocument.style.border = '2px solid green';
        }
    }

    document.querySelectorAll('#form-register input').forEach(function(input){
        input.addEventListener('keyup', handleDocumentValidation);
    });


    /* Code that identifies the value of cities to country */

    document.getElementById("city").addEventListener("keyup", handleCountryValue)

    function handleCountryValue()
    {

        let citySelect = document.getElementById("city").value;
        let countrySelect = document.getElementById("country").value;
        let listCity = document.getElementById("listCity");

        console.log(citySelect);

        if(citySelect.trim() === ''){

            listCity.style.display = 'none'

        }


        if (citySelect.length > 0) {

            var dataFetch = new FormData();

            dataFetch.append('action', 'get_cities');
            dataFetch.append('cities', citySelect);
            dataFetch.append('countryValue', countrySelect);
            dataFetch.append('nonce', ajax_object.ajax_nonce);
    
            fetch(ajax_object.ajax_url, {
                method: 'POST',
                body: dataFetch
            }).then(response => response.json())
            .then(data => {
                listCity.style.display = 'block'
                listCity.innerHTML = data
            })
            .catch(err => console.log('Fetch error:', err));
        } else {
            listCity.style.display = 'none'
        }
    }


    /* Code open PopUp with content to terms and conditions and data treatment */

    var checkTerms = document.getElementById('check_terms');
    var dataTreatment = document.getElementById('dataTreatment');


    checkTerms.addEventListener('click', function(){
        let titleCheckTerms = 'Términos y condiciones';
        let firstTextCheckTerms = 'Autorización para el tratamiento de datos personales a Novo Nordisk Colombia S.A.S.';
        let secondTextCheckTerms = 'Autorizo de manera voluntaria, previa, explicita, informada e inequívoca a Novo Nordisk Colombia S.A.S. (en adelante ‘Novo’), identificada con NIT No. 900.557.875-3, al tratamiento de mis datos personales, que incluye los derechos que a los titulares les asisten y la manera de ejercerlos, y cuya política puede ser consultada en www.novonordisk.com.co';
        let urlTerms = 'https://innsider.interactiva.net.co/terminos-y-condiciones';

        Swal.fire({
            title: titleCheckTerms,
            html:
            '<div style="text-align: start;">' +
            '<p>'+ firstTextCheckTerms +'</p>' +
            '<p>'+ secondTextCheckTerms +'</p>' +
            '<br>'+
            '<a href='+ urlTerms +' target="_blank" class="d-flex justify-content-center">Haga clic aquí para leer todos los términos y condiciones.</a>'+
            '</div>',
            showConfirmButton: true,
            showCancelButton: false,
            width: '800px',
            customClass: {
                popup: "swal-styles"
            },
            confirmButtonText: "Acepto",
            confirmButtonColor: "#3085d6",
            color: "#000000",
        });
    })

    dataTreatment.addEventListener('click', function(){
        let titleDataTreatment = 'Aviso de Privacidad';
        let firstTextDataTreatment = 'El sitio web de iNNsider dentro de su política de privacidad Recopila información que puede ayudarnos a mejorar nuestro sitio web. Le pedimos su consentimiento para recopilar esta información cuando entra en el sitio web. Toda la información recopilada automáticamente en su consentimiento se almacena en forma agregada y no se puede utilizar para identificarlo como un individuo específico.';
        let urlDataTreatment = 'https://innsider.interactiva.net.co/politica-de-privacidad';

        Swal.fire({
            title: titleDataTreatment,
            html:
            '<div style="text-align: start;">' +
            '<p>'+ firstTextDataTreatment +'</p>' +
            '<br>'+
            '<a href='+ urlDataTreatment +' target="_blank" class="d-flex justify-content-center">Haga clic aquí para leer todos los términos del aviso de privacidad.</a>'+
            '</div>',
            showConfirmButton: true,
            showCancelButton: false,
            width: '800px',
            customClass: {
                popup: "swal-styles"
            },
            confirmButtonText: "Acepto",
            confirmButtonColor: "#3085d6",
            color: "#000000",
        });
    })


    /* Code to realice process institutions */

    document.getElementById("institution").addEventListener("keyup", getListInstitutions)

    function getListInstitutions() {

        let inputInstitution = document.getElementById("institution").value
        let list = document.getElementById("lista")

        console.log(inputInstitution);

        if(inputInstitution.trim() === ''){
    
            const updateOtherInstitution = document.getElementById('input13');
    
            updateOtherInstitution.classList.add("d-none");

            const idOtherInstitution = document.getElementById('other_institution');
    
            idOtherInstitution.removeAttribute("required");

            list.style.display = 'none'

        }
    
        if (inputInstitution.length > 0) {

            var dataInstitutionsFetch = new FormData();

            dataInstitutionsFetch.append('action', 'get_institutions');
            dataInstitutionsFetch.append('institution', inputInstitution);
            dataInstitutionsFetch.append('nonce', ajax_object.ajax_nonce);
    
            fetch(ajax_object.ajax_url, {
                method: 'POST',
                body: dataInstitutionsFetch
            }).then(response => response.json())
            .then(data => {
                list.style.display = 'block'
                list.innerHTML = data
            })
            .catch(err => console.log('Fetch error:', err));
        } else {
            list.style.display = 'none'
        }

    }
    

    // var inputElement = document.querySelector('input[name="institution"]');

    // inputElement.addEventListener('keyup', function(){
    //     var institution = inputElement.value;

    //     console.log(institution);

    //     var dataInstitutionsFetch = new FormData();

    //     dataInstitutionsFetch.append('action', 'get_institutions');
    //     dataInstitutionsFetch.append('institution', institution);
    //     dataInstitutionsFetch.append('nonce', ajax_object.ajax_nonce);

    //     fetch(ajax_object.ajax_url, {
    //         method: 'POST',
    //         body: dataInstitutionsFetch
    //     })
    //     .then(function(response) {
    //         if (!response.ok) {
    //             throw new Error('Network response was not ok');
    //         }
    //         return response.text(); // Convertir la respuesta a texto
    //     })
    //     .then(function(response) {

    //         const res = response.slice(0, -1);
    //         document.getElementById('city').innerHTML = res;
    //     })
    //     .catch(function(error) {
    //         console.error('Error en la solicitud fetch:', error);
    //     });
    // })


    /* Code to capture registration form information and create the registration */

    var form = document.getElementById('form-register');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        var data = new FormData();
        data.append('action', 'create_user');
        data.append('nonce', ajax_object.ajax_nonce);
        data.append('name', document.getElementById('name').value);
        data.append('lastName', document.getElementById('last_name').value);
        data.append('document', document.getElementById('document').value);
        data.append('confirmDocument', document.getElementById('confirm-document').value);
        data.append('email', document.getElementById('email-r').value);
        data.append('phone', document.getElementById('phone').value);
        data.append('speciality', document.getElementById('speciality').value);
        data.append('institution', document.getElementById('institution').value);
        data.append('positionInstitution', document.getElementById('position_institution').value);
        data.append('country', document.getElementById('country').value);
        data.append('city', document.getElementById('city').value);
        data.append('checkTerms', document.getElementById('check_terms').value);
        data.append('dataTreatment', document.getElementById('dataTreatment').value);
       

        fetch(ajax_object.ajax_url, {
            method: 'POST',
            body: data
        })
        .then(function(response){
            // Convertir la respuesta a JSON
            if (!response.ok) {
                response.message;
            }
            return response.json(); // Convertir la respuesta a JSON
        })
        .then(function(data){
            // Manejar la respuesta del servidor

            if (data.success === false) {
                // Mostrar mensaje de error al usuario
                Swal.fire({
                    icon: "error",
                    title: data.data.message,
                    showConfirmButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Actualizar",
                });
                return; // Detener la ejecución adicional si hay un error
            }else{
                Swal.fire({
                    icon: "success",
                    title: data.message,
                    showConfirmButton: false,
                    showCancelButton: false,
                    timer: 2000,
                });

                const bg = document.querySelector('.bg-alert');

                console.log(data);


                var dataRegister = new FormData();
                dataRegister.append('action', 'login_after_register');
                dataRegister.append('email', document.getElementById('email-r').value);
                dataRegister.append('document', document.getElementById('document').value);
                dataRegister.append('nonce', ajax_object.ajax_nonce);
        
                fetch(ajax_object.ajax_url, {
                    method: 'POST',
                    body: dataRegister
                })
                .then(function(response) {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');  
                    }
                    return response.json();
                })
                .then(function(dataRegister) {
        
                    if ( dataRegister.status === 1 ) {
                        location.reload();
                    }

                })
                .catch(function(error) {
                    console.error('Error en la solicitud fetch:', error);
                });

            }

        })
        .catch(function(error){
            console.error('Error', error);
        })
        
    })    

})