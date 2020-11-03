export default class step3 {
    constructor(
        validation = null
    ) {
        if (validation != null) {

            if (validation.repaired_volunteer_id) {
                this.repaired_volunteer_id_hasError = true;
                this.repaired_volunteer_id_errorMessage = validation.repaired_volunteer_id[0];
                this.repaired_volunteer_id_successMessage = null;
            } else {
                this.repaired_volunteer_id_hasError = false;
                this.repaired_volunteer_id_successMessage = 'Good Job.';
            }

        } else {
            this.clearValidation()
        }

        this.maxlength = 20;
    }

    clearValidation() {
        this.repaired_volunteer_id_hasError = false;
        this.repaired_volunteer_id_errorMessage = '';
        this.repaired_volunteer_id_successMessage = '';
    }

}