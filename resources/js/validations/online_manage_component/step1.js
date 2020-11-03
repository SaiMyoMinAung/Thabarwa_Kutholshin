export default class step1 {
    constructor(
        validation = null
    ) {
        if (validation != null) {

            if (validation.pickedup_volunteer_id) {
                this.pickedup_volunteer_id_hasError = true;
                this.pickedup_volunteer_id_errorMessage = validation.pickedup_volunteer_id[0];
                this.pickedup_volunteer_id_successMessage = null;
            } else {
                this.pickedup_volunteer_id_hasError = false;
                this.pickedup_volunteer_id_successMessage = 'Good Job.';
            }

        } else {
            this.clearValidation()
        }

        this.maxlength = 20;
    }

    clearValidation() {
        this.pickedup_volunteer_id_hasError = false;
        this.pickedup_volunteer_id_errorMessage = '';
        this.pickedup_volunteer_id_successMessage = '';
    }

}