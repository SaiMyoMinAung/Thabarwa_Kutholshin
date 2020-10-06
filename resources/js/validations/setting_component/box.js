export default class box {
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
            
            if(validation.store_id){
                this.store_id_hasError = true;
                this.store_id_errorMessage = validation.store_id;
                this.store_id_successMessage = null;
            } else {
                this.store_id_hasError = false;
                this.store_id_successMessage = 'Good Job.';
            }

            if(validation.box_number){
                this.box_number_hasError = true;
                this.box_number_errorMessage = validation.box_number;
                this.box_number_successMessage = null;
            } else {
                this.box_number_hasError = false;
                this.box_number_successMessage = 'Good Store Number.';
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

        this.box_number_hasError = false;
        this.box_number_errorMessage = '';
        this.box_number_successMessage = '';

        this.store_id_hasError = false;
        this.store_id_errorMessage = '';
        this.store_id_successMessage = '';
    }

    validateName($event) {
        
    }
    
}