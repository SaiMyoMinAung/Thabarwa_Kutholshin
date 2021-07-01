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

            if (validation.socket_qty) {
                this.socket_qty_hasError = true;
                this.socket_qty_errorMessage = validation.socket_qty[0];
                this.socket_qty_successMessage = null;
            } else {
                this.socket_qty_hasError = false;
                this.socket_qty_successMessage = 'Good Job.';
            }

            if (validation.socket_per_package) {
                this.socket_per_package_hasError = true;
                this.socket_per_package_errorMessage = validation.socket_per_package[0];
                this.socket_per_package_successMessage = null;
            } else {
                this.socket_per_package_hasError = false;
                this.socket_per_package_successMessage = 'Good Job.';
            }

            if (validation.item_type_id) {
                this.item_type_id_hasError = true;
                this.item_type_id_errorMessage = validation.item_type_id[0];
                this.item_type_id_successMessage = null;
            } else {
                this.item_type_id_hasError = false;
                this.item_type_id_successMessage = 'Good Job.';
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

            // For Internal Requested Item
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

            if (validation.request_socket_qty) {
                this.request_socket_qty_hasError = true;
                this.request_socket_qty_errorMessage = validation.request_socket_qty[0];
                this.request_socket_qty_successMessage = null;
            } else {
                this.request_socket_qty_hasError = false;
                this.request_socket_qty_successMessage = 'Good Job.';
            }

            if (validation.request_package_qty) {
                this.request_package_qty_hasError = true;
                this.request_package_qty_errorMessage = validation.request_package_qty[0];
                this.request_package_qty_successMessage = null;
            } else {
                this.request_package_qty_hasError = false;
                this.request_package_qty_successMessage = 'Good Job.';
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

        this.package_qty_hasError = false;
        this.package_qty_errorMessage = '';
        this.package_qty_successMessage = '';

        this.socket_qty_hasError = false;
        this.socket_qty_errorMessage = '';
        this.socket_qty_successMessage = '';

        this.socket_per_package_hasError = false;
        this.socket_per_package_errorMessage = '';
        this.socket_per_package_successMessage = '';

        this.unit_hasError = false;
        this.unit_errorMessage = '';
        this.unit_successMessage = '';

        this.item_type_id_hasError = false;
        this.item_type_id_errorMessage = '';
        this.item_type_id_successMessage = '';

        this.remark_hasError = false;
        this.remark_errorMessage = '';
        this.remark_successMessage = '';

        this.cannot_confirm_error_hasError = false;
        this.cannot_confirm_error_errorMessage = '';
        this.cannot_confirm_error_successMessage = '';

        // For Internal Requested Item
        this.requestable_type_hasError = false;
        this.requestable_type_errorMessage = '';
        this.requestable_type_successMessage = '';

        this.requestable_id_hasError = false;
        this.requestable_id_errorMessage = '';
        this.requestable_id_successMessage = '';

        this.request_package_qty_hasError = false;
        this.request_package_qty_errorMessage = '';
        this.request_package_qty_successMessage = '';

        this.request_socket_qty_hasError = false;
        this.request_socket_qty_errorMessage = '';
        this.request_socket_qty_successMessage = '';
    }

}