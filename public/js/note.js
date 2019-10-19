//コントラクター
$(document).ready(function() {
    let $id = getParam("id");
    if($id == null){
        $id = $('.list_middle > .list_child').data('id');
    }
    getNoteDisplay($id);

    if (window.history && window.history.pushState){
        $(window).on("popstate",function(event){
            // 初回アクセス時対策
            if (!event.originalEvent.state) return;
            getNoteDisplay(event.originalEvent.state);
      });
    }
});

//再度リストに子リスト追加
function addlistChild(data){
    let $text = data.text.substr(0,50);
    let $str = $text.replace(/^\s+/,"");
    let $string = '<div class="list_child" data-id="'+ data.id +'">'+ $str +'</div>';
    $('.list_middle').prepend($string);
}

//Summernoteを配置
function setSummernote(tag){
    $(tag).summernote({
        toolbar: [
                    ['fontname'],
                    ['fontsize'],
                    ['color'],
                    ['style', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['picture', 'link', 'table', 'hr']],
        ],
        height: "calc(100vh - 110px)",
        lang: "ja-JP",
        placeholder: 'ここに入力してください',

        callbacks: {
            onImageUpload: function(files) {
                for (let i = 0; i < files.length ; i++ ){
                    sendFile(files[i],tag);
                }
            }
        }
    });
}

//画像アップロード
function sendFile(file,tag) {
    let data = new FormData();
    data.append("file", file);

    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:"/note/imageUpload",
        type: "post",
        data: data,
        timeout: 10000,
        contentType: false,
        processData: false,
    })
    .done(function(data){
        log("画像のアップロード成功");
        $(tag).summernote('insertImage',data);
    })
    .fail(function(error){
        log("画像のアップロード失敗");
    });
}

//リストを取得
function getList(type){
    let url = "/note/getList";
    let path = location.pathname;
    if(path.indexOf("/note/trash") !== -1){
        log('ゲットリストです。ゴミ箱です');
        url = "/note/trash/getList";
    }
    let $method = $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        timeout: 10000,
        url: url,
        type: "post",
        data: {'type':type},
        beforeSend: function(jqXHR, settings){
        },
    }).done(function(data){
        log("getList成功");
        $('.list_middle').empty();
        $('#edit-note-field').empty();
        for(let i = 0 ; i < data.length ; i++){
            $('.list_middle').append(createListChild(data[i]));
        }
        displayNote(data[0]);
    }).fail(function(data){
        log('getList失敗');
    }).always(function(){
    });
    return $method;
}

function createListChild(data){
    let $text =data.text.substr(0,50);
    let $str = $text.replace(/^\s+/,"");
    let $string = '<div class="list_child" data-id="'+ data.id +'">'+ $str +'</div>';
    return $string;
}

//ノートを取得
function getNote(id){
    let url = "/note/getNote";
    let path = location.pathname;
    if(path.indexOf("/note/trash") !== -1){
        log('ゲットリストです。ゴミ箱です');
        url = "/note/trash/getNote";
    }
    let $method = $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         timeout: 10000,
         url: url,
         type: "post",
         data: {'id':id},
         beforeSend: function(jqXHR, settings){
         },
     }).done(function(data){
         log("getNote成功");
     }).fail(function(data){
         log('getNote失敗');
         log(data);
     }).always(function(){
     });
     return $method;
};

function displayNote($data){
    if($data !== ''){
        $('#edit-note-field').empty();
        let $id = $data.id;
        let $text = ($data.textnote)? $data.textnote : $data.text;
        let $string = ' <input type="hidden" name="id" value="'+ $id +'" ><div id ="edit-note" class="click2edit main_article">' + $text + '<div>';
        $('#edit-note-field').html($string);
        history.pushState($id,null,"?id=" + $id);
        noteEnableBtns("auto");
    }else{
        log('表示できませんでした');
        noteEnableBtns('none');
        $('#edit-note-field').html("ノートを選択するか新規ノートで作成してください");
    }
};

function getNoteDisplay(id){
    let $method = getNote(id);
    $method.done(function(data){
        log("getNotedisplay成功");
        displayNote(data);
    }).fail(function(data){
        log('getNoteDisplay失敗');
    }).always(function(){
    });
}

$("#new-note-icon").on('click',function(){
    $('#display-post').css('display','none');
    $('#new-post').css('display','block');
    setSummernote("#new-notearea");
});

$('.list_parent').on('click','.list_child',function(){
    getNoteDisplay($(this).data('id'));
});

let noteCreate = function() {
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        timeout: 10000,
        url: "/note/create",
        type: "post",
        data: $("#new-note-form").serialize(),
        beforeSend: function(jqXHR, settings){
            $('#note-cancel-btn').css('pointer-events','none');
            $('#note-create-btn').css('pointer-events','none');
        },
    }).done(function(data){
        log("新規作成しました");
        displayNote(data);
        addlistChild(data);
        noteCancel();
    }).fail(function(data){
        log('新規作成失敗');
    }).always(function(){
        $('#note-cancel-btn').css('pointer-events','auto');
        $('#note-create-btn').css('pointer-events','auto');
    });
};

let noteCancel = function() {
    $('#display-post').css('display','block');
    $('#new-post').css('display','none');
    $('#new-notearea').summernote('reset');
};

let noteEdit = function() {
    setSummernote("#edit-note");
    $('#note-delete').css('pointer-events','none');
};

let noteSave = function() {
    let markup = $('.click2edit').summernote('code');
    $('.click2edit').summernote('destroy');
    let $data = $("#edit-note-form").serialize();
    $data +='&textnote='+markup+'&text='+markup;

    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        timeout: 10000,
        url: "/note/update",
        type: "post",
        data: $data,
        beforeSend: function(jqXHR, settings){
            $('#note-save').css('pointer-events','none');
            $('#note-delete').css('pointer-events','none');
        },
    }).done(function(data){
        log('EDIT成功');
    }).fail(function(data){
        log('EDIT失敗');
    }).always(function(){
        $('#note-save').css('pointer-events','auto');
        $('#note-delete').css('pointer-events','auto');
    });
};

let noteDelete = function(){
    if(confirm("このノートをゴミ箱に移動しますか?")){
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            timeout: 10000,
            url: "/note/delete",
            type: "post",
            data: $("#edit-note-form").serialize(),
            beforeSend: function(jqXHR, settings){
                noteEnableBtns('none');
            },
        }).done(function(data){
            log(data);
            disapperElem('[data-id="'+data+'"]');
            noteEnableBtns('none');
            alert("ゴミ箱に移動しました");
        }).fail(function(data){
            log('削除失敗');
            noteEnableBtns('auto');
        }).always(function(){
        });
    }else{
        return false;
    }
};

function disapperElem(id){
    $(id).hide();
    $('#edit-note-field').empty();
}

let noteRestore = function(){
    if(confirm("このノートをゴミ箱から出しますか?")){
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            timeout: 10000,
            url: "/note/trash/restore",
            type: "post",
            data: $("#edit-note-form").serialize(),
            beforeSend: function(jqXHR, settings){
                $('#note-edit-btn').css('pointer-events','none');
                $('#note-save-btn').css('pointer-events','none');
                $('#note-delete-btn').css('pointer-events','none');
            },
        }).done(function(data){
            alert("復元完了");
            disapperElem('[data-id="'+data+'"]');
        }).fail(function(data){
            log('復元失敗');
        }).always(function(){
            $('#note-edit-btn').css('pointer-events','auto');
            $('#note-save-btn').css('pointer-events','auto');
            $('#note-delete-btn').css('pointer-events','auto');
        });
    }else{
        return false;
    }
};

let noteForceDelete = function(){
    if(confirm("ゴミ箱から削除をすると二度とノートを復元する事はできません。ゴミ箱から削除しますか?")){
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            timeout: 10000,
            url: "/note/trash/forceDelete",
            type: "post",
            data: $("#edit-note-form").serialize(),
            beforeSend: function(jqXHR, settings){
                $('#note-edit-btn').css('pointer-events','none');
                $('#note-save-btn').css('pointer-events','none');
                $('#note-delete-btn').css('pointer-events','none');
            },
        }).done(function(data){
            alert("忘却の彼方へ");
            disapperElem('[data-id="'+data+'"]');
        }).fail(function(data){
            log('削除失敗');
        }).always(function(){
            $('#note-edit-btn').css('pointer-events','auto');
            $('#note-save-btn').css('pointer-events','auto');
            $('#note-delete-btn').css('pointer-events','auto');
        });
    }else{
        return false;
    }
};


// クリックアクション以外
function noteEnableBtns(btn){
    //有効:auto 無効:none
    $('#note-edit-btn').css('pointer-events',btn);
    $('#note-save-btn').css('pointer-events',btn);
    $('#note-delete-btn').css('pointer-events',btn);
}

//Ajaxテスト用スクリプト
$(function(){
    $("#ajax").on('click',function(){
        log("クリックされました!");
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"/note/api_ajax/get_json",
            type:"post",
            dataType:'json',
            data: {
                "name" : 'test'
            },
        }).done(function(data){
            log("通信成功");
            log(data);
        }).fail(function(data){
            log("失敗");
            log(data);
        })
    })
});
