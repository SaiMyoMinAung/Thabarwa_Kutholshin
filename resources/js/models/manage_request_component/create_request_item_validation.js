export default class CreateRequestItemValidation {
    constructor(
        validation = null
    ) {
        if (validation != null) {

            if (validation.qty) {
                this.qty_hasError = true;
                this.qty_errorMessage = validation.qty[0];
                this.qty_successMessage = null;
            } else {
                this.qty_hasError = false;
                this.qty_successMessage = 'Good Job.';
            }

            if (validation.requestable_type) {
                this.requestable_type_hasError = true;
                this.requestable_type_errorMessage = validation.requestable_type[0];
                this.requestable_type_successMessage = null;
            } else {
                this.requestable_type_hasError = false;
                this.requestable_type_successMessage = 'Good Job.';
            }

            if (validation.requestable_id) {
                this.requestable_id_hasError = true;
                this.requestable_id_errorMessage = validation.requestable_id[0];
                this.requestable_id_successMessage = null;
            } else {
                this.requestable_id_hasError = false;
                this.requestable_id_successMessage = 'Good Job.';
            }

        } else {
            this.clearValidation()
        }

        this.maxlength = 20;
    }

    clearValidation() {
        this.qty_hasError = false;
        this.qty_errorMessage = '';
        this.qty_successMessage = '';

        this.requestable_type_hasError = false;
        this.requestable_type_errorMessage = '';
        this.requestable_type_successMessage = '';

        this.requestable_id_hasError = false;
        this.requestable_id_errorMessage = '';
        this.requestable_id_successMessage = '';
    }

}