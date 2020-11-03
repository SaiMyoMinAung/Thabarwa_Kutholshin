export default class step4 {
    constructor(
        validation = null
    ) {
        if (validation != null) {

            if (validation.delivered_volunteer_id) {
                this.delivered_volunteer_id_hasError = true;
                this.delivered_volunteer_id_errorMessage = validation.delivered_volunteer_id[0];
                this.delivered_volunteer_id_successMessage = null;
            } else {
                this.delivered_volunteer_id_hasError = false;
                this.delivered_volunteer_id_successMessage = 'Good Job.';
            }

        } else {
            this.clearValidation()
        }

        this.maxlength = 20;
    }

    clearValidation() {
        this.delivered_volunteer_id_hasError = false;
        this.delivered_volunteer_id_errorMessage = '';
        this.delivered_volunteer_id_successMessage = '';
    }

}