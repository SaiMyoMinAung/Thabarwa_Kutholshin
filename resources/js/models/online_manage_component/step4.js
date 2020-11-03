import step4Validation from '../../validations/online_manage_component/step4'

export default class step4 {
    constructor(uuid = '') {
        this.uuid = uuid;
        // selected data
        this.delivered_volunteer = null;
        this.data = {
            delivered_volunteer_id: null,
        }
        this.validation = new step4Validation;
        // url
        this.getVolunteerUrl = route("volunteers.get_all_volunteers")
        // placeholder
        this.placeholder = "Type To Search Deliver Volunteer..."
        // confirm condition
        this.showForm = false
    }

    assignDeliver() {
        let self = this;
        let assignDeliverApi = route("donatedItem.assignDeliver", this.uuid);
        window.dashboard_app.$emit('startLoading');

        axios
            .post(assignDeliverApi, this.data)
            .then((response) => {
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
                this.validation = new step4Validation()
            })
            .catch(function (error) {
                window.dashboard_app.$emit('failed')
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
                self.validation = new step4Validation(error.response.data.errors);
            });
    }

    changeDeliveringState() {
        let changeDeliveringStateApi = route("donatedItem.changeDeliveringState", this.uuid);

        window.dashboard_app.$emit('startLoading');

        axios
            .get(changeDeliveringStateApi)
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

    changeDoneDeliveringState() {
        let changeDoneDeliveringStateApi = route("donatedItem.changeDoneDeliveringState", this.uuid);

        window.dashboard_app.$emit('startLoading');

        axios
            .get(changeDoneDeliveringStateApi)
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

    selectedDeliverVolunteer(event) {
        this.delivered_volunteer = event;
        this.data.delivered_volunteer_id = event != null ? event.id : "";
    }

    constructData(model) {
        this.uuid = model.uuid
        this.delivered_volunteer = model.delivered_volunteer
        this.data.delivered_volunteer_id = model.delivered_volunteer_id
    }

}