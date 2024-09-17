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

        $('.name-info-video-speaker').text('');
        $('.text-info-video-speaker').children('p').remove();

        $('.name-info-video-speaker').append( $(this).children('.name-playlist-video').val() );
        $('.text-info-video-speaker').append( $(this).children('#description_video').val() );

    });

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

                    var textLog = 'Play video '+$('.name-info-video-speaker').text()+' - Speaker: '+$('#name_speaker').val();
                    // saveLogs( textLog );

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

                                                var textLog = 'Play video '+$('.name-info-video-speaker').text()+' - Speaker: '+$('#name_speaker').val();
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

                                            var textLog = 'Play video '+$('.name-info-video-speaker').text()+' - Speaker: '+$('#name_speaker').val();
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

            $('#video-'+nextVideo+'').click();
            nextControlVideo = nextControlVideo;

        }
        else {
            console.log(nextVideo);

            nextControlVideo = nextVideo;
            $('#video-'+nextControlVideo+'').click();

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