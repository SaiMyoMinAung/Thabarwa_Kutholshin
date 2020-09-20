import myanmarPhoneNumber from "myanmar-phonenumber";

export default class phoneInput {
    // less 8
    // max 11
    constructor(
        state = null,
        successMessage = '',
        errorMessage = '',
        maxlength = 12
    ){
        
        this.state = state;
        this.successMessage = successMessage;
        this.errorMessage = errorMessage;
        this.maxlength = maxlength;
    }
    
    validatePhone(val) {
        
        if(typeof(val) === 'object' && val.constructor.name === 'FocusEvent'){
            val = val.target.value
        }

        if(val.length >= 5 && val.length < 12){
            this.state = myanmarPhoneNumber.isValidMMPhoneNumber(val);
            if(this.state){
                var TelecomName = myanmarPhoneNumber.getTelecomName(val);
                if(TelecomName != 'Unknown'){
                    this.successMessage = "Nice " + TelecomName + " Phone Number.";
                }   
            }else{
                this.state  = false;
                this.errorMessage = "Invalid Phone Number."
            }
        }else if(val.length >= 12){
            this.state = false;
            this.errorMessage = "Too Long!";
        } else if(val.length < 5){
            this.state = false;
            this.errorMessage = "Phone Number Required!"
        } else {
            this.state = null;
            this.errorMessage = ""
            this.successMessage = ""
        }
    }

    isNumber (event) {
        event = (event) ? event : window.event;
        var charCode = (event.which) ? event.which : event.keyCode;
        if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
          event.preventDefault();;
        } else {
          return true;
        }
    }
}