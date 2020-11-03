import step3Validation from '../../validations/online_manage_component/step3'

export default class step3 {
    constructor(uuid = '') {
        this.uuid = uuid;
        // selected data
        this.repaired_volunteer = null;
        this.data = {
            repaired_volunteer_id: null,
        }
        this.validation = new step3Validation;
        // url
        this.getVolunteerUrl = route("volunteers.get_all_volunteers")
        // placeholder
        this.placeholder = "Type To Search Repairer..."
        // confirm condition
        this.showForm = false
    }

    assignRepairer() {
        let self = this;
        let assignRepairerApi = route("donatedItem.assignRepairer", this.uuid);
        window.dashboard_app.$emit('startLoading');

        axios
            .post(assignRepairerApi, this.data)
            .then((response) => {
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
                this.validation = new step3Validation()
            })
            .catch(function (error) {
                window.dashboard_app.$emit('failed')
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
                self.validation = new step3Validation(error.response.data.errors);
            });
    }

    changeRepairingState() {
        let changeRepairingStateApi = route("donatedItem.changeRepairingState", this.uuid);

        window.dashboard_app.$emit('startLoading');

        axios
            .get(changeRepairingStateApi)
            .then((response) => {
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            })
            .catch(function (error) {
                window.dashboard_app.$emit('failed')
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            });
    }

    changeDoneRepairingState() {
        let changeDoneRepairingStateApi = route("donatedItem.changeDoneRepairingState", this.uuid);

        window.dashboard_app.$emit('startLoading');

        axios
            .get(changeDoneRepairingStateApi)
            .then((response) => {
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            })
            .catch(function (error) {
                window.dashboard_app.$emit('failed')
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            });
    }

    selectedRepairerVolunteer(event) {
        this.repaired_volunteer = event;
        this.data.repaired_volunteer_id = event != null ? event.id : "";
    }

    requiredRepairing() {
        this.callRequiredRepairingApi(true)
    }

    notRequiredRepairing() {
        this.callRequiredRepairingApi(false)
    }

    callRequiredRepairingApi(required) {
        let self = this;
        let requiredRepairingApi = route("donatedItem.requiredRepairState", this.uuid);
        window.dashboard_app.$emit('startLoading');

        axios
            .post(requiredRepairingApi, { required })
            .then((response) => {
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
                this.validation = new step3Validation()
                this.showForm = required;
            })
            .catch(function (error) {
                window.dashboard_app.$emit('failed')
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
                self.validation = new step3Validation(error.response.data.errors);
                self.showForm = false;
            });
    }

    constructData(model) {
        this.uuid = model.uuid
        this.repaired_volunteer = model.repaired_volunteer
        this.data.repaired_volunteer_id = model.repaired_volunteer_id
        this.showForm = model.is_required_repairing
    }

}