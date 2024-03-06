$(function() {
    const url = '/api.php';
    const app = $('#app')
    let ajaxObj = false

    init()

    function ajax(data, callback) {
        data.sessionId = app.data('sessionId')
        if(ajaxObj) return
        $.ajax({
            url: url,
            dataType: 'json',
            type: 'post',
            data: data,
            success: callback,
            complete: () => ajaxObj = false
        })
    }

    function init() {
        ajax({}, render)
    }

    function hit() {
        ajax({hit: true}, function(response) {
            if(response.win) {
                $('.bee').addClass('dead')
                if(confirm('You win! Do you want to play new game?')) {
                    window.location = window.location
                }
                $('button').remove()
            }
            if(!response.id) return
            const beeBlock = $('#' + response.id).addClass()
            $('.selected').removeClass('selected')
            if(!beeBlock.length) return
            if(response.data.selected) {
                beeBlock.addClass('selected')
            }
            if(!response.data.alive) {
                beeBlock.addClass('dead')
            }
            beeBlock.find('.life-span').text(response.data.lifespan)

        })
    }

    function render(bees) {
        const block =  $('.bees')
        block.html('')
        for(let id in bees) {
            const bee = bees[id]
            const template = $('#bee-template').html().trim();
            const el = $(template)
            el.attr('id', id)
            if(!bee.alive) {
                el.addClass('dead')
            }
            if(bee.selected) {
                el.addClass('selected')
            }
            el.find('.title').text(bee.type)
            el.find('.life-span').text(bee.lifespan)
            block.append(el)
        }
    }

    $('button').click(hit)
})