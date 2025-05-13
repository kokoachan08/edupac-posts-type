import $ from 'jquery';

class edu003_dialogJS{

    constructor(){
        this.events();
    }
    events(){
        $(document).ready(function() {
            $(document).on('click', '#partner-badge', function() {
                $( "#dialog" ).dialog({
                    modal: true,
                    open: function() {
                        $(".ui-dialog-titlebar").hide();
                        $("#dialog").css("display", "block");
                        $(".ui-widget-overlay").on('click', function() {
                            $(this).prev().find('.ui-dialog-content').dialog('close');
                        });
                        $(this).parent().css('z-index', '99999');
                    },
                    close: function() {
                        $("#dialog").css("display", "none");
                        $(".ui-widget-overlay").off('click');
                    },
                    buttons: [
                        {
                            text: "Saya Mengerti",
                            width: "93%",
                            click: function() {
                                $(this).dialog("close");
                            }
                        }
                    ]
                });
            });

            $(document).on('click', '#requni', function(){
                $("#requestunidialog").dialog({
                    modal: true,
                    height: "auto",
                    width: "90%",
                    draggable: false,
                    open: function(){
                        $(".ui-dialog-titlebar-close").html('<span class="dashicons dashicons-no-alt"></span>');
                        $("#ui-dialog-title-dialog").hide();
                        $(".ui-dialog-titlebar").removeClass('ui-widget-header');
                        $("#requestunidialog").css("display", "block");
                        $(".ui-widget-overlay").on('click', function() {
                            $(this).prev().find('.ui-dialog-content').dialog('close');
                        });
                        $(this).parent().css('z-index', '99999');
                    }
                }); 
            });

        });
    }
}

export default edu003_dialogJS;