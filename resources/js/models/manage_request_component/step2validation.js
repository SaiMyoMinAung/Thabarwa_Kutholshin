export default class step2validation {
    constructor(
        validation = null
    ) {
        if (validation != null) {

            if (validation.transition_error) {
                this.transition_error_hasError = true;
                this.transition_error_errorMessage = validation.transition_error[0];
            } else {
                this.transition_error_hasError = false;
                this.transition_error_errorMessage = '';
            }

        } else {
            this.clearValidation()
        }

        this.maxlength = 20;
    }

    clearValidation() {

        this.transition_error_hasError = false;
        this.transition_error_errorMessage = '';
    }

}