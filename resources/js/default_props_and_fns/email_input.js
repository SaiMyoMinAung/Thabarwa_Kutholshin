export default class nameInput {
    constructor(
        state = null,
        successMessage = '',
        errorMessage = '',
        maxlength = 50
    ){
        this.state = state;
        this.successMessage = successMessage;
        this.errorMessage = errorMessage;
        this.maxlength = maxlength;
        this.reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/;
    }
    
    validateEmail(val) {
        if(val.length >= this.maxlength){
            this.state = false;
            this.errorMessage = "Too Long!";
        }else if(val.length > (this.maxlength - (this.maxlength - 15))){
            this.isEmail(val)
        }else {
            this.successMessage = "";
            this.errorMessage = "";
            this.state = null;
        }
    }

    isEmail(val) {
        if(typeof(val) === 'object' && val.constructor.name === 'FocusEvent'){
            val = val.target.value
        }
        
        if(this.reg.test(val)){
            this.state = true;
            this.successMessage = "Nice Email.";
        } else {
            this.state = false;
            this.errorMessage = "Invalid Email!";
        }
    }
}