export default class step2 {
    constructor(
        validation = null
    ) {
        if (validation != null) {

            if (validation.store_keeper_volunteer_id) {
                this.store_keeper_volunteer_id_hasError = true;
                this.store_keeper_volunteer_id_errorMessage = validation.store_keeper_volunteer_id[0];
                this.store_keeper_volunteer_id_successMessage = null;
            } else {
                this.store_keeper_volunteer_id_hasError = false;
                this.store_keeper_volunteer_id_successMessage = 'Good Job.';
            }

            if (validation.store_id) {
                this.store_id_hasError = true;
                this.store_id_errorMessage = validation.store_id[0];
                this.store_id_successMessage = null;
            } else {
                this.store_id_hasError = false;
                this.store_id_successMessage = 'Good Job.';
            }

            if (validation.box_id) {
                this.box_id_hasError = true;
                this.box_id_errorMessage = validation.box_id[0];
                this.box_id_successMessage = null;
            } else {
                this.box_id_hasError = false;
                this.box_id_successMessage = 'Good Job.';
            }

        } else {
            this.clearValidation()
        }

        this.maxlength = 20;
    }

    clearValidation() {
        this.store_keeper_volunteer_id_hasError = false;
        this.store_keeper_volunteer_id_errorMessage = '';
        this.store_keeper_volunteer_id_successMessage = '';

        this.store_id_hasError = false;
        this.store_id_errorMessage = '';
        this.store_id_successMessage = '';

        this.box_id_hasError = false;
        this.box_id_errorMessage = '';
        this.box_id_successMessage = '';
    }

}