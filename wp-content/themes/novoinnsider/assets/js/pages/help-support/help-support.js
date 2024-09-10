document.addEventListener("DOMContentLoaded", function(){

    /* Code to capture registration form information and create the registration */

    var form = document.getElementById('form-support');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        var dataSuppor = new FormData();
        dataSuppor.append('action', 'data_support');
        dataSuppor.append('nonce', ajax_object.ajax_nonce);
        dataSuppor.append('name', document.getElementById('name').value);
        dataSuppor.append('lastName', document.getElementById('last_name').value);
        dataSuppor.append('email', document.getElementById('email').value);
        dataSuppor.append('phone', document.getElementById('phone').value);
        dataSuppor.append('description', document.getElementById('description').value);

        fetch(ajax_object.ajax_url, {
            method: 'POST',
            body: dataSuppor
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
            }

            location.reload();

        })
        .catch(function(error){
            console.error('Error', error);
        })
        
    })    

})