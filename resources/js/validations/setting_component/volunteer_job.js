export default class VolunteerJob {
    constructor(
        validation = null
    ) {
        if (validation != null) {

            if (validation.name) {
                this.name_hasError = true;
                this.name_errorMessage = validation.name;
                this.name_successMessage = null;
            } else {
                this.name_hasError = false;
                this.name_successMessage = 'Good Name.';
            }

            if (validation.description) {
                this.description_hasError = true;
                this.description_errorMessage = validation.description;
                this.description_successMessage = null;
            } else {
                this.description_hasError = false;
                this.description_successMessage = 'Good Job.';
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

        this.description_hasError = false;
        this.description_errorMessage = '';
        this.description_successMessage = '';

    }

    validateName($event) {

    }

}