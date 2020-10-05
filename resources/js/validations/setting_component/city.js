export default class city {
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

            if(validation.address){
                this.address_hasError = true;
                this.address_errorMessage = validation.address;
                this.address_successMessage = null;
            } else {
                this.address_hasError = false;
                this.address_successMessage = 'Good Address.';
            }
            
            if(validation.is_open){
                this.is_open_hasError = true;
                this.is_open_errorMessage = validation.is_open;
                this.is_open_successMessage = null;
            } else {
                this.is_open_hasError = false;
                this.is_open_successMessage = 'Good Job.';
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

        this.address_hasError = false;
        this.address_errorMessage = '';
        this.address_successMessage = '';

        this.is_open_hasError = false;
        this.is_open_errorMessage = '';
        this.is_open_successMessage = '';

        this.state_region_id_hasError = false;
        this.state_region_id_errorMessage = '';
        this.state_region_id_successMessage = '';
    }

    validateName($event) {
        
    }
    
}