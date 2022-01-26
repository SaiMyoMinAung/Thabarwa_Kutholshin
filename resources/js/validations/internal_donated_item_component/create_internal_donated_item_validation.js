export default class CreateInternalDonatedItemValidation {
    constructor(
        validation = null
    ) {
        if (validation != null) {

            if (validation.alms_round_id) {
                this.alms_round_id_hasError = true;
                this.alms_round_id_errorMessage = validation.alms_round_id[0];
                this.alms_round_id_successMessage = null;
            } else {
                this.alms_round_id_hasError = false;
                this.alms_round_id_successMessage = 'Good Job.';
            }

            if (validation.unit_id) {
                this.unit_id_hasError = true;
                this.unit_id_errorMessage = validation.unit_id[0];
                this.unit_id_successMessage = null;
            } else {
                this.unit_id_hasError = false;
                this.unit_id_successMessage = 'Good Job.';
            }

            if (validation.package_qty) {
                this.package_qty_hasError = true;
                this.package_qty_errorMessage = validation.package_qty[0];
                this.package_qty_successMessage = null;
            } else {
                this.package_qty_hasError = false;
                this.package_qty_successMessage = 'Good Job.';
            }

            if (validation.sacket_qty) {
                this.sacket_qty_hasError = true;
                this.sacket_qty_errorMessage = validation.sacket_qty[0];
                this.sacket_qty_successMessage = null;
            } else {
                this.sacket_qty_hasError = false;
                this.sacket_qty_successMessage = 'Good Job.';
            }

            if (validation.sacket_per_package) {
                this.sacket_per_package_hasError = true;
                this.sacket_per_package_errorMessage = validation.sacket_per_package[0];
                this.sacket_per_package_successMessage = null;
            } else {
                this.sacket_per_package_hasError = false;
                this.sacket_per_package_successMessage = 'Good Job.';
            }

            if (validation.item_sub_type_id) {
                this.item_sub_type_id_hasError = true;
                this.item_sub_type_id_errorMessage = validation.item_sub_type_id[0];
                this.item_sub_type_id_successMessage = null;
            } else {
                this.item_sub_type_id_hasError = false;
                this.item_sub_type_id_successMessage = 'Good Job.';
            }

            if (validation.remark) {
                this.remark_hasError = true;
                this.remark_errorMessage = validation.remark[0];
                this.remark_successMessage = null;
            } else {
                this.remark_hasError = false;
                this.remark_successMessage = 'Good Job.';
            }

            if (validation.cannot_confirm_error) {
                this.cannot_confirm_error_hasError = true;
                this.cannot_confirm_error_errorMessage = validation.cannot_confirm_error[0];
                this.cannot_confirm_error_successMessage = null;
            }

           
        } else {
            this.clearValidation()
        }

        this.maxlength = 20;
    }

    clearValidation() {
        this.package_qty_hasError = false;
        this.package_qty_errorMessage = '';
        this.package_qty_successMessage = '';

        this.sacket_qty_hasError = false;
        this.sacket_qty_errorMessage = '';
        this.sacket_qty_successMessage = '';

        this.sacket_per_package_hasError = false;
        this.sacket_per_package_errorMessage = '';
        this.sacket_per_package_successMessage = '';

        this.unit_hasError = false;
        this.unit_errorMessage = '';
        this.unit_successMessage = '';

        this.remark_hasError = false;
        this.remark_errorMessage = '';
        this.remark_successMessage = '';

        this.cannot_confirm_error_hasError = false;
        this.cannot_confirm_error_errorMessage = '';
        this.cannot_confirm_error_successMessage = '';

    }

}