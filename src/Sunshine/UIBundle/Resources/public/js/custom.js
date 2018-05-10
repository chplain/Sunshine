$(function () {
    var divHeight = $( "#form-canvas" ).outerHeight();

    $(".draggable").draggable({
        revert: "valid"
    });
    $("#form-canvas").droppable({
        accept: "#grid_12_button, #grid_1_button, #grid_6_button, #grid_4_button, #grid_3_button",
        classes: {
            "ui-droppable-active": "ui-state-active",
            "ui-droppable-hover": "ui-state-hover"
        },
        drop: function( event, ui ) {
            var draggableId = ui.draggable.attr("id");
            var droppableId = $(this).attr("id");

            switch (draggableId) {
                case "grid_12_button":
                    $("#form-canvas").append('<div class="col-md-12 grid-box droppable" id="test"></div>');
                    divHeight = divHeight + 40;
                    $("#form-canvas").css("height", divHeight);
                    droppableInit();
                    break;
                case "grid_1_button":
                    $("#form-canvas").append(
                        '<div class="col-md-1 grid-box droppable"></div>'+
                        '<div class="col-md-11 grid-box droppable"></div>'
                    );
                    divHeight = divHeight + 40;
                    $("#form-canvas").css("height", divHeight);
                    droppableInit();
                    break;
                case "grid_6_button":
                    $("#form-canvas").append(
                        '<div class="col-md-6 grid-box droppable"></div>'+
                        '<div class="col-md-6 grid-box droppable"></div>'
                    );
                    divHeight = divHeight + 40;
                    $("#form-canvas").css("height", divHeight);
                    droppableInit();
                    break;
                case "grid_4_button":
                    $("#form-canvas").append(
                        '<div class="col-md-4 grid-box droppable"></div>'+
                        '<div class="col-md-4 grid-box droppable"></div>'+
                        '<div class="col-md-4 grid-box droppable"></div>'
                    );
                    divHeight = divHeight + 40;
                    $("#form-canvas").css("height", divHeight);
                    droppableInit();
                    break;
                case "grid_3_button":
                    $("#form-canvas").append(
                        '<div class="col-md-3 grid-box droppable"></div>'+
                        '<div class="col-md-3 grid-box droppable"></div>'+
                        '<div class="col-md-3 grid-box droppable"></div>'+
                        '<div class="col-md-3 grid-box droppable"></div>'
                    );
                    divHeight = divHeight + 40;
                    $("#form-canvas").css("height", divHeight);
                    droppableInit();
                    break;
            }

            $( this )
                .addClass( "ui-state-highlight" )
                .find( "p" )
                .html( "drag id:"+draggableId+" drop id:"+ droppableId)
            ;
        }
    });

    function droppableInit() {
        $(".droppable").droppable({
            classes: {
                "ui-droppable-active": "ui-state-active",
                "ui-droppable-hover": "ui-state-hover"
            },
            drop: function( event, ui ) {
                var draggableId = ui.draggable.attr("id");
                var droppableId = $(this).attr("id");

                switch (draggableId) {
                    case "text_button":
                        getFormHtml('Text', $(this));
                        break;
                    case "textarea_button":
                        getFormHtml('TextArea', $(this));
                        divHeight = divHeight + 65;
                        $("#form-canvas").css("height", divHeight);
                        break;
                }

                $(this)
                    .addClass( "ui-state-highlight" )
                ;
            }
        });
    }

    function getFormHtml(type, holder) {
        $.ajax({
            type: "GET",
            url: Routing.generate('form_html', { type: type }),
            dateType: "html",
            timeout: 1000,
            success: function (data) {
                holder.append(data)
            },
            error: function (XMLHttpRequest) {

            }
        })
    }
});