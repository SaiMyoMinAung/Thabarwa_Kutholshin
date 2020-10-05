export default class StateRegion {
    constructor(
        validation = null
    ){
        if(validation != null){

            if(validation.name){
                this.name_hasError = true;
                this.name_errorMessage = validation.name;
                this.name_successMessage = null;
            } else {
                this.name_hasError = false;
                this.name_successMessage = 'Good Name.';
            }

            if(validation.code){
                this.code_hasError = true;
                this.code_errorMessage = validation.code;
                this.code_successMessage = null;
            } else {
                this.code_hasError = false;
                this.code_successMessage = 'Good Code.';
            }
            
            if(validation.is_available){
                this.is_available_hasError = true;
                this.is_available_errorMessage = validation.is_available;
                this.is_available_successMessage = null;
            } else {
                this.is_available_hasError = false;
                this.is_available_successMessage = 'Good Job.';
            }

            if(validation.country_id){
                this.country_id_hasError = true;
                this.country_id_errorMessage = validation.country_id;
                this.country_id_successMessage = null;
            } else {
                this.country_id_hasError = false;
                this.country_id_successMessage = 'Good Job.';
            }

        } else {
            this.clearValidation()
        }
        
        this.maxlength = 20;
    }

    clearValidation() {
        this.name_hasError = false;
        this.name_errorMessage = '';
        this.name_successMessage = '';

        this.is_available_hasError = false;
        this.is_available_errorMessage = '';
        this.is_available_successMessage = '';

        this.code_hasError = false;
        this.code_errorMessage = '';
        this.code_successMessage = '';

        this.country_id_hasError = false;
        this.country_id_errorMessage = '';
        this.country_id_successMessage = '';
    }

    validateName($event) {
        
    }
    
}