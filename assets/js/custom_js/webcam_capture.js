Webcam.set({
    width: 390,
    height: 290,
    image_format: 'jpeg',
    jpeg_quality: 90
});
$("#capture_webcam_img").on('click', function(e){
    Webcam.attach( '#my_camera' );
});

function take_snapshot() {
    Webcam.snap( function(data_uri) {
        $(".image-tag").val(data_uri);
        document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
    } );
}
//
// $('#form_capture_webcam_image').on('submit', function(e){
//     e.preventDefault();
//     var base_url = $("#base_url").val();
//
//     $.ajax({
//         url:base_url+'Doctor/update_prefixes',
//         method:"POST",
//         data:$("#form_capture_webcam_image").serialize(),
//         dataType: "json",
//         success:function(response)
//         {
//             if (response.type === 'success') {
//                 window.setTimeout(function () {
//                     message(response.msg, response.type, 1000);
//                     window.location.reload();
//                 }, 1000);
//             } else {
//                 message(response.msg, response.type, 3000);
//             }
//         }
//     });
// });