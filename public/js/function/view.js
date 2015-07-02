/**
 * Created by Thibault on 19/05/2015.
 */
function View () {

    this.path = null;
    this.name;

    this.args = null;



    this.link = function(name,args) {

        this.name = name;

        if(args !== null)
            this.path = "/view/get/path/{"+name+":"+args+"}";
        else
            this.path = "/view/get/path/{"+name+"}";

        return this.path;
    };

    this.execute = function() {
        var n = this.name;
        if(this.path !== null) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    if(xmlhttp.responseText != "error" )
                        document.location.href = xmlhttp.responseText;
                    else
                        alert("View.execute() error : route "+n+" doesn't exist");

                }
            }
            xmlhttp.open("GET", this.path, true);
            xmlhttp.send();
        } else {
            alert("View.execute() error : path is null. Try to use View.link(name,args) or directly set View.path.");
        }
    };
}

var view = new View();
