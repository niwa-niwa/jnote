let settingName = function(){
    let name = prompt("新しい名前を入力してください");
    if(name != null && !name.match(/^[ 　\r\n\t]*$/) && name != "" ){
        log("入力された名前に問題はありません");
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"/settings/name",
            type:"post",
            data: {
                'name' : name,
            },
        }).done(function(data){
            $('[data-setting="name"]').html(name);
        }).fail(function(data){
        }).always(function(data){
            alert(data);
        });
    }else{
        alert('入力内容が正しくありません。');
    }
};

let settingMail = function(){
    let mail = prompt("新しいメールアドレスを入力してください(確認メールは送信されません)");
    if(mail != null && mail.match(/^([a-zA-Z0-9\._-])*@([a-zA-Z0-9\._-])+$/)){
        log("入力されたメアドに問題ありません");
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"/settings/mail",
            type:"post",
            data: {
                'mail' : mail,
            },
        }).done(function(data){
            $('[data-setting="mail"]').html(mail);
        }).fail(function(data){
        }).always(function(data){
            alert(data);
        });
    }else{
        alert('入力内容が正しくありません。@マークを含めたメールアドレスを入力してください');
    }
};

let settingPassword = function(){
    let cur_pw = $('#current-pw').val();
    let new_pw = $('#new-pw').val();
    let con_pw = $('#confirm-pw').val();

    if(cur_pw && new_pw && con_pw){
        if(new_pw == con_pw && new_pw.length > 7){
            log('一致していて8文字以上');
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"/settings/password",
                    type:"post",
                    data: {
                        'current_pw' : cur_pw,
                        'new_pw' : new_pw,
                    },
                    beforeSend: function(jqXHR, settings){
                        $('#btn-password').css('pointer-events','none');
                    },
                }).done(function(data){
                    $('#current-pw').val('');
                    $('#new-pw').val('');
                    $('#confirm-pw').val('');
                }).fail(function(data){
                }).always(function(data){
                    alert(data);
                    $('#btn-password').css('pointer-events','auto');

                });
        }else{
            alert('新しいパスワードと確認パスワードが正しくありません。8文字以上で入力してください')
        }
    }else{
        alert('現在のパスワード・新しいパスワード・確認パスワード をすべて入力してください')
    }
};

let settingLogout = function(){
    if(window.confirm('本当にログアウトしますか?')){
        location.href = "/logout";
    }
};

let settingDelete = function(){
    if(window.confirm('本当にアカウントを削除しますか?')){
        location.href = "/settings/delete";
    }
};