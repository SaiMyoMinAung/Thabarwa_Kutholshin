export default class store {
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

            if(validation.store_number){
                this.store_number_hasError = true;
                this.store_number_errorMessage = validation.store_number;
                this.store_number_successMessage = null;
            } else {
                this.store_number_hasError = false;
                this.store_number_successMessage = 'Good Store Number.';
            }
            
            if(validation.office_id){
                this.office_id_hasError = true;
                this.office_id_errorMessage = validation.office_id;
                this.office_id_successMessage = null;
            } else {
                this.office_id_hasError = false;
                this.office_id_successMessage = 'Good Job.';
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

        this.store_number_hasError = false;
        this.store_number_errorMessage = '';
        this.store_number_successMessage = '';

        this.office_id_hasError = false;
        this.office_id_errorMessage = '';
        this.office_id_successMessage = '';

        
    }

    validateName($event) {
        
    }
    
}