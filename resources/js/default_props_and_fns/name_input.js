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
    }
    
    validateName(val) {
        if(val.length >= (this.maxlength - (this.maxlength -5)) && val.length <= (this.maxlength-1)){
            this.state = true;
            this.successMessage = "Nice Name."
        } else if(val.length >= this.maxlength ){
            this.state = false;
            this.errorMessage = "Too Long!"
        } else {
            this.state = null;
            this.errorMessage = ""
            this.successMessage = ""
        }
    }
}