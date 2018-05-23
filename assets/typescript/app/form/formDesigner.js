import "jquery-ui-dist/jquery-ui.js";

$(function () {
    let divHeight = $("#form-canvas").outerHeight();

    function droppableInit() {
        $(".droppable").droppable({
            classes: {
                "ui-droppable-active": "ui-state-active",
                "ui-droppable-hover": "ui-state-hover"
            },
            drop: function (event, ui) {
                let draggableId = ui.draggable.attr("id");
                let droppableId = $(this).attr("id");

                switch (draggableId) {
                    case "button-text":
                        getFormHtml('Text', $(this));
                        break;
                    case "button-textarea":
                        getFormHtml('TextArea', $(this));
                        break;
                }

                rebindClick();

                $(this)
                    .addClass("ui-state-highlight")
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
            async: false,
            success: function (data) {
                holder.append(data);
            },
            error: function (XMLHttpRequest) {

            }
        })
    }

    let currentLabel;

    function rebindClick() {
        $(".form-field").unbind("click");
        $(".form-field").click(function () {
            let id = $(this).attr("id");
            let name = $(this).attr("name");
            let label = $("label[for='"+ id +"']");
            currentLabel = label;
            console.log("label: " + label.text());
            $("#name").val(label.text());
        });

        $("#name").unbind('change').on("change", function(event) {
            console.log(currentLabel.text());
            let name = $("#name").val();
            currentLabel.text(name);
            let id = "#"+currentLabel.attr("for");
            $(id).attr("field-name", name);
        });
    }

    // #button-text,
    // #button-textarea,
    // #button-integer,
    // #button-money,
    // #button-password,
    // #button-date,
    // #button-datetime,
    // #button-checkbox,
    // #button-radio,
    // #button-file,
    // #button-choice,
    // #button-collection,
    // #button-button

    $(".draggable").draggable({
        revert: "valid"
    });

    $("#form-canvas").droppable({
        accept: `#button-grid-1, 
            #button-grid-2, 
            #button-grid-3, 
            #button-grid-4, 
            #button-grid-5
        `,
        classes: {
            "ui-droppable-active": "ui-state-active",
            "ui-droppable-hover": "ui-state-hover"
        },
        drop: function (event, ui, divHeight) {
            let draggableId = ui.draggable.attr("id");
            let droppableId = $(this).attr("id");
            console.log("draggableId: " + draggableId);
            console.log("droppableId: " + droppableId);

            switch (draggableId) {
                case "button-grid-1":
                    $("#form-canvas").append(
                        `<div class="one column row">
                        <div class="column droppable"></div>
                    </div>`
                    );
                    divHeight = divHeight + 40;
                    $("#form-canvas").css("height", divHeight);
                    break;
                case "button-grid-2":
                    $("#form-canvas").append(
                        `<div class="two column row">
                        <div class="column droppable"></div>
                        <div class="column droppable"></div>
                      </div>`
                    );
                    divHeight = divHeight + 40;
                    $("#form-canvas").css("height", divHeight);
                    break;
                case "button-grid-3":
                    $("#form-canvas").append(
                        `<div class="three column row">
                        <div class="column droppable"></div>
                        <div class="column droppable"></div>
                        <div class="column droppable"></div>
                      </div>`
                    );
                    divHeight = divHeight + 40;
                    $("#form-canvas").css("height", divHeight);
                    break;
                case "button-grid-4":
                    $("#form-canvas").append(
                        `<div class="four column row">
                        <div class="column droppable"></div>
                        <div class="column droppable"></div>
                        <div class="column droppable"></div>
                        <div class="column droppable"></div>
                      </div>`
                    );
                    divHeight = divHeight + 40;
                    $("#form-canvas").css("height", divHeight);
                    break;
                case "button-grid-5":
                    $("#form-canvas").append(
                        `<div class="five column row">
                        <div class="column droppable"></div>
                        <div class="column droppable"></div>
                        <div class="column droppable"></div>
                        <div class="column droppable"></div>
                        <div class="column droppable"></div>
                      </div>`
                    );
                    divHeight = divHeight + 40;
                    $("#form-canvas").css("height", divHeight);
                    break;
            }

            droppableInit();

            $(this)
                .addClass("ui-state-highlight")
                .find("p")
                .html("drag id:" + draggableId + " drop id:" + droppableId)
                ;
        }
    });

    $("#save").on("click", function () {
       let formHtml = $("#form-container").html();
       console.log(formHtml);
    });
});