export default class nameInput {
    constructor(
        state = null,
        successMessage = '',
        errorMessage = '',
        maxFile = 3
    ){
        this.state = state;
        this.successMessage = successMessage;
        this.errorMessage = errorMessage;
        this.maxFile = maxFile;
    }
    
    validateImage(val) {
        if(val.length == 0){
            this.state = null;
        } else if(val.length <= this.maxFile){
            this.state = true;
            this.successMessage = "Nice Photo.";
        } else if(val.length > this.maxFile ){
            this.state = false;
            this.errorMessage = "Only 3 Limited";
        } else {
            this.state = null;
            this.errorMessage = "";
            this.successMessage = "";
        }
    }
}