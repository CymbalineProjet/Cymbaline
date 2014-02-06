

$(document).ready(function() {
    tracker = function(id) {
        
        if($(id).hasClass('show')) {
            $(id).hide().removeClass('show');
        } else {
            $(id).show().addClass('show');
        }

        return this;
    };
});
