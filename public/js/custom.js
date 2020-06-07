$(document).ready(function () {
    var url = $('meta[name="url"]').attr('content');
    var token = $('meta[name="csrf-token"]').attr('content');


    $('.like').click(function () {
        let id = $(this).parents('.card-footer').attr('publication');
        let dislike =  $(this).parents('.card-footer').find('.dislike');
        $(this).parent().find('.invalid-feedback').remove()
        $.ajax({
            type: 'post',
            url: url + '/publication/like',
            data: {_token: token, id},
            success: (r) => {

                if (r.status){

                    $(this).removeClass('fa-thumbs-o-up');
                    $(this).addClass('fa-thumbs-up text-primary');

                    $(dislike).removeClass('fa-thumbs-down text-danger');
                    $(dislike).addClass('fa-thumbs-o-down');

                    $(dislike).text(r.dislike_count);
                    $(this).text(Number($(this).text())+1)

                } else {

                    if (r.message === 'delete') {

                        $(this).addClass('fa-thumbs-o-up');
                        $(this).removeClass('fa-thumbs-up text-primary');
                        $(this).text(Number($(this).text())-1);
                    }
                }
            },
            error: (r) => {
                $.each(r.responseJSON.errors,(key, item) =>{
                    $(this).parent().append(`      <span class="invalid-feedback d-block text-center" role="alert">
                                        <strong>${item}</strong>
                                    </span>`)
                })
            }
        })
    })

    $('.dislike').click(function () {
        let id = $(this).parents('.card-footer').attr('publication');
        let like =  $(this).parents('.card-footer').find('.like');
        $(this).parent().find('.invalid-feedback').remove()
        $.ajax({
            type: 'post',
            url: url + '/publication/dislike',
            data: {_token: token, id},
            success: (r) => {
                if (r.status){

                    $(this).removeClass('fa-thumbs-o-down');
                    $(this).addClass('fa-thumbs-down text-danger');

                    $(like).removeClass('fa-thumbs-up text-primary');
                    $(like).addClass('fa-thumbs-o-up');

                    $(like).text(r.like_count);
                    $(this).text(Number($(this).text())+1);

                } else {

                    if (r.message === 'delete') {

                        $(this).addClass('fa-thumbs-o-down');
                        $(this).removeClass('fa-thumbs-down text-danger');
                        $(this).text(Number($(this).text())-1);
                    }
                }
            },
            error: (r) => {
                $.each(r.responseJSON.errors,(key, item) =>{
                    $(this).parent().append(`      <span class="invalid-feedback d-block text-center" role="alert">
                                        <strong>${item}</strong>
                                    </span>`)
                })
            }
        })
    })

    $(document).on('keyup','.comment',function(e){
        if(e.keyCode == 13)
        {
            $(this).parent().find('.send-comment').trigger("click");
        }
    });

    $('.send-comment').click(function () {
        let id = $(this).parents('.card-footer').attr('publication');
        let comment = $(this).parent().find('.comment').val()
        $(this).parent().find('.invalid-feedback').remove()
        if (comment != '') {
            $.ajax({
                type: 'post',
                url: url + '/publication/comment',
                data: {_token: token, id,comment},
                success: (r) => {
                    if (r.status){
                        $(this).parent().find('.comment').val('');
                        let html =`<div class="col-md-12 px-4 my-1 position-relative">
                            <span class="time">${r.time}</span>
                            <div class="rounded bg-white p-2">
                            <span class="text-primary font-weight-bold mr-2">${r.name}</span> ${r.comment}
                        </div>
                        </div>`;

                        $('.all-comments').append(html)
                    }
                },
                error: (r) => {
                    console.log(r)
                    var response = JSON.parse(r.responseText);
                    $.each( response.errors,( key, array) => {
                        $.each(array,( k,item) => {
                            $(this).parent().append(` <span class="invalid-feedback d-block text-center" role="alert">
                                        <strong>${item}</strong>
                                    </span>`)
                        })
                    })
                }
            })
        }
    })
});