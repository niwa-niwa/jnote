//GETパラメーターを取得
function getParam(name, url) {
    if (!url) url = window.location.href;
    // let name = name.replace(/[\[\]]/g, "\\$&");
    let regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)");
    let results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function log(param){
    console.log(param);
}

//Ajaxテスト用スクリプト
// $(function(){
//     $("#ajax").on('click',function(){
//         console.log("クリックされました!");
//         $.ajax({
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             url:"/note/api_ajax/get_json",
//             type:"post",
//             dataType:'json',
//             data: {
//                 "name" : 'test'
//             },
//         }).done(function(data){
//             console.log("通信成功");
//             console.log(data);
//         }).fail(function(data){
//             console.log("失敗");
//             console.log(data);
//         })
//     })
// });
