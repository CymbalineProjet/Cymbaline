/**
 * Created by Thibault on 23/05/2015.
 */
function Dbmanager() {

    this.item;
    this.order = null;
    this.target = null;
    this.response = 'json'; //json|array

    this.path;



    this.getById = function(id) {

    };

    this.getBy = function(by) {

    };

    this.getAllBy = function(by,value) {
        this.path = "/sql/{getAllBy:"+this.item+":"+by+":"+value+"}";
        alert('test');
    }

    this.push = function() {

    };

    this.execute = function () {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if(xmlhttp.responseText != "error" )
                    alert(xmlhttp.responseText);
                else
                    alert("DBManager.execute() error : request failed");

            }
        }
        xmlhttp.open("GET", this.path, true);
        xmlhttp.send();
    };

}

var dbmanager = new Dbmanager();