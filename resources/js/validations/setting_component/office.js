export default class office {
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
            
            if(validation.is_available){
                this.is_available_hasError = true;
                this.is_available_errorMessage = validation.is_available;
                this.is_available_successMessage = null;
            } else {
                this.is_available_hasError = false;
                this.is_available_successMessage = 'Good Job.';
            }

            if(validation.state_region_id){
                this.state_region_id_hasError = true;
                this.state_region_id_errorMessage = validation.state_region_id;
                this.state_region_id_successMessage = null;
            } else {
                this.state_region_id_hasError = false;
                this.state_region_id_successMessage = 'Good Job.';
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

        this.state_region_id_hasError = false;
        this.state_region_id_errorMessage = '';
        this.state_region_id_successMessage = '';
    }

    validateName($event) {
        
    }
    
}