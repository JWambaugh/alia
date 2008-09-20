

function AConnection(source, signal, target, slot, id,script){
	this.source = source;
	this.signal = signal;
	this.target = target;
	this.slot = slot;
	this.id = id;
	this.script=script;
}

var Alia = new function(){
	this.connections = new Array();
	this.ajaxQueue='';
	this.params=null;
	
	
	this.emit = function(source, signal,params){
		
		var post="";
		var connection=null;
		if(params == null){params=new Array()};
		this.params = params;
		for(var x = 0; x < this.connections.length; x++ ){
			connection = this.connections[x];
			if(connection.signal == signal && connection.source == source){
				if(connection.target!=''){
					this.addSignalAjax(connection.id,params);
				}
				if(connection.script!=null){
					//if its a javascript connection, execute the slot
					connection.script(params);
				}
			}
		}
		//make the ajax call
		this.ajaxSync();
	}
	
	this.addSignalAjax= function(connectionID, params){
		if(params == null){params=new Array()};
		this.ajaxQueue=this.ajaxQueue+"&triggeredConnections[]="+connectionID;
		if(params.length > 0){
		this.ajaxQueue=this.ajaxQueue + "-|-"+ params.join("-|-");
		}
		
	}

	this.ajaxSync = function(){
		if(this.ajaxQueue!=''){
			$.post(AliaFrontURL,this.ajaxQueue ,function(data){ eval( data);  });

			this.ajaxQueue='';
		}
	}
	
	
	this.addConnection = function(connection){
		this.connections.push(connection);
	}
	
	this.replaceElementWithHTML = function(element, html){
		var newElement = document.createElement(element.tagName);
		newElement.innerHTML = html;
		element.parentNode.replaceChild(newElement.firstChild,element);
	}

	this.evaluate = function(code){
		
	}

	this.decode = function(code){
		code =  code.replace(/%sq;/,"'");
		return code.replace(/%dq;/,'"');
	}

	this.getValues = function(id){
		var arr='';
		var chr='';
		$("#"+id+" > input").each(function(i){
			arr=arr+chr+this.name+"="+this.value;
			if(chr=='')chr='&';
		});
		return arr;
	}
	
}
 $(document).ready(function() {
   //alert(Alia.getValues("UserWidget0"));
 });


