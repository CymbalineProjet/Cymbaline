
$(document).ready(function() {

	function Tchat () {

		this.id = null;
		this.content = null;
		this.date = null;
		this.member = null;

	}

	var tchat = new Tchat();
	var input = $('#myMessage');
	var form = $('#tchatForm');
	var list = $('#tchatList');

	function addTchat() {
		$.ajax({
			method: "POST",
			url:    "/prono/tchat/new",
			data: {content: tchat.content}
		})
		.done(function(response) { 
			if(response == 1) {
				loadTchat();
			} else {
				alert("Error while adding your message in the tchat");
			}
		});
	}
	
	function loadTchat() {
		$.ajax({
			method: "GET",
			url:    "/prono/tchat/load"
		})
		.done(function(response) {
		
			
			if(response != 0) {
				var json = $.parseJSON(response);
				htmlTacht(json);
			} else {
				list.html("<li><label></label><div>Aucun message</div></li>");
			}
		});
		
		setTimeout(loadTchat,3000);
	}
	
	function htmlTacht(json) {
		
		var parse = "";
		
		for(var i = 0; i < json.lines.length; i++) {
			var html = '<li><label><img class="roundedImage" height="28" width="28" src="../public/upload/member/member_mid.jpg" /></label><div>content</div></li>';
			var wid = html.replace("mid",json.lines[i].member);
			parse += wid.replace("content",json.lines[i].content);
		}
		
		list.html(parse);
	}
	
	form.submit(function() {
		return false;
	});
	
	input.keypress(function(e) {
		if(e.which == 13) {
		
			tchat.content = input.val();	
			addTchat();
			return false;
		}
		
		
	});
	
	loadTchat();
	
	
	
});