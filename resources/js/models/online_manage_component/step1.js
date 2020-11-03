import step1Validation from '../../validations/online_manage_component/step1'

export default class step1 {
    constructor(uuid = '') {
        this.uuid = uuid;
        this.pickedup_volunteer = null
        this.data = {
            pickedup_volunteer_id: null
        }
        this.validation = new step1Validation;
        this.getVolunteerUrl = route("volunteers.get_all_volunteers")
        this.placeholder = "Type To Search Volunteer..."
    }

    assignDriver() {
        let self = this;
        let assignDriverApi = route("donatedItem.assignDriver", this.uuid);
        window.dashboard_app.$emit('startLoading');

        axios
            .post(assignDriverApi, this.data)
            .then((response) => {
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
                this.validation = new step1Validation()
            })
            .catch(function (error) {
                window.dashboard_app.$emit('failed')
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
                self.validation = new step1Validation(error.response.data.errors);
            });
    }

    changePickingUpState() {
        let changePickingupStateApi = route("donatedItem.changePickingupState", this.uuid);

        window.dashboard_app.$emit('startLoading');

        axios
            .get(changePickingupStateApi)
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

    changeDonePickingUpState() {
        let changeDonePickingupStateApi = route("donatedItem.changeDonePickingupState", this.uuid);

        window.dashboard_app.$emit('startLoading');

        axios
            .get(changeDonePickingupStateApi)
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

    selectedPickedupVolunteer(event) {
        this.pickedup_volunteer = event;
        this.data.pickedup_volunteer_id = event != null ? event.id : "";
    }

    constructData(model) {
        this.uuid = model.uuid
        this.pickedup_volunteer = model.pickedup_volunteer
        this.data.pickedup_volunteer_id = model.pickedup_volunteer_id
    }

}