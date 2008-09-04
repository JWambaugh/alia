/**
validator.js
@author: Jordan CM Wambaugh jordan@wambaugh.org
@since: 01/12/07
@copyright Copyright (C) 2007 Jordan CM Wambaugh - for use only with permission by Jordan Wambaugh. 

usage:

define a rule for each element that must be validated with the Validator.add() function:
Validator.add(id, type[, options])
where:
id 		- the id of the element
type 	- the type of validator to add to the field. Valid values are 'text', 'email', and 'number'
options	- options for that specific validator (see below)


use Validator.onSubmit() to validate the entire form when the user hits submit.

example usage:
<script type="text/javascript" src='validator.js' /></script>
<form onsubmit="return Validator.onSubmit()">
<input type="text" id="firstName"><br />
<input type="text" id="emailAddress"><br />
<input type="text" id="age"><br />
<input type = "submit" />
</form>
<script type="text/javascript">
Validator.add('firstName','text',{required: 1, maxLength: 10, minLength: 3}); 	//firstName is required, and must be between 3 and 10 chars.
Validator.add('emailAddress','text',{required: 1, maxLength: 15, minLength: 5});//emailAddress is required, and must be between 5 and 15 chars.  
Validator.add('emailAddress','email');											//emailAddress must contain a valid email address
Validator.add('age','number');													//age may only contain numbers

</script>


OPTIONS:
Global:	
	noOnBlur	(bool)	- tells validator to not set the onBlur property for this field (in case you need to tap into it somwhere else)

text validator:
	required 	(bool)	- Whether the field is required
	maxLength	(int)	- The maximum length of the text field
	minLength	(int)	- The minimum length of the text field

number validator:
	decimal 		(Bool) 		- Whether a decimal character is allowed (default is not allowed)
	additionalChars (String)	- Aditional allowable characters
	
email validator:
	(none)

validator.js implements the following patterns: singleton, factory method, and strategy.
**/


/**
* Validator class perfroms validation on form fields.
* 
*
*/
var Validator = new function _Validator(){
	//declare properties
	this.elements = new Array();
	this.validated=true;
	//declare methods

	/*
	* adds a new ElementRule
	*/
	this.add = function(id,type, options){
		
		var element = this.getElementByID(id);
		if(element ==undefined){
			return;
		}
	
		if(options==undefined){
			options={};
		}
		if(type=='string'){
			
			element.addValidator(new ValidatorStringValidator(element, options));
		}
		else if(type=='int'){
			element.addValidator(new ValidatorIntValidator(element, options));
		}
		else if(type=='email'){
			element.addValidator(new ValidatorEmailValidator(element, options));
		}
		else{
			alert("Validator error: unkown type '" + type + "'");
		}
		
		if(!options.noOnBlur){
			document.getElementById(id).onblur=function(){Validator.validate(this.id)};
		}
	}
	
	this.clear = function(){
		this.elements = new Array();
	}

	/**
	* Adds a new element
	**/
	this.addElement = function(element){
		this.elements=this.elements.concat(element);
	}


	/**
	* returns the ValidatorElement for the specified id. Creates a new one if it doesn't already exist.
	**/
	this.getElementByID = function(id){
		var x;
		for(x=0;x<this.elements.length;x++){
			if(this.elements[x].id==id){
				return this.elements[x];
			}
		}
		var newElement=new ValidatorElement(id);
		this.addElement(newElement);
		return newElement;
	}


	/**
	* Clears all ValidatorElements and validators
	**/
	this.clear = function(){
		this.elements=new Array();
	}



	//this function performs the actual validation on an element
	this.validate = function (elementID){
		var x;
		var len=this.elements.length;
		var element=null;
		//find the rule for this element
		for(x=0;x<len;x++){
			if(this.elements[x].id==elementID){
				if(!this.elements[x].validate()){
					this.validated=false;
				}
			}
		}
	}

	//runs through each element
	this.onSubmit = function(){
		var x;
		//we're starting over, so assume everything is good
		this.validated=true;
		var failCount=0;
		var len=this.elements.length;
		//validate every element we have
		for(x=0;x<len;x++){
			if(!this.elements[x].validate()){
					this.validated=false;
					failCount++;
				}
		}
		if(!this.validated){
			alert("There are " + failCount + " fields that contain errors on this page. \nPlease fix them before you submit.");
			return(false);
		}
		else{
			return(true);
		}
	}



}



/**
* Element class for Validator.
* @param id string the id of the element
*/
function ValidatorElement(id){
	this.id=id;
	this.validators=null;
	this.validates=true;

	this.addValidator = function(validator){
		if(this.validators){
			this.validators=this.validators.concat(validator);
		}else{
			this.validators=new Array(validator);
		}
	}

	//Runs all validators on this element.
	this.validate = function(){
		var validates=1;
		var x;

		var len=this.validators.length;
		//alert("in validatorElent validate()");
		for(x=0;x<len;x++){
			if(!this.validators[x].validate()){
				validates=0;
			}
		}
		if(!this.validates && validates){
			this.validates=1;
			this.unHighlight();
		}
		return validates;
	}

	//called by a validator whenever there is an error message
	this.failure = function(message){
		if(this.validates==0)return;
		this.highlight();
		alert(message);
		this.validates=0;
	}

	this.highlight = function(){
		document.getElementById(this.id).style.background='#FF9999';
	}

	this.unHighlight = function(){
		document.getElementById(this.id).style.background='#FFFFFF';
	}
	
	//returns the value of the form element
	this.getValue = function(){
		return document.getElementById(this.id).value;
	}

}



/**
* Validator for genereic text
* options:	required 	(bool)	- Whether the field is required
* 			maxLength	(int)	- The maximum length of the text field
*			minLength	(int)	- The minimum length of the text field
*/
function ValidatorStringValidator(element,options){
	this.options=options;
	this.element=element;
	
	//Validate function. This is called by a ValidatorElement
	this.validate = function(){
		var elementValue=this.element.getValue();
		//alert("val: "+ elementValue);
		//validate required
		if(this.options.required){
			if((elementValue.length==0) ||  (elementValue==null)){
				this.element.failure("This field is required.");

				return false;
			}
		}

		//validate max length
		if(this.options.maxLength){
			if(this.options.maxLength < elementValue.length){
				this.element.highlight();
				this.element.failure("This field cannot have more than " + this.options.maxLength + " characters. It currently has " + elementValue.length + ".");
				return false;
			}
		}

		//validate min length
		if(this.options.maxLength){
			if(this.options.minLength > elementValue.length && elementValue.length !=0){
				this.element.failure("This field must have at least " + this.options.minLength + " characters. It currently has " + elementValue.length + ".");
				return false;
			}
		}
		return 1;

	}
}




/**
* Validator for numeric text
* options:	
* 			additionalChars (String)	- Aditional allowable characters
*/
function ValidatorIntValidator(element,options){
	this.options=options;
	this.element=element;
	
	//Validate function. This is called by a ValidatorElement
	this.validate = function(){
		var elementValue=this.element.getValue();
		var validChars = "0123456789";
		var isNumber=true;
		
		if(this.options.additionalChars){
			validChars = validChars + options.additionalChars;
		}
		//loop through and check the chars in the string against our allowable chars
		for (i = 0; i < elementValue.length && isNumber == true; i++)
		{
			if (validChars.indexOf(elementValue.charAt(i)) == -1)
			{	
				var failText="This field may only contain numbers";
				if(this.options.additionalChars){
					failText=failText + " including any of these characters: '"+this.options.additionalChars+"'";
				}
				this.element.failure(failText);
				return false;
			}
		}
		return true;
	}
}



/**
* Simple validator for email addresses (just makes sure there is a '@' and a '.')
* options:	none.
*/
function ValidatorEmailValidator(element,options){
	this.options=options;
	this.element=element;
	
	//Validate function. This is called by a ValidatorElement
	this.validate = function(){
		var elementValue=this.element.getValue();
		if(elementValue=='')return;
		if (!((elementValue.indexOf(".") > 0) && (elementValue.indexOf("@") > 0))){
			this.element.failure("This field must only contain email addresses. Please entar a valid email address.");
			return false;
		}
		return true;
	}
}


