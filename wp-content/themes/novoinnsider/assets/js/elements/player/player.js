import $ from 'jquery'
import Player from '@vimeo/player/dist/player'
import 'detect.js/detect.min'
import Velocity from 'velocity-animate'
import 'velocity-animate/velocity.ui'

var iframe;
var player;
var countVideos = 0;
var currentVideo = 0;
var countVideos = 0;
var nextControlVideo = 0;
var video_duration = 0;
var current_time = 0;
var new_postid = 0;
let urldata   = new URL(window.location.href);
let nowVideo = urldata.searchParams.get("now_video");

// FUNCTION DETECT DEVICE
export function getDevice() {
    const devicedetect = detect.parse(navigator.userAgent);
    const playervideo = document.querySelector('.preview-video');

    console.log(devicedetect.device);

    var isMobile = /iPhone|iPad|iPod|Android|webOS|Desktop/i.test(navigator.userAgent);

    return isMobile;
}
// END FUNCTION DETECT DEVICE

// FUNCTION DETECT BROWSER
export function getBrowser() {
    const playervideo = document.querySelector('.preview-video');
    var getBrowserInfo = function() {
        var ua= navigator.userAgent, tem,
            M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
        if(/trident/i.test(M[1])){
            tem=  /\brv[ :]+(\d+)/g.exec(ua) || [];
            return 'IE '+(tem[1] || '');
        }
        if(M[1]=== 'Chrome'){
            tem= ua.match(/\b(OPR|Edge)\/(\d+)/);
            if(tem!= null) return tem.slice(1).join(' ').replace('OPR', 'Opera');
        }
        M= M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
        if((tem= ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
        return M[0];

    };

    return getBrowserInfo();

}
// END FUNCTION DETECT BROWSER

$(function () {
    // CALCULO PROGRESO TOTAL DE VIDEOS
    countVideos = parseInt( $('.item-playlist-videos').length );

    console.log(countVideos)
    
    $('.item-playlist-videos').click(function () {

        $('.item-playlist-videos').removeClass('active-item-playlist-videos');
        $(this).addClass('active-item-playlist-videos');

        $('.name-info-video-speaker').empty();
        $('.text-info-video-speaker').empty();

        $('.name-info-video-speaker').append( $(this).children('.name-playlist-video').val() );
        $('.text-info-video-speaker').append( $(this).children('#description_video').val() );

    });


    document.querySelectorAll('.item-playlist-videos').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault();
    
            const container = this.closest('.card-single-post-podcast');
            const speakers = container.querySelectorAll('.name-speaker');
            const credentials = container.querySelectorAll('.credentials-speaker');
    
            const speakersData = [];
            const credentialsData = [];
    
            speakers.forEach(speaker => {
                const index = speaker.getAttribute('data-index');
                speakersData.push({
                    index: index,
                    name: speaker.value
                });
            });
    
            credentials.forEach(credential => {
                const index = credential.getAttribute('data-index');
                credentialsData.push({
                    index: index,
                    credentials: credential.value
                });
            });
    
            // Actualiza los datos en el acordeón
            speakersData.forEach(speaker => {
                const titleElement = document.querySelector(`.title-speaker-${speaker.index}`);
                if (titleElement) {
                    titleElement.textContent = speaker.name;
                }
            });
    
            credentialsData.forEach(credential => {
                const credentialElement = document.querySelector(`.credential-speaker-${credential.index}`);
                if (credentialElement) {
                    credentialElement.textContent = credential.credentials;
                }
            });
    
            console.log("Speakers Data:", speakersData);
            console.log("Credentials Data:", credentialsData);

            const containerButton = document.querySelector('.buttons');
            const containerTextShare = document.querySelector('.text-share');
            const contentShareSocialIcons = document.querySelector('.content-share-social-icons');
            
            const classBtnSocials = container.querySelectorAll('.class-btn-social');
            const svgBtnSocials = container.querySelectorAll('.svg-btn-social');
            const urlRedirectBtnSocials = container.querySelectorAll('.url-redirect-btn-social');


            const classBtnSocialData = [];
            const svgBtnSocialData = [];
            const urlRedirectBtnSocialData = [];


            classBtnSocials.forEach(classBtnSocial => {
                const index = classBtnSocial.getAttribute('data-index');
                classBtnSocialData.push({
                    index: index,
                    name: classBtnSocial.value
                });
            });
    
            svgBtnSocials.forEach(svgBtnSocial => {
                const index = svgBtnSocial.getAttribute('data-index');
                svgBtnSocialData.push({
                    index: index,
                    credentials: svgBtnSocial.value
                });
            });

            urlRedirectBtnSocials.forEach(urlRedirectBtnSocial => {
                const index = urlRedirectBtnSocial.getAttribute('data-index');
                urlRedirectBtnSocialData.push({
                    index: index,
                    name: urlRedirectBtnSocial.value
                })
            })

            console.log("Btn class:", classBtnSocialData);
            console.log("Svg :", svgBtnSocialData);
            console.log("url redirect", urlRedirectBtnSocialData);
        
            if (classBtnSocialData.length > 0 && svgBtnSocialData.length > 0 && urlRedirectBtnSocialData.length > 0) {

                // Limpiar el contenedor de botones y agregar el nuevo
                contentShareSocialIcons.innerHTML = ''; // Limpia el contenedor
            
                // Crear el h5 "Compartir" de nuevo
                const heading = document.createElement('h5');
                heading.className = 'me-4 NotoSans-Regular title-color text-share';
                heading.style.textDecoration = 'underline';
                heading.textContent = 'Compartir';
            
                // Agrega el h5 al contenedor
                contentShareSocialIcons.appendChild(heading); // Asegúrate de que esto esté antes del contenedor de botones
                console.log("H5 creado:", contentShareSocialIcons); // Para verificar
            

                // Crea el div con clase buttons 
                const containerButton = document.createElement('div');
                containerButton.className = 'buttons';

                contentShareSocialIcons.appendChild(containerButton);
            
                // Crea el botón main-button de nuevo
                const mainButton = document.createElement('button');
                mainButton.className = 'main-button';
                mainButton.style.color = 'white';
                mainButton.innerHTML = `
                    <svg width="30" height="30" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.75 5.125a3.125 3.125 0 1 1 .754 2.035l-8.397 3.9a3.124 3.124 0 0 1 0 1.88l8.397 3.9a3.125 3.125 0 1 1-.61 1.095l-8.397-3.9a3.125 3.125 0 1 1 0-4.07l8.397-3.9a3.125 3.125 0 0 1-.144-.94Z"></path>
                    </svg>
                `;
            
                containerButton.appendChild(mainButton); // Agrega el botón main-button al contenedor
            
                // Crea nuevos botones con la nueva información
                classBtnSocialData.forEach((classBtnSocial, index) => {
                    const button = document.createElement('button');
                    button.className = `button class-button-social-module-innsider-${index} ${classBtnSocial.name}`;
                    button.setAttribute('data-index', classBtnSocial.index);
            
                    const svgData = svgBtnSocialData.find(svg => svg.index === classBtnSocial.index) || { credentials: '' };
                    const urlData = urlRedirectBtnSocialData.find(url => url.index === classBtnSocial.index) || { name: '#' };
            
                    button.innerHTML = `
                        <a href="${urlData.name}" target="_blank" style="text-decoration: none; color: black;">
                            <span class="class-button-social-module-innsider-${index}">
                                ${svgData.credentials}
                            </span>
                        </a>
                    `;
            
                    containerButton.appendChild(button); // Agrega el botón al contenedor
                    console.log("Botón creado:", button); // Para verificar
                });
            
            } else {
                // Si no hay datos, limpia el contenedor
                containerButton.innerHTML = ''; // Limpia el contenedor
                containerTextShare.innerHTML = ''; // Limpia el contenedor
                console.log("No hay datos, el contenedor ha sido limpiado.");
            }
            
            
            
                        
        });
    });
    


    // Actualiza el estado activo del botón de conferencista
    $('.item-speaker').removeClass('active-item-speaker');
    $(this).addClass('active-item-speaker');

    // Obtiene los valores de los campos ocultos
    const speakerName = $(this).siblings().find('.name-speaker').val();
    const speakerCredentials = $(this).siblings().find('.credentials-speaker').val();

    // Actualiza la interfaz de usuario con los datos del conferencista
    $('.name-info-speaker').text(speakerName);
    $('.text-info-speaker').text(speakerCredentials);

    // Actualiza el ícono del botón
    const icon = $(this).find('i');
    if (icon.hasClass('fa-plus')) {
        icon.removeClass('fa-plus').addClass('fa-minus');
    } else {
        icon.removeClass('fa-minus').addClass('fa-plus');
    }

})

// FUNCTION PLAY VIDEO
export function playVideo( post_id, url, evt, classElement, next ) {

    $('.loading-waiting').fadeIn("slow");

    var deviceDetected = getDevice();

    var getBrowserInfo = getBrowser();

    if ( classElement == 'preview-video' ) {

        Velocity( $('.preview-video'), 'transition.slideLeftOut',
            {
                duration: 500,
                complete() {

                    var options = {
                        url: url,
                        playsInline: true,
                        autoplay: true
                    };

                    if ( deviceDetected ) {

                        var options = {
                            url: url,
                            playsInline: true,
                            autoplay: true,
                            muted: true
                        };

                    }

                    if ( getBrowserInfo === 'Safari' ) {

                        var options = {
                            url: url,
                            playsInline: true,
                            autoplay: true,
                            muted: true
                        };

                    }

                    var textLog = 'Play video '+$('.name-info-video-speaker').text();
                    saveLogsClick( textLog );

                    iframe = $('#player').attr('id');
                    // console.log(iframe);
                    player = new Player(iframe, options);
                    // console.log(player);
                    // console.log(options);

                    Velocity( $('.player-video'), 'transition.slideRightIn',
                        {
                            duration: 500,
                            complete() {
                                $('.loading-waiting').fadeOut("slow");
                                player.play().then(function () {
                                    player.ready().then(function () {
                                        player.getDuration().then(function(duration) {
                                            video_duration = parseInt( duration );

                                        });

                                        $('#post_id').val(post_id);
                                        eventsVideo(next, post_id);
                                    })
                                });
                                $('.preview-video').addClass('hide-preview');
                            }
                        }
                    )
                }
            }
        );

        return;
    }else if( classElement == 'item-playlist-videos' ) {
        if($('.preview-video').hasClass('hide-preview')){
            console.log('Entro a .preview-video con hide-preview');
                Velocity( $('.player-video'), 'transition.slideLeftOut',
                {
                    duration: 500,
                    complete() {
                        player.pause().then(function () {
                            player.getCurrentTime().then(function(seconds) {
                                current_time = parseInt( seconds );

                                player.destroy().then(function () {
                                    var options = {
                                        url: url,
                                        playsInline: true,
                                        autoplay: true
                                    };

                                    if ( deviceDetected ) {

                                        var options = {
                                            url: url,
                                            playsInline: true,
                                            autoplay: true,
                                            muted: true
                                        };

                                    }

                                    if ( getBrowserInfo === 'Safari' ) {

                                        var options = {
                                            url: url,
                                            playsInline: true,
                                            autoplay: true,
                                            muted: true
                                        };

                                    }

                                    iframe = $('#player').attr('id');
                                    player = new Player(iframe, options);
                                });
                            });
                        })

                        Velocity( $('.player-video'), 'transition.slideRightIn',
                            {
                                duration: 500,
                                complete() {
                                    $('.loading-waiting').fadeOut("slow");
                                    player.play().then(function () {
                                        player.ready().then(function () {
                                            player.getDuration().then(function(duration) {
                                                video_duration = parseInt( duration );

                                                var textLog = 'Play video '+$('.name-info-video-speaker').text();
                                                saveLogsClick( textLog );
                                            });

                                            $('#post_id').val(post_id);
                                            eventsVideo(next, post_id);
                                        })
                                    });
                                }
                            }
                        )
                    }
                }
            );

            return;

        }else {
            console.log('No Entra a .preview-video');
            Velocity( $('.preview-video'), 'transition.slideLeftOut',
                {
                    duration: 500,
                    complete() {
                        var options = {
                            url: url,
                            playsInline: true,
                            autoplay: true
                        };

                        if ( deviceDetected ) {

                            var options = {
                                url: url,
                                playsInline: true,
                                autoplay: true,
                                muted: true
                            };

                        }

                        if ( getBrowserInfo === 'Safari' ) {

                            var options = {
                                url: url,
                                playsInline: true,
                                autoplay: true,
                                muted: true
                            };

                        }

                        iframe = $('#player').attr('id');
                        player = new Player(iframe, options);

                        Velocity( $('.player-video'), 'transition.slideRightIn',
                            {
                                duration: 500,
                                complete() {
                                    $('.loading-waiting').fadeOut("slow");
                                    player.play().then(function () {
                                        player.ready().then(function () {
                                            player.getDuration().then(function(duration) {
                                                video_duration = parseInt( duration );
                                            });

                                            $('#post_id').val(post_id);
                                            eventsVideo(next, post_id);

                                            var textLog = 'Play video '+$('.name-info-video-speaker').text();
                                            saveLogsClick( textLog );
                                        })
                                    });
                                    $('.preview-video').addClass('hide-preview');
                                }
                            }
                        )
                    }
                }
            );

            return;
        }
        // Velocity( $('.preview-video'), 'transition.slideLeftOut',
        //     {
        //         duration: 500,
        //         complete() {

        //             var options = {
        //                 url: url,
        //                 playsInline: true,
        //                 autoplay: true
        //             };

        //             if ( deviceDetected ) {

        //                 var options = {
        //                     url: url,
        //                     playsInline: true,
        //                     autoplay: true,
        //                     muted: true
        //                 };

        //             }

        //             if ( getBrowserInfo === 'Safari' ) {

        //                 var options = {
        //                     url: url,
        //                     playsInline: true,
        //                     autoplay: true,
        //                     muted: true
        //                 };

        //             }

        //             var textLog = 'Play video '+$('.name-info-video-speaker').text()+' - Speaker: '+$('#name_speaker').val();

        //             iframe = $('#player').attr('id');
        //             player = new Player(iframe, options);

        //         }
        //     }
        // );

        return;

    }
}
// FUNCTION PLAY VIDEO

export function redirectVideo( url) {
    window.location.href = url;
}

// FUNCTION EVENTS VIDEO
export function eventsVideo(nextIndex, post_id) {
    nextControlVideo = nextIndex +1;

    player.on('pause', function () {
        player.getDuration().then(function(duration) {
            video_duration = parseInt( duration );
        });

        player.getCurrentTime().then(function(seconds) {
            current_time = parseInt( seconds );
            // progressVideo(post_id);
            // saveVideoAudit( post_id, video_duration, current_time );
            // validateLogCertificate();
        });
    });

    player.on('ended', function() {
        var nextVideo = nextControlVideo;

        if ( nextVideo <= countVideos ) {
            // progressVideo(post_id);
            // saveVideoAudit( post_id, video_duration, video_duration );
            // validateLogCertificate();

            // $('#video-'+nextVideo+'').click();

            const nextVideoElement = document.querySelector('#video-' + nextVideo+'');

            if (nextVideoElement) {
                nextVideoElement.dispatchEvent(new Event('click'));
            }

            nextControlVideo = nextControlVideo;

        }
        else {
            console.log(nextVideo);

            nextControlVideo = nextVideo;
            $('#video-'+nextControlVideo+'').click();


            const nextVideoElement = document.querySelector('#video-'+nextControlVideo+'');

            if (nextVideoElement) {
                nextVideoElement.dispatchEvent(new Event('click'));
            }

            // progressVideo(post_id);
            // saveVideoAudit( post_id, video_duration, video_duration );
            // validateLogCertificate();
        }
    });
}


document.onreadystatechange = () => {
    if (document.readyState === "loading") {
        console.log("loading");
    }
    if (document.readyState === "interactive") {
        console.log("interactive");
    }
    if (document.readyState === "complete") {
        console.log("complete");
        console.log("DOM fully loaded and parsed");
        $('#video-'+nowVideo).click();
    }
};