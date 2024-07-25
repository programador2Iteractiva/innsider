import $, { ajax } from 'jquery';
import Swiper from "swiper/bundle";
import "bootstrap";
import Swal from "sweetalert2";

document.addEventListener("DOMContentLoaded", function(){

    /* Code validate input document with input confirmDocument */

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


    /* Code that identifies the value of country */

    var countrySelect = document.getElementById('country');

    function handleCountryValue()
    {
        if (countrySelect.value) {
            var dataFetch = new FormData();
            dataFetch.append('action', 'get_cities');
            dataFetch.append('codeCountry', countrySelect.value);
            dataFetch.append('nonce', ajax_object.ajax_nonce);
    
            fetch(ajax_object.ajax_url, {
                method: 'POST',
                body: dataFetch
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); // Convertir la respuesta a texto
            })
            .then(function(response) {
    
                const res = response.slice(0, -1);
                document.getElementById('city').innerHTML = res;
            })
            .catch(function(error) {
                console.error('Error en la solicitud fetch:', error);
            });
        }
    }

    // Agregar un evento de escucha para verificar cuando countrySelect tiene un valor
    countrySelect.addEventListener('change', handleCountryValue);

    // Llamar a handleCountryValue directamente para comprobar el valor inicial, si es necesario
    handleCountryValue();



    /* Code open PopUp with content to terms and conditions and data treatment */

    var checkTerms = document.getElementById('check_terms');
    var dataTreatment = document.getElementById('dataTreatment');


    checkTerms.addEventListener('click', function(){
        let titleCheckTerms = 'Términos y condiciones';
        let firstTextCheckTerms = 'Autorización para el tratamiento de datos personales a Novo Nordisk Colombia S.A.S.';
        let secondTextCheckTerms = 'Autorizo de manera voluntaria, previa, explicita, informada e inequívoca a Novo Nordisk Colombia S.A.S. (en adelante `Novo`), identificada con NIT No. 900.557.875-3, al tratamiento de mis datos personales, que incluye los derechos que a los titulares les asisten y la manera de ejercerlos, y cuya política puede ser consultada en www.novonordisk.com.co Acepto y entiendo que Novo, terceros contratistas o mandatarios encargados para tal fin actuarán como Responsables del Tratamiento de datos personales de los cuales soy Titular. ';
        let urlTerms = 'https://suacademiamedica.novonordisk.com.co/terminos-y-condiciones.html';

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
        let firstTextDataTreatment = 'El sitio web de la Academia Novo Nordisk (www.suacademiamedica.novonordisk.com.co) está diseñado para proporcionar información sobre nuestra empresa, productos y servicios. Este aviso legal se aplica únicamente a este sitio web y describe cómo y por qué recopilamos información sobre usted como usuario del sitio web. Este aviso de privacidad describe el modo en el que Novo Nordisk recopila, almacena y utiliza la información sobre las personas que visitan este sitio web.';
        let urlDataTreatment = 'https://suacademiamedica.novonordisk.com.co/Politica-de-privacidad.html';

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